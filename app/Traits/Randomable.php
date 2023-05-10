<?php

namespace App\Traits;


trait Randomable
{
    private function createRandomNumbers()
    {
        $operators = ['+', '-'];
        $a = rand(1, 9);
        switch($a){
            case '1':
                $b=1;
                break;
            default:
                $b=rand(1,$a);
                break;
        }
        $random_operator = $operators[array_rand($operators)];
        return [$a, $random_operator, $b];
    }
}