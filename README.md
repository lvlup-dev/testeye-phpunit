# PHPUnit Hooks to keep an eye on your tests, via TestEye.io

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lvlup-dev/testeye-phpunit.svg?style=flat-square)](https://packagist.org/packages/lvlup-dev/testeye-phpunit)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/lvlup-dev/testeye-phpunit/run-tests?label=tests)](https://github.com/lvlup-dev/testeye-phpunit/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/lvlup-dev/testeye-phpunit.svg?style=flat-square)](https://packagist.org/packages/lvlup-dev/testeye-phpunit)


This is an extension for phpunit. It listens to your tests suites and upload your reports to [TestEye.io](https://testeye.io/).

## Installation

You can install the package via composer:

```bash
composer require lvlup-dev/testeye-phpunit --dev
```

## Usage

- Go to https://testeye.io/ and grab your project's token.
- Register the extension in your phpunit.xml file :
```
<extensions>
    <extension class="Lvlup\TestEye\TestEyeHook">
        <arguments>
                <string>YOUR_TOKEN_HERE</string>
                <string>https://testeye.io/report/phpunit</string>
        </arguments>
    </extension>
</extensions>
```
- Run your tests as usual, using ./vendor/bin/phpunit (it works with [pest](https://github.com/pestphp/pest/), too)
- Access your dashboard to see your report, in real-time.

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email didier@lvlup.fr instead of using the issue tracker.

## Credits

- [Didier Sampaolo](https://github.com/dsampaolo)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
