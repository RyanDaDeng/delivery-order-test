<?php
/**
 * Created by PhpStorm.
 * User: rayndeng
 * Date: 4/3/19
 * Time: 4:32 PM.
 */

namespace TimeHunter\DeliveryOrderTest\DeliveryOrderModule\Factories;

use TimeHunter\DeliveryOrderTest\MarketingModule\Services\MarketingService;
use TimeHunter\DeliveryOrderTest\ThirdPartyModule\Services\ThirdPartyApiService;
use TimeHunter\DeliveryOrderTest\DeliveryOrderModule\DeliveryOrderProcessors\PersonalDeliveryProcessor;
use TimeHunter\DeliveryOrderTest\DeliveryOrderModule\DeliveryOrderProcessors\EnterpriseDeliveryProcessor;
use TimeHunter\DeliveryOrderTest\DeliveryOrderModule\DeliveryOrderProcessors\AbstractDeliveryOrderProcessor;
use TimeHunter\DeliveryOrderTest\DeliveryOrderModule\DeliveryOrderProcessors\PersonalDeliveryExpressProcessor;

class DeliveryOrderProcessorFactory
{
    const ENTERPRISE_DELIVERY = 'enterpriseDelivery';
    const PERSONAL_DELIVERY = 'personalDelivery';
    const PERSONAL_DELIVERY_EXPRESS = 'personalDeliveryExpress';

    /**
     * @param $json
     * @return null|AbstractDeliveryOrderProcessor
     */
    public static function makeByJson($json)
    {
        $data = json_decode($json, 1);

        return self::create($data);
    }

    /**
     * @param $data
     * @return null|AbstractDeliveryOrderProcessor
     */
    public static function makeByArray($data)
    {
        return self::create($data);
    }

    /**
     * @param $data
     * @return AbstractDeliveryOrderProcessor| null
     */
    private static function create($data)
    {
        $type = $data['deliveryType'];
        $marketingService = new MarketingService();
        $object = null;
        switch ($type) {
            case self::ENTERPRISE_DELIVERY:
                $object = new EnterpriseDeliveryProcessor(new ThirdPartyApiService(), $data, $marketingService);
                break;
            case self::PERSONAL_DELIVERY:
                $object = new PersonalDeliveryProcessor($data, $marketingService);
                break;
            case self::PERSONAL_DELIVERY_EXPRESS:
                $object = new PersonalDeliveryExpressProcessor($data, $marketingService);
                break;
        }

        return $object;
    }
}
