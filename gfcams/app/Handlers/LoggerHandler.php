<?php

namespace App\Handlers;

use http\Encoding\Stream\Inflate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class LoggerHandler implements LoggerHandlerInterface
{
    public function handle(Request $request):void
    {
        $time_start = Carbon::now()->format('Y.m.d H:i:s.u');
        Log::info('Начал работать в '. $time_start);

        $array = [1, 2, 3, 5, 6 ,8 , 1, 12, 15, 18, 1,2 ,3 ,4, 6, 13, 15 , 17 ]; //пузырьком -1 быстрой сортировки - 2
        //$this->buubleSortService->sort($array);

        sort($array);

        Log::debug(memory_get_usage());

        $time_end = Carbon::now()->format('Y.m.d H:i:s.u');
        Log::info('Закончил работать в '. $time_end);
    }
}
