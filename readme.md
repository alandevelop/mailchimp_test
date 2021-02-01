# About

---
User credentials. This password is specified in seeder only for testing purpose: \
email: admin@hotmail.com \
password: admin_password

Separate subscriptions table for avoiding creating users with password and tokens. \
Separate SubscriptionService class for better maintainability and code reuse.

`artisan mailchimp:subscribe_all` for subscribing all users in DB for the main list \
`artisan mailchimp:update_statuses`  for updating all users subscription statuses with mailchimp

# Installation

---
**Installation via Docker environment :**

— run `docker-compose up` in the directory where docker-compose.yml file is located \
— add `127.0.0.1` mailchimp in `/etc/hosts` \
— run `. ./alias.bash` in the terminal to add aliases for interacting with docker containers 

**Connecting to DB through PHPstorm** \
Host: localhost \
Port 3306 \
User: root \
Password: root \
Database: mailchimp

**сopy `.env.example` to `.env` file and specify the following parameters:** \
MAILCHIMP_APIKEY=mailchimp_api_key \
MAILCHIMP_LIST_ID=mailchimp_list_id 

DB_CONNECTION=mysql \
DB_HOST=mysql \
DB_PORT=3306 \
DB_DATABASE=mailchimp \
DB_USERNAME=root \
DB_PASSWORD=root

**With docker:** \
Run the following command in the terminal: \
`composer install` \
`artisan key:generate`\
`artisan migrate --seed`

**Without Docker:** \
`cd` to the `Laravel` directory and run the following command in the terminal: \
`composer install` \
`php artisan key:generate` \
`php artisan migrate --seed`

