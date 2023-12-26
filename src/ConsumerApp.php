<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection("localhost", 5672, "guest", "guest", "/");
$channel = $connection->channel();

$channel->basic_consume("email", "email-consumer", false, true, false, false, function (AMQPMessage $message) {
    echo $message->getRoutingKey() . PHP_EOL;
    echo $message->getBody() . PHP_EOL;
});

$channel->consume();

//$channel->close();
//$connection->close();
