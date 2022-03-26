# Aura.Accept

Provides content-negotiation tools using `Accept*` headers.

## Installation and Autoloading

This package is installable and PSR-4 autoloadable via Composer as
[aura/accept][].

Alternatively, [download a release][], or clone this repository, then map the
`Aura\Accept\` namespace to the package `src/` directory.

## Dependencies

This package requires PHP 7.2 or later. It has been tested on PHP 7.2 - 8.1. We recommend using the latest available version of PHP as a matter of principle.

Aura library packages may sometimes depend on external interfaces, but never on
external implementations. This allows compliance with community standards
without compromising flexibility. For specifics, please examine the package
[composer.json][] file.

### Quality

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/auraphp/Aura.Accept/badges/quality-score.png?b=4.x)](https://scrutinizer-ci.com/g/auraphp/Aura.Accept/)
[![codecov](https://codecov.io/gh/auraphp/Aura.Accept/branch/4.x/graph/badge.svg?token=UASDouLxyc)](https://codecov.io/gh/auraphp/Aura.Accept)
[![Continuous Integration](https://github.com/auraphp/Aura.Accept/actions/workflows/continuous-integration.yml/badge.svg?branch=4.x)](https://github.com/auraphp/Aura.Accept/actions/workflows/continuous-integration.yml)

To run the [PHPUnit](http://phpunit.de/manual/) unit tests at the command line, issue `composer install` and then `vendor/bin/phpunit` at the package root. This requires [Composer](http://getcomposer.org/) to be available as `composer`.

This library attempts to comply with [PSR-1][], [PSR-2][], and [PSR-4][]. If
you notice compliance oversights, please send a patch via pull request.

### Community

To ask questions, provide feedback, or otherwise communicate with the Aura community, please join our [Google Group](http://groups.google.com/group/auraphp), follow [@auraphp on Twitter](http://twitter.com/auraphp), or chat with us on #auraphp on Freenode.

## Documentation

This package is fully documented [here](./docs/index.md).

[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[PSR-4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md
[download a release]: https://github.com/auraphp/Aura.Accept/releases
[aura/accept]: https://packagist.org/packages/aura/accept
[composer.json]: ./composer.json