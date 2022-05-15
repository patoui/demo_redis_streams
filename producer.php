<?php

declare(strict_types=1);

$redis = new Redis();
$redis->connect('redis');

$transactions = [
    ['account_no' => 'ABC321', 'value' => 1000],
    ['account_no' => 'ABC321', 'value' => -100],
    ['account_no' => 'XYZ987', 'value' => 555],
    ['account_no' => 'XYZ987', 'value' => -22],
];

foreach ($transactions as $transaction) {
    $redis->xAdd('transactions', '*', $transaction);
}
