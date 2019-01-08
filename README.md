# Recsys Common

**Core components for the Recsys PHP payment processing library**

[![Build Status](https://www.travis-ci.org/RecsysIntegration/common.svg?branch=master)](https://www.travis-ci.org/RecsysIntegration/common)

Recsys is a framework agnostic, multi-gateway recsys processing library for PHP.This package implements common classes required by Recsys.

## Installing

```shell
$ composer require recsys/common -vvv
```

## Usage

Build your own gateway
```php
<?php
namespace Recsys;

use Recsys\Common\AbstractGateway;

class TestGateway extends AbstractGateway
{
    // Report multi-items
    public function reportItems(array $parameters)
    {
        ...
    }
    
    // Report one item
    public function reportItem(array $parameter)
    {
        ...
    }
    
    // Remove multi-items
    public function removeItems(array $itemIds)
    {
        ...
    }
    
    // Remove one item
    public function removeItem($itemId)
    {
        ...
    }
    
    // Search multi-items
    public function findItems(array $itemIds)
    {
        ...
    }
    
    // Search one item
    public function findItem($itemId)
    {
        ...
    }
    
    // Report user multi-actions
    public function reportActions(array $parameters)
    {
        ...
    }
    
    // Report user one action
    public function reportAction($parameter)
    {
        ...
    }
    
    // Get a recommend result
    public function recommend(array $parameters)
    {
        ...
    }  
}
```

Build your own request
```php
<?php

namespace Recsys;

use Recsys\Common\Message\AbstractRequest;

class TestRequest extends AbstractRequest
{
    // Handle your data and return them
    public function getData()
    {
        ...
    }
    
    // Make a http request to remote api, return a response implements \Recsys\Common\Message\ResponseInterface
    public function sendData($data)
    {
        ...    
        
        return new TestResponse($this, $data);
    }
}
```

Build your own response
```php
<?php
namespace Recsys;

use Recsys\Common\Message\AbstractResponse;

class TestResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        ...
    }
}
```

Use TestGateway
```php
<?php

use Recsys\Recsys;
use Recsys\TestGateway;

$gateway = Recsys::create(TestGateway::class);

...

$response = $gateway->recommend($options);

if ($response->isSuccessful()) {
    print_r($response);
} else {
    ...
}
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.