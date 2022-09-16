<?php
require_once __DIR__ . '/../vendor/autoload.php';

use app\Components\AutoMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection(
    'localhost',
    5672,
    'gfcams',
    'fpZ4!-26ZGya'
);

try {
    $channel = $connection->channel();
    $channel->queue_declare('Automobile', false, false, false,false);

    $message = new AMQPMessage('Lada');
    $channel->basic_publish($message, '', 'Automobile');

    echo " [x] Сообщение отправлено\n";

    $channel->close();
    $connection->close();

} catch (AMQPException $exception)
{
echo $exception->getMessage();
}
