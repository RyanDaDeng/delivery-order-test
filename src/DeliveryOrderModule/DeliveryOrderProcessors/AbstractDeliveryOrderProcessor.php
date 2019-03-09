<?php
/**
 * Created by PhpStorm.
 * User: rayndeng
 * Date: 4/3/19
 * Time: 3:21 PM.
 */

namespace TimeHunter\DeliveryOrderTest\DeliveryOrderModule\DeliveryOrderProcessors;

use TimeHunter\DeliveryOrderTest\MarketingModule\Interfaces\MarketingServiceInterface;

abstract class AbstractDeliveryOrderProcessor
{
    public $rawData;
    public $marketingService;

    /**
     * AbstractDeliveryOrderProcessor constructor.
     * @param $data
     * @param MarketingServiceInterface $marketingService
     */
    public function __construct($data, MarketingServiceInterface $marketingService)
    {
        $this->rawData = $data;
        $this->marketingService = $marketingService;
    }

    /**
     * Pre-logic before processing the handler.
     */
    public function before()
    {
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
            $this->marketingService->process($this->rawData['campaign']);
        }
    }

    /**
     * @return bool
     */
    public function process()
    {
        if ($this->validate()) {
            $this->before();
            $this->handle();
            $this->after();

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
        return $this->defaultValidator() && $this->customValidation();
    }

    /**
     * @return bool
     */
    protected function customValidation()
    {
        return true;
    }

    /**
     * @return mixed
     */
    abstract protected function handle();

    /**
     * @return string
     */
    public function getRawData()
    {
        return $this->rawData;
    }
}
