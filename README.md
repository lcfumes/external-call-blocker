# External Call Blocker Library
[![Build Status](https://img.shields.io/travis/lcfumes/external-call-blocker/master.svg?style=flat-square)](https://travis-ci.org/lcfumes/external-call-blocker)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/lcfumes/external-call-blocker/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/lcfumes/external-call-blocker/?branch=master)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/lcfumes/external-call-blocker/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/lcfumes/external-call-blocker/?branch=master)
[![Latest Stable Version](https://img.shields.io/packagist/v/lcfumes/external-call-blocker.svg?style=flat-square)](https://packagist.org/packages/lcfumes/external-call-blocker)
[![Total Downloads](https://img.shields.io/packagist/dt/lcfumes/external-call-blocker.svg?style=flat-square)](https://packagist.org/packages/lcfumes/external-call-blocker)
[![License](https://img.shields.io/packagist/l/lcfumes/external-call-blocker.svg?style=flat-square)](https://packagist.org/packages/lcfumes/external-call-blocker)

## Instalation
The package is available on [Packagist](http://packagist.org/packages/lcfumes/external-call-blocker).
Autoloading is [PSR-4](https://github.com/php-fig/fig-standards/blob/lcfumes/accepted/PSR-4-autoloader.md) compatible.

```json
{
    "require": {
        "lcfumes/external-call-blocker": "dev-master"
    }
}
```


## Usage
---
##### Allowing calls
-
```php
use app\Blocker;

$domains = [".fumes.com.br", ".pedalize.com.br"];
$_SERVER["HTTP_REFERER"] = "http://www.fumes.com.br";
$blocker = new Blocker\Request($domains);

$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
$blocker->isAllowed($request); // TRUE

```

##### Blocking external calls
-
```php
use app\Blocker;

$domains = [".fumes.com.br", ".pedalize.com.br"];
$_SERVER["HTTP_REFERER"] = "http://www.anotherurl.com.br/";
$blocker = new Blocker\Request($domains);

$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
$blocker->isAllowed($request); // FALSE

// create and send a HTTP Response with 412 Status Code - Pre Conditional Failed
$blocker->block(); 

```

## License

MIT License
