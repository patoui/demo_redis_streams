<?php

declare(strict_types=1);

$redis = new Redis();
$redis->connect('redis');

$stream_name   = 'transactions';
$group_name    = 'balance_manager';
$consumer_name = 'consumer_1';

$redis->xGroup('CREATE', $stream_name, $group_name, '0');
$stream_messages = $redis->xReadGroup(
    $group_name,
    $consumer_name,
    [$stream_name => '>']
);

if (!$stream_messages) {
    die('No messages' . PHP_EOL);
}

$transactions = $stream_messages[$stream_name] ?? null;

if (!$transactions) {
    die('No transactions' . PHP_EOL);
}

$processed_message_ids = [];
$balances = [];
foreach ($transactions as $message_id => $transaction) {
    if (!isset($balances[$transaction['account_no']])) {
        $balances[$transaction['account_no']] = 0;
    }
    $balances[$transaction['account_no']] += $transaction['value'];
    $processed_message_ids[] = $message_id;
}

foreach ($balances as $account_no => $balance) {
    echo "Account No {$account_no}, current balance: {$balance}" . PHP_EOL;
}

$redis->xAck($stream_name, $group_name, $processed_message_ids);