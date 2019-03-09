<?php
/**
 * Created by PhpStorm.
 * User: rayndeng
 * Date: 4/3/19
 * Time: 3:39 PM.
 */

namespace TimeHunter\DeliveryOrderTest\DeliveryOrderModule\Services;

use TimeHunter\DeliveryOrderTest\DeliveryOrderModule\Factories\DeliveryOrderProcessorFactory;
use TimeHunter\DeliveryOrderTest\DeliveryOrderModule\DeliveryOrderProcessors\AbstractDeliveryOrderProcessor;

class DeliveryOrderService
{
    /**
     * @var AbstractDeliveryOrderProcessor[]
     */
    public $deliveryOrderCollections = [];

    /**
     * DeliveryOrderService constructor.
     * @param $json
     */
    public function __construct($json)
    {
        $this->processJson($json);
    }

    /**
     * @param AbstractDeliveryOrderProcessor $deliveryOrderProcessor
     */
    public function add(AbstractDeliveryOrderProcessor $deliveryOrderProcessor)
    {
        $this->deliveryOrderCollections[] = $deliveryOrderProcessor;
    }

    /**
     * @return AbstractDeliveryOrderProcessor[]
     */
    public function getDeliveryOrderCollections()
    {
        return $this->deliveryOrderCollections;
    }

    /**
     * @param $json
     */
    public function processJson($json)
    {
        $data = json_decode($json, 1);

        foreach ($data as $datum) {
            $this->add(DeliveryOrderProcessorFactory::makeByArray($datum));
        }
    }
}
