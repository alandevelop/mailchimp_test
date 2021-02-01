<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subscriptions\SubscribeUserRequest;
use App\Services\SubscriptionService;


class SubscriberController extends Controller
{
    public function store(SubscribeUserRequest $request)
    {
        $service = new SubscriptionService();

        $success = $service->newSubscription($request->name, $request->surname, $request->email);

        if($success) {
            $request->session()->flash('success', 'A new subscription was successfully created!');

            return redirect(route('index'));
        } else {
            return redirect(route('index'))->withErrors(['There has been an error while creating subscription.']);
        }
    }
}
