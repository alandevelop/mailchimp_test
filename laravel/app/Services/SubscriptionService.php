<?php


namespace App\Services;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Spatie\Newsletter\NewsletterFacade;

class SubscriptionService
{
    protected $listId;

    private $api;

    private $errors = [];

    public function __construct()
    {
        $this->listId = config('newsletter.lists.subscribers.id');

        $this->api = NewsletterFacade::getApi();
    }

    public function newSubscription(string $firstName, string $surname, string $email)
    {
        $res = $this->api->post("/lists/$this->listId", [
            'members' => [[
                'email_address' => $email,
                'status'        => 'subscribed',
                'merge_fields' => ['FNAME'=>$firstName, 'LNAME'=>$surname],
            ]]
        ]);

        if($res['errors']) {
            $this->errors = $res['errors'];

            return false;
        } else {
            Subscription::create([
                'list_id' => $this->listId,
                'name' => $firstName,
                'surname' => $surname,
                'email' => $email,
                'is_subscribed' => 1,
                'synchronized_at' => now()->toDateTimeString()
            ]);

            return true;
        }
    }

    public function subscribeAll() :bool
    {
        $subscriptions = Subscription::all();

        $members = [];

        foreach ($subscriptions as $key => $subscription) {
            $members[] = [
                'email_address' => $subscription->email,
                'status'        => 'subscribed',
                'merge_fields' => ['FNAME'=>$subscription->name, 'LNAME'=>$subscription->surname],
            ];
        }

        $res = $this->api->post("/lists/$this->listId", [
            'members' => $members
        ]);

        if($res['errors']) {
            $this->errors = $res['errors'];

            return false;
        } else {
            Subscription::where('list_id', $this->listId)->update(['is_subscribed' => 1]);

            return true;
        }
    }

    public function getErrors() :array
    {
        return $this->errors;
    }

    public function updateStatuses()
    {
        $res = $this->api->get("/lists/$this->listId/members", [
            'count' => 1000
        ]);

        $subsribed = [];
        $unsubsribed = [];

        foreach ($res['members'] as $member) {
            if($member['status'] ===  'subscribed') $subsribed[] = $member['email_address'];
            if($member['status'] ===  'unsubscribed') $unsubsribed[] = $member['email_address'];
        }

        $dateTime = now()->toDateTimeString();

        DB::table('subscriptions')
            ->whereIn('email', $subsribed)
            ->update(['is_subscribed' => 1, 'synchronized_at' => $dateTime]);

        DB::table('subscriptions')
            ->whereIn('email', $unsubsribed)
            ->update(['is_subscribed' => 0, 'synchronized_at' => $dateTime]);
    }
}
