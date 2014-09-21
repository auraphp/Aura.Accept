# Aura.Accept

Provides tools to negotiate `Accept*` headers between what is requested by the client and what is available from the server.

## Foreword

### Installation

This library requires PHP 5.3 or later, and has no userland dependencies.

It is installable and autoloadable via Composer as [aura/accept](https://packagist.org/packages/aura/accept).

Alternatively, [download a release](https://github.com/auraphp/Aura.Accept/releases) or clone this repository, then require or include its _autoload.php_ file.

### Quality

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/auraphp/Aura.Accept/badges/quality-score.png?b=develop-2)](https://scrutinizer-ci.com/g/auraphp/Aura.Accept/)
[![Code Coverage](https://scrutinizer-ci.com/g/auraphp/Aura.Accept/badges/coverage.png?b=develop-2)](https://scrutinizer-ci.com/g/auraphp/Aura.Accept/)
[![Build Status](https://travis-ci.org/auraphp/Aura.Accept.png?branch=develop-2)](https://travis-ci.org/auraphp/Aura.Accept)

To run the unit tests at the command line, issue `phpunit -c tests/unit/`. (This requires [PHPUnit][] to be available as `phpunit`.)

[PHPUnit]: http://phpunit.de/manual/

To run the [Aura.Di][] container configuration tests at the command line, go to the _tests/container_ directory and issue `./phpunit.sh`. (This requires [PHPUnit][] to be available as `phpunit` and [Composer][] to be available as `composer`.)

[Aura.Di]: https://github.com/auraphp/Aura.Di
[Composer]: http://getcomposer.org/

This library attempts to comply with [PSR-1][], [PSR-2][], and [PSR-4][]. If
you notice compliance oversights, please send a patch via pull request.

[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[PSR-4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md

### Community

To ask questions, provide feedback, or otherwise communicate with the Aura community, please join our [Google Group](http://groups.google.com/group/auraphp), follow [@auraphp on Twitter](http://twitter.com/auraphp), or chat with us on #auraphp on Freenode.


## Getting Started

### Instantiation

First, instantiate a _AcceptFactory_ object, then use it to create _Request_ and
_Response_ objects.

```php
<?php
use Aura\AcceptFactory;

$accept_factory = new AcceptFactory;
$accept = $accept_factory->newInstance($_SERVER);
?>
```

### Accept

> N.b. Accept headers can be kind of complicated. See the
> [HTTP Header Field Definitions](http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html)
> for more detailed information regarding quality factors, matching rules,
> and parameters extensions.

The _Accept_ object helps with negotiating acceptable media, charset,
encoding, and language values. There is one `$request->accept` sub-object for
each of them. Each has a `negotiate()` method.

Pass an array of available values to the `negotiate()` method to negotiate
between the acceptable values and the available ones. The return will be a
plain old PHP object with `$available` and `$acceptable` properties describing
highest-quality match.

```php
<?php
// assume the request indicates these Accept values (XML is best, then CSV,
// then anything else)
$_SERVER['HTTP_ACCEPT'] = 'application/xml;q=1.0,text/csv;q=0.5,*;q=0.1';

// create the request object
$request = $accept_factory->newInstance();

// assume our application has `application/json` and `text/csv` available
// as media types, in order of highest-to-lowest preference for delivery
$available = array(
    'application/json',
    'text/csv',
);

// get the best match between what the request finds acceptable and what we
// have available; the result in this case is 'text/csv'
$media = $request->accept->media->negotiate($available);
echo $media->available->getValue(); // text/csv
?>
```

If the requested URL ends in a recognized file extension for a media type,
the _Accept\Media_ object will use that file extension instead of the explicit
`Accept` header value to determine the acceptable media type for the
request:

```php
<?php
// assume the request indicates these Accept values (XML is best, then CSV,
// then anything else)
$_SERVER['HTTP_ACCEPT'] = 'application/xml;q=1.0,text/csv;q=0.5,*;q=0.1';

// assume also that the request URI explicitly notes a .json file extension
$_SERVER['REQUEST_URI'] = '/path/to/entity.json';

// create the request object
$request = $accept_factory->newInstance();

// assume our application has `application/json` and `text/csv` available
// as media types, in order of highest-to-lowest preference for delivery
$available = array(
    'application/json',
    'text/csv',
);

// get the best match between what the request finds acceptable and what we
// have available; the result in this case is 'application/json' because of
// the file extenstion overriding the Accept header values
$media = $request->accept->media->negotiate($available);
echo $media->available->getValue(); // application/json
?>
```

See the _Accept\Media_ class file for the list of what file extensions map to
what media types. To set your own mappings, set up the _AcceptFactory_ object
first, then create the _Request_ object:

```php
<?php
$accept_factory->setTypes(array(
    '.foo' => 'application/x-foo-content-type',
));

$request = $accept_factory->newInstance();
?>
```

If the acceptable values indicate additional parameters, you can match on those as well:

```php
<?php
// assume the request indicates these Accept values (XML is best, then CSV,
// then anything else)
$_SERVER['HTTP_ACCEPT'] = 'text/html;level=1;q=0.5,text/html;level=3';

// create the request object
$request = $accept_factory->newInstance();

// assume our application has `application/json` and `text/csv` available
// as media types, in order of highest-to-lowest preference for delivery
$available = array(
    'text/html;level=1',
    'text/html;level=2',
);

// get the best match between what the request finds acceptable and what we
// have available; the result in this case is 'text/html;level=1'
$media = $request->accept->media->negotiate($available);
echo $media->available->getValue(); // text/html
var_dump($media->available->getParameters()); // array('level' => '1')
?>
```

> N.b. Parameters in the acceptable values that are not present in the
> available values will not be used for matching.

