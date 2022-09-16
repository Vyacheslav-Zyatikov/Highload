<?php

namespace app\Components;

class AutoMessage
{
    public function __construct(public string $autoModel, public int $userId)
    {
    }
}
