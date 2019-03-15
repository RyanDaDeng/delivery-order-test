<?php
/**
 * Created by PhpStorm.
 * User: rayndeng
 * Date: 15/3/19
 * Time: 10:56 AM.
 */

namespace TimeHunter\DeliveryOrderTest\DeliveryOrderModule\Strategy;

use TimeHunter\DeliveryOrderTest\MarketingModule\Interfaces\MarketingServiceInterface;
use TimeHunter\DeliveryOrderTest\DeliveryOrderModule\Strategy\Interfaces\ProcessorInterface;

class DeliveryService
{
    private $processor;
    private $marketingService;

    public function __construct(ProcessorInterface $processor, MarketingServiceInterface $marketingService)
    {
        $this->processor = $processor;
        $this->marketingService = $marketingService;
    }

    /**
     * @return bool
     */
    public function process()
    {
        if ($this->validate()) {
            $this->processor->before();
            $this->processor->handle();
            $this->processor->after();

            return true;
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function defaultValidator()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function validate()
    {
        return $this->defaultValidator() && $this->processor->customValidation();
    }

    /**
     * Check if the source from campaign.
     * @return bool
     */
    public function isFromCampaign()
    {
        return isset($this->rawData['campaign']);
    }

    /**
     * Logic after processed the handler.
     */
    public function after()
    {
        if ($this->isFromCampaign()) {
            $this->marketingService->process($this->processor->getRawData()['campaign']);
        }
    }
}
