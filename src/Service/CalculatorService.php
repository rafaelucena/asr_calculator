<?php

declare(strict_types=1);

namespace App\Service;

class CalculatorService
{
    public const RESPONSE_ERROR = 'error';
    public const RESPONSE_RESULT = 'result';
    public const RESPONSE_STATUS = 'status';

    public const STATUS_FAIL = 'fail';
    public const STATUS_SUCCESS = 'success';

    private const ERROR_MESSAGE_INVALID_NUMBER = '(%s) is not a valid number';

    /** @var array */
    private $response;

    public function __construct()
    {
        $this->response = [
            self::RESPONSE_STATUS => self::STATUS_SUCCESS,
            self::RESPONSE_RESULT => '',
        ];
    }

    /**
     * @param string $value
     *
     * @return string
     */
    private function parseCommas(string $value): string
    {
        return str_replace(',', '.', $value);
    }

    /**
     * @param string $valueA
     * @param string $valueB
     *
     * @return array
     */
    public function operationAdd(string $valueA, string $valueB): array
    {
        $valueA = $this->parseCommas($valueA);
        $valueB = $this->parseCommas($valueB);

        if (!is_numeric($valueA)) {
            $this->setResponseFailed(sprintf(self::ERROR_MESSAGE_INVALID_NUMBER, $valueA));
            return $this->getResponse();
        }

        if (!is_numeric($valueB)) {
            $this->setResponseFailed(sprintf(self::ERROR_MESSAGE_INVALID_NUMBER, $valueB));
            return $this->getResponse();
        }

        $this->setResponseResult($valueA + $valueB);
        return $this->getResponse();
    }

    /**
     * @param string|null $error
     */
    private function setResponseFailed(string $error = null): void
    {
        $this->response[self::RESPONSE_STATUS] = self::STATUS_FAIL;
        $this->response[self::RESPONSE_ERROR] = $error ?? '';
    }

    /**
     * @param float $result
     */
    private function setResponseResult(float $result): void
    {
        $this->response[self::RESPONSE_RESULT] = $result;
    }

    /**
     * @return array
     */
    public function getResponse(): array
    {
        return $this->response;
    }
}
