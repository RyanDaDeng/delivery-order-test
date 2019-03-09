# DeliveryOrderTest

[![Coverage Status][ico-coverage]][link-coverage]
[![Build][ico-build]][link-build]
[![StyleCI][ico-styleci]][link-styleci]



## Description

The solution is written on Laravel framework.

## Installation

1. This is a Laravel composer package, you need to have a Laravel installed first.
2. Via Composer

``` bash
$ composer require timehunter/delivery-order-test
```

## Usage

## Question Analysis

Potential design patterns can be used for this problem: factory, template method and strategy

The problem can be categorised as the following points:

1. How to create different objects based on dynamic input value? e.g. “enterpriseDelivery” return EnterpriseDelivery object
 - use Factory pattern which encapsulates the logic of creating objects.
 
2. Different object should contain its own workflow and dependent services.
 - use Strategy pattern(interface) or template method(inheritance)
 
3. Domain driven design
 - Basically make the system as module based and each module has its own services. If there are any common interfaces, they can be shared across different module.
 - From the question mentioned, I can see there are three modules can be found: Delivery Order module, Third party module and Marketing module


## My solution

1. I use Template Method design pattern which is based on inheritance. It allows me modify parts of an algorithm by extending those parts in sub-classes.
2. I also use factory pattern to determine which type of delivery order object I need to return.

## Usage

````php
 $json = "[{},{},{}...{}]"; // the given sample json data
 $service = new DeliveryOrderService($json);
 $service->processJson()
````

## Testing

I. use PHPUnit
2. Mocking Interfaces for testing
3. Pass different json to test if the service returns the correct delivery type


[ico-coverage]: https://coveralls.io/repos/github/RyanDaDeng/delivery-order-test/badge.svg?branch=master&service=github
[ico-build]: https://travis-ci.org/RyanDaDeng/delivery-order-test.svg?branch=master
[ico-styleci]: https://github.styleci.io/repos/174629501/shield


[link-coverage]: https://coveralls.io/github/RyanDaDeng/delivery-order-test?branch=master
[link-build]: https://travis-ci.org/RyanDaDeng/delivery-order-test
[link-styleci]: https://github.styleci.io/repos/174629501