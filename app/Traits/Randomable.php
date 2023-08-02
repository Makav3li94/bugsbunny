<?php

namespace App\Traits;


trait Randomable
{
    private function createRandomNumbers()
    {
        $operators = ['+', '-'];
        $a = rand(10, 19);
        $b=rand(1,9);
        $random_operator = $operators[array_rand($operators)];
        return [$a, $random_operator, $b];
    }
}
