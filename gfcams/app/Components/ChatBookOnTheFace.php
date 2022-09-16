<?php

namespace app\Components;

use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;
use SplObjectStorage;

class ChatBookOnTheFace implements MessageComponentInterface, \Ratchet\MessageComponentInterface
{
    protected SplObjectStorage $clients;

    public function __construct()
    {
        $this->clients = new SplObjectStorage();
    }
    /**
     * @param ConnectionInterface $conn
     * @return mixed
     */
    function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "Новое соединеие ($conn->resuorceId)}\n";
    }

    /**
     * @param ConnectionInterface $conn
     * @return mixed
     */
    function onClose(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "Соединеие ($conn->resuorceId) закрыто}\n";
    }

    /**
     * @param ConnectionInterface $conn
     * @param \Exception $e
     * @return mixed
     */
    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Упс, что-то пошло не так: {$e->getMessage()}\n";
    }

    /**
     * @param ConnectionInterface $conn
     * @param MessageInterface $msg
     * @return mixed
     */
    public function onMessage(ConnectionInterface $conn, $msg)
    {
        $clientCount = $this->clients->count()-1;
        echo sprintf(
            'Пользователь %d отправил сообщение "%s" %d другим пользователям' . "\n"
            , $conn->resuorceId,
            $msg,
            $clientCount,
            $clientCount === 1 ? '' : 's'
        );

        /** @var ConnectionInterface $client */
        foreach ($this->clients as $client){
            if($conn !== $client) {
                $client->send($msg);
            }
        }
    }
}
