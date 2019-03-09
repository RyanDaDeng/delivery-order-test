<?php

namespace TimeHunter\DeliveryOrderTest\Tests;

use PHPUnit\Framework\TestCase;
use TimeHunter\DeliveryOrderTest\DeliveryOrderModule\Services\DeliveryOrderService;
use TimeHunter\DeliveryOrderTest\MarketingModule\Interfaces\MarketingServiceInterface;
use TimeHunter\DeliveryOrderTest\DeliveryOrderModule\DeliveryOrderProcessors\PersonalDeliveryProcessor;
use TimeHunter\DeliveryOrderTest\DeliveryOrderModule\DeliveryOrderProcessors\EnterpriseDeliveryProcessor;
use TimeHunter\DeliveryOrderTest\DeliveryOrderModule\DeliveryOrderProcessors\PersonalDeliveryExpressProcessor;

class ServiceTest extends TestCase
{
    public function testAllTypes()
    {
        $json = '[{"customer":{"name":"Johnny Bravo","address":"56 Pitt Street, 2000, Sydney"},"deliveryType":"personalDelivery","source":"web","weight":1500},{"customer":{"name":"Jack Ripper","address":"822 Anzac Parade, 2035, Maroubra"},"deliveryType":"personalDeliveryExpress","source":"email","weight":2000,"campaign":{"name":"Christmas2018","type":"holiday","ad":"opportunity"}},{"customer":{"name":"Elvis Presley","address":"333 George Street, 2000, Sydney"},"deliveryType":"enterpriseDelivery","source":"direct","onBehalf":"True Capital","enterprise":{"name":"Bayview Motel","type":"PtyLtd","abn":"SN123OK","directors":[{"name":"Michael Jackskon","address":"242 Bayview, 2434, Sydney"},{"name":"Freddie Mercury","address":"132 Coast, 2354, Newcastle"}]},"weight":5000}]';
        $service = new DeliveryOrderService($json);
        $objects = $service->getDeliveryOrderCollections();
        $this->assertEquals(3, count($objects));
        $this->assertInstanceOf(PersonalDeliveryProcessor::class, $objects[0]);
        $this->assertInstanceOf(PersonalDeliveryExpressProcessor::class, $objects[1]);
        $this->assertInstanceOf(EnterpriseDeliveryProcessor::class, $objects[2]);
        $this->assertInstanceOf(MarketingServiceInterface::class, $objects[1]->marketingService);

        $this->assertEquals(false, $objects[0]->isFromCampaign());
        $this->assertEquals(true, $objects[1]->isFromCampaign());
        $this->assertEquals(false, $objects[2]->isFromCampaign());
    }
}
