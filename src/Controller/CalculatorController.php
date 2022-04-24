<?php

namespace App\Controller;

use App\Service\CalculatorService;
use Symfony\Component\HttpFoundation\JsonResponse;

class CalculatorController
{
    public function addition(string $valueA, string $valueB)
    {
        return new JsonResponse([
            'result' => $valueA + $valueB,
        ]);
    }

    public function subtraction(string $valueA, string $valueB)
    {
        return new JsonResponse([
            'result' => $valueA - $valueB,
        ]);
    }

    public function multiplication(string $valueA, string $valueB)
    {
        return new JsonResponse([
            'result' => $valueA * $valueB,
        ]);
    }

    public function division(string $valueA, string $valueB)
    {
        return new JsonResponse([
            'result' => $valueA / $valueB,
        ]);
    }
}
