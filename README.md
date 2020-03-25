# Gemz Useragent Parser

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gemz/useragent.svg?style=flat-square)](https://packagist.org/packages/gemz/useragent)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/gemzio/useragent/run-tests?label=tests)](https://github.com/gemzio/useragent/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Quality Score](https://img.shields.io/scrutinizer/g/gemzio/useragent.svg?style=flat-square)](https://scrutinizer-ci.com/g/gemzio/useragent)
[![Total Downloads](https://img.shields.io/packagist/dt/gemz/useragent.svg?style=flat-square)](https://packagist.org/packages/gemz/useragent)


This package uses the [Piwik Device Detector Package](https://github.com/matomo-org/device-detector) and builds a
thin wrapper around it.

## Installation

You can install the package via composer:

```bash
composer require gemz/useragent
```

## Usage

``` php
use Gemz\Useragent;

// static instantiation
$parser = Useragent::agent($string);

// object instantiation
$parser = new Useragent($string);

// Get Result
$result = $parser->result(); // returns array

[
    'isBot' => false, 
    'browserType' => 'browser',
    'browserEngine' => 'Blink',
    'browserName' => 'Chrome',
    'browserVersion' => '79.0',
    'device' => 'desktop',
    'deviceModel' => '',
    'deviceBrand' => '', 
    'os' => 'Mac',
    'isMobile' => false,
]

// Set a new useragent
$result = $parser
    ->for($string)
    ->result();
    
// If you need full access to the piwik device detector instance 
$detector = $parser->parser(); // returns DeviceDetector\DeviceDetector;
$detector->... 
```

### Testing

``` bash
# unit tests
composer test

# you'll need a driver for code coverage
composer test-coverage
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email stefan@sriehl.com instead of using the issue tracker.

## Credits

- [Stefan Riehl](https://github.com/stefanriehl)

## Support us

Gemz.io is maintained by [Stefan Riehl](https://github.com/stefanriehl). You'll find all open source
projects on [Gemz.io github](https://github.com/gemzio).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
