# PHPUnit Listener to debug slow tests

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/slowtests.svg?style=flat-square)](https://packagist.org/packages/spatie/slowtests)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/spatie/slowtests/run-tests?label=tests)](https://github.com/spatie/slowtests/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/slowtests.svg?style=flat-square)](https://packagist.org/packages/spatie/slowtests)


This is where your description should go. Try and limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require lvlup-dev/slowtests --dev
```

## Usage

Go to https://testeye.io/ and grab your project's token.

Register the extension in your phpunit.xml file :
```
<extensions>
    <extension class="Lvlup\SlowTests\TestEyeHook" />
</extensions>
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Credits

- [Didier Sampaolo](https://github.com/dsampaolo)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
