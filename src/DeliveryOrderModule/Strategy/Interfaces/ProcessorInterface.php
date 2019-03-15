<?php
/**
 * Created by PhpStorm.
 * User: rayndeng
 * Date: 15/3/19
 * Time: 10:50 AM
 */

namespace TimeHunter\DeliveryOrderTest\DeliveryOrderModule\Strategy\Interfaces;


interface ProcessorInterface
{

    public function before();

    public function getRawData();

    public function customValidation();

    public function handle();

    public function after();
}