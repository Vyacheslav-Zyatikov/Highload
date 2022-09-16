<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection(
    'localhost',
    5672,
    'gfcams',
    'fpZ4!-26ZGya'
);

try {
    $channel = $connection->channel();
    $channel->queue_declare('Automobile', false, false, false,false);

    echo " [*] Ожидаются сообщения. Для выхода нажмите CTRL+C\n";

    $callback = function ($msg) {
        echo ' [x] Доставлено ', $msg->body, "\n";
    };

    $channel->basic_consume('Automobile', '', false, true, false, false, $callback);

    while ($channel->is_open()) {
        $channel->wait();
    }

    $channel->close();
    $connection->close();

} catch (AMQPException $exception)
{
    echo $exception->getMessage();
}
