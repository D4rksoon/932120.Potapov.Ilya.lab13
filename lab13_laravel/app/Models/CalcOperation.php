<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalcOperation extends Model
{
    public static function randOperation()
    {
        $operation = array( '+', '-' );
        $key = array_rand($operation);
        return $operation[$key];
    }
    public static function randNumber()
    {
        return rand(1, 10);
    }
    public static function solution($first, $second, $operation)
    {
        $result = match($operation) {
            '+' => $first + $second,
            '-' => $first - $second,
            default => null
        };
        return $result;
    }
    public static function checkCorrect($first, $second, $operation, $userAnswer)
    {
        $correctAnswer = self::solution($first, $second, $operation);
        return $correctAnswer == $userAnswer;
    }
}
