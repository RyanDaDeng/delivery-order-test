<?php

namespace TimeHunter\DeliveryOrderTest\Tests;

use PHPUnit\Framework\TestCase;
use TimeHunter\DeliveryOrderTest\DeliveryOrderModule\DeliveryOrderProcessors\EnterpriseDeliveryProcessor;
use TimeHunter\DeliveryOrderTest\MarketingModule\Interfaces\MarketingServiceInterface;
use TimeHunter\DeliveryOrderTest\ThirdPartyModule\Interfaces\ThirdPartyApiServiceInterface;

class EnterpriseDeliveryProcessorTest extends TestCase
{
    public function testGetEnterpriseDeliveryTypeValidate()
    {
        $json = '{"customer":{"name":"Elvis Presley","address":"333 George Street, 2000, Sydney"},"deliveryType":"enterpriseDelivery","source":"direct","onBehalf":"True Capital","enterprise":{"name":"Bayview Motel","type":"PtyLtd","abn":"SN123OK","directors":[{"name":"Michael Jackskon","address":"242 Bayview, 2434, Sydney"},{"name":"Freddie Mercury","address":"132 Coast, 2354, Newcastle"}]},"weight":5000}';

        $mock = \Mockery::mock(ThirdPartyApiServiceInterface::class);

        $mock->shouldReceive('validateEnterprise')
            ->andReturn(true)
            ->mock();


        $marketingMock = \Mockery::mock(MarketingServiceInterface::class);

        $marketingMock->shouldReceive('process')
            ->mock();

        $service = new EnterpriseDeliveryProcessor($mock,json_decode($json,1),$marketingMock);
        $this->assertEquals(true,$service->validate());


    }



    public function testGetEnterpriseDeliveryTypeValidate2()
    {
        $json = '{"customer":{"name":"Elvis Presley","address":"333 George Street, 2000, Sydney"},"deliveryType":"enterpriseDelivery","source":"direct","onBehalf":"True Capital","enterprise":{"name":"Bayview Motel","type":"PtyLtd","abn":"SN123OK","directors":[{"name":"Michael Jackskon","address":"242 Bayview, 2434, Sydney"},{"name":"Freddie Mercury","address":"132 Coast, 2354, Newcastle"}]},"weight":5000}';

        $mock = \Mockery::mock(ThirdPartyApiServiceInterface::class);

        $mock->shouldReceive('validateEnterprise')
            ->andReturn(false)
            ->mock();

        $marketingMock = \Mockery::mock(MarketingServiceInterface::class);

        $marketingMock->shouldReceive('process')
            ->mock();

        $service = new EnterpriseDeliveryProcessor($mock,json_decode($json,1),$marketingMock);
        $this->assertEquals(false,$service->validate());
    }



    public function testGetEnterpriseDeliveryProcess()
    {
        $json = '{"customer":{"name":"Elvis Presley","address":"333 George Street, 2000, Sydney"},"deliveryType":"enterpriseDelivery","source":"direct","onBehalf":"True Capital","enterprise":{"name":"Bayview Motel","type":"PtyLtd","abn":"SN123OK","directors":[{"name":"Michael Jackskon","address":"242 Bayview, 2434, Sydney"},{"name":"Freddie Mercury","address":"132 Coast, 2354, Newcastle"}]},"weight":5000}';

        $mock = \Mockery::mock(ThirdPartyApiServiceInterface::class);

        $mock->shouldReceive('validateEnterprise')
            ->andReturn(true)
            ->mock();

        $marketingMock = \Mockery::mock(MarketingServiceInterface::class);

        $marketingMock->shouldReceive('process')
            ->mock();


        $service = new EnterpriseDeliveryProcessor($mock,json_decode($json,1),$marketingMock);

        $this->assertEquals(true,$service->process());
    }



}
