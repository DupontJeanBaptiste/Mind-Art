<?php

namespace App\Services;

class ShuffleService
{
    public function shuffleArray(array $array): array
    {
        //Shuffle array

        $keys = array_keys($array);

        shuffle($keys);

        $new = [];

        foreach ($keys as $key) {
            $new[$key] = $array[$key];
        }

        $shuffledArray = $new;

        //retrun shuffeled array

        return $shuffledArray;
    }
}
