<?php

declare (strict_types=1);

namespace App\Tests;

use App\Service\CalculatorService;
use PHPUnit\Framework\TestCase;

class CalculatorServiceTest extends TestCase
{
    /** @var CalculatorService */
    private $service;

    public function setUp(): void
    {
        $this->service = new CalculatorService();
    }

    /**
     * @param string $method
     * @param array $parameters
     *
     * @return mixed
     */
    protected function callNonAccessibleMethod(string $method, array $parameters)
    {
        $method = new \ReflectionMethod(get_class($this->service), $method);
        $method->setAccessible(true);

        return $method->invoke($this->service, ...$parameters);
    }

    public function testDefaultResponseAfterInstanced()
    {
        $response = $this->service->getResponse();

        $this->assertArrayHasKey(CalculatorService::RESPONSE_RESULT, $response);
        $this->assertArrayHasKey(CalculatorService::RESPONSE_STATUS, $response);
    }

    public function testParseCommas(): void
    {
        $valueWithComma = '0,35';
        $expectedValueWithoutComma = $this->callNonAccessibleMethod('parseCommas', ['0,35']);

        $this->assertNotSame($valueWithComma, $expectedValueWithoutComma);
        $this->assertSame(str_replace(',', '.', $valueWithComma), $expectedValueWithoutComma);
    }

    public function testIsValidForParameterPairs()
    {
        #test basic validation
        $valueA = '35';
        $valueB = '12';

        $booleanReturn = $this->callNonAccessibleMethod('isValid', [$valueA, $valueB]);
        $this->assertTrue($booleanReturn);

        $valueA = '35';
        $valueB = 'nope';

        $booleanReturn = $this->callNonAccessibleMethod('isValid', [$valueA, $valueB]);
        $this->assertFalse($booleanReturn);

        #test division validation
        $valueA = '35';
        $valueB = '0';
        $isDivision = true;

        $booleanReturn = $this->callNonAccessibleMethod('isValid', [$valueA, $valueB, $isDivision]);
        $this->assertFalse($booleanReturn);
    }
}
