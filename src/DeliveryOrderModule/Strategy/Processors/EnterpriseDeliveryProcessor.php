<?php
/**
 * Created by PhpStorm.
 * User: rayndeng
 * Date: 4/3/19
 * Time: 3:21 PM.
 */

namespace TimeHunter\DeliveryOrderTest\Strategy\Processors;

use TimeHunter\DeliveryOrderTest\DeliveryOrderModule\Strategy\Interfaces\ProcessorInterface;
use TimeHunter\DeliveryOrderTest\ThirdPartyModule\Services\ThirdPartyApiService;

class EnterpriseDeliveryProcessor implements ProcessorInterface
{
    protected $thirdPartyApiService;
    private $rawData;

    public function __construct(ThirdPartyApiService $thirdPartyApiService, $data)
    {
        $this->thirdPartyApiService = $thirdPartyApiService;
        $this->rawData;
    }

    public function customValidation()
    {
        return $this->thirdPartyApiService->validateEnterprise($this->rawData['enterprise']);
    }

    public function handle()
    {
        //TODO implement its workflow
        return true;
    }

    public function before()
    {
        // TODO: Implement before() method.
    }

    public function getRawData()
    {
        return $this->rawData;
    }

    public function after()
    {
        // TODO: Implement after() method.
    }
}
