<?php

namespace App\Services;

class buubleSortService
{
    public static function sort(Array $array): array
    {
        for ($j = 0; $j < count($array) - 1; $j++){
            for ($i = 0; $i < count($array) - $j - 1; $i++){
                // если текущий элемент больше следующего
                if ($array[$i] > $array[$i + 1]){
                    // меняем местами элементы
                    $tmp_var = $array[$i + 1];
                    $array[$i + 1] = $array[$i];
                    $array[$i] = $tmp_var;
                }
            }
        }
        return $array;
    }
}
