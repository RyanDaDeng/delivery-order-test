<?php

namespace TimeHunter\DeliveryOrderTest\Tests;

use PHPUnit\Framework\TestCase;
use TimeHunter\DeliveryOrderTest\MarketingModule\Interfaces\MarketingServiceInterface;
use TimeHunter\DeliveryOrderTest\DeliveryOrderModule\DeliveryOrderProcessors\PersonalDeliveryExpressProcessor;

class PersonalDeliveryExpressProcessorTest extends TestCase
{
    public function testGetEnterpriseDeliveryProcess()
    {
        $json = '{"customer":{"name":"Jack Ripper","address":"822 Anzac Parade, 2035, Maroubra"},"deliveryType":"personalDeliveryExpress","source":"email","weight":2000,"campaign":{"name":"Christmas2018","type":"holiday","ad":"opportunity"}}';

        $marketingMock = \Mockery::mock(MarketingServiceInterface::class);

        $marketingMock->shouldReceive('process')
            ->mock();

        $service = new PersonalDeliveryExpressProcessor(json_decode($json, 1), $marketingMock);

        $this->assertEquals(true, $service->process());
    }
}
