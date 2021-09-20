<?php

require_once 'vendor/autoload.php';

use \Stripe\Stripe;
use \Stripe\Customer;
use \Stripe\ApiOperations\Create;
use \Stripe\Charge;

$csv = fopen('shirt_orders.csv', 'r');
$shirt_size = 'XXX-Large';
$shirt_color = 'Black';
$count = 0;

while ( ($row = fgetcsv($csv)) != FALSE ) {
    if ( $row[4] == $shirt_color and $row[3] == $shirt_size ) {
        $count++;
    }
}

fclose($csv);

$cost = 14.68 * $count * 100;

$stripe = new \Stripe\StripeClient(
    '{KEY_HERE}'
);

$customer = $stripe->customers->all(['email' => '{CUSTOMER_EMAIL_HERE}']);

$customer_id = $customer["data"][0]['id'];

$stripe->charges->create([
    'amount' => $cost,
    'currency' => 'usd',
    'customer' => $customer_id,
    'description' => 'XXX-Large Black Shirts',
]);