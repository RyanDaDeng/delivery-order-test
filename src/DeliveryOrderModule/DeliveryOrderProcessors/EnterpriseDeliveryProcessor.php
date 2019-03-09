<?php
/**
 * Created by PhpStorm.
 * User: rayndeng
 * Date: 4/3/19
 * Time: 3:21 PM
 */

namespace TimeHunter\DeliveryOrderTest\DeliveryOrderModule\DeliveryOrderProcessors;


use TimeHunter\DeliveryOrderTest\MarketingModule\Interfaces\MarketingServiceInterface;
use TimeHunter\DeliveryOrderTest\ThirdPartyModule\Interfaces\ThirdPartyApiServiceInterface;

class EnterpriseDeliveryProcessor extends AbstractDeliveryOrderProcessor
{

    protected $thirdPartyApiService;

    public function __construct(ThirdPartyApiServiceInterface $thirdPartyApiService, $data, MarketingServiceInterface $marketingService)
    {
        parent::__construct($data, $marketingService);
        $this->thirdPartyApiService = $thirdPartyApiService;
    }

    protected function customValidation()
    {
        return $this->thirdPartyApiService->validateEnterprise($this->rawData['enterprise']);
    }

    protected function handle()
    {
        //TODO implement its workflow
        return true;
    }
}