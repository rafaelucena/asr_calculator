<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\CalculatorService;
use Symfony\Component\HttpFoundation\JsonResponse;

class CalculatorController
{
    /** @var CalculatorService */
    private $service;

    /**
     * @param CalculatorService $service
     */
    public function __construct(CalculatorService $service)
    {
        $this->service = $service;
    }

    /**
     * @param string $valueA
     * @param string $valueB
     *
     * @return JsonResponse
     */
    public function addition(string $valueA, string $valueB): JsonResponse
    {
        return new JsonResponse($this->service->operationAdd($valueA, $valueB));
    }

    /**
     * @param string $valueA
     * @param string $valueB
     *
     * @return JsonResponse
     */
    public function subtraction(string $valueA, string $valueB): JsonResponse
    {
        return new JsonResponse($this->service->operationSubtract($valueA, $valueB));
    }

    /**
     * @param string $valueA
     * @param string $valueB
     *
     * @return JsonResponse
     */
    public function multiplication(string $valueA, string $valueB): JsonResponse
    {
        return new JsonResponse($this->service->operationMultiply($valueA, $valueB));
    }

    /**
     * @param string $valueA
     * @param string $valueB
     *
     * @return JsonResponse
     */
    public function division(string $valueA, string $valueB): JsonResponse
    {
        return new JsonResponse($this->service->operationDivide($valueA, $valueB));
    }
}
