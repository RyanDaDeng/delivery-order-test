<?php
/**
 * Created by PhpStorm.
 * User: rayndeng
 * Date: 4/3/19
 * Time: 3:39 PM.
 */

namespace TimeHunter\DeliveryOrderTest\ThirdPartyModule\Services;

use TimeHunter\DeliveryOrderTest\ThirdPartyModule\Interfaces\ThirdPartyApiServiceInterface;

class ThirdPartyApiService implements ThirdPartyApiServiceInterface
{
    public function validateEnterprise($enterPrise)
    {
        return false;
    }
}
