<?php
require __DIR__.'/../vendor/autoload.php';

use App\Components\ChatBookOnTheFace;
use Ratchet\Server\IoServer;

$server = IoServer::factory(
    new ChatBookOnTheFace(),
    8181
);

$server->run();
