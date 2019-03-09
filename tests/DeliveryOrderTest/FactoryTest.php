<?php

namespace TimeHunter\DeliveryOrderTest\Tests;

use PHPUnit\Framework\TestCase;
use TimeHunter\DeliveryOrderTest\DeliveryOrderModule\DeliveryOrderProcessors\EnterpriseDeliveryProcessor;
use TimeHunter\DeliveryOrderTest\DeliveryOrderModule\DeliveryOrderProcessors\PersonalDeliveryExpressProcessor;
use TimeHunter\DeliveryOrderTest\DeliveryOrderModule\DeliveryOrderProcessors\PersonalDeliveryProcessor;
use TimeHunter\DeliveryOrderTest\DeliveryOrderModule\Factories\DeliveryOrderProcessorFactory;
use TimeHunter\DeliveryOrderTest\MarketingModule\Interfaces\MarketingServiceInterface;

class FactoryTest extends TestCase
{
    public function testGetPersonalDeliveryType()
    {
        $json = '{"customer":{"name":"Johnny Bravo","address":"56 Pitt Street, 2000, Sydney"},"deliveryType":"personalDelivery","source":"web","weight":1500}';
        $object = DeliveryOrderProcessorFactory::makeByJson($json);
        $this->assertInstanceOf(PersonalDeliveryProcessor::class, $object);
    }


    public function testGetEnterpriseDeliveryType()
    {
        $json = '{"customer":{"name":"Elvis Presley","address":"333 George Street, 2000, Sydney"},"deliveryType":"enterpriseDelivery","source":"direct","onBehalf":"True Capital","enterprise":{"name":"Bayview Motel","type":"PtyLtd","abn":"SN123OK","directors":[{"name":"Michael Jackskon","address":"242 Bayview, 2434, Sydney"},{"name":"Freddie Mercury","address":"132 Coast, 2354, Newcastle"}]},"weight":5000}';
        $object = DeliveryOrderProcessorFactory::makeByJson($json);
        $this->assertInstanceOf(EnterpriseDeliveryProcessor::class, $object);
    }


    public function testGetPersonalDeliveryExpressType()
    {
        $json = '{"customer":{"name":"Jack Ripper","address":"822 Anzac Parade, 2035, Maroubra"},"deliveryType":"personalDeliveryExpress","source":"email","weight":2000,"campaign":{"name":"Christmas2018","type":"holiday","ad":"opportunity"}}';
        $object = DeliveryOrderProcessorFactory::makeByJson($json);
        $this->assertInstanceOf(PersonalDeliveryExpressProcessor::class, $object);
    }

}
