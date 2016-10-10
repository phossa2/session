# phossa2/session
[![Build Status](https://travis-ci.org/phossa2/session.svg?branch=master)](https://travis-ci.org/phossa2/session)
[![Code Quality](https://scrutinizer-ci.com/g/phossa2/session/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/phossa2/session/)
[![Code Climate](https://codeclimate.com/github/phossa2/session/badges/gpa.svg)](https://codeclimate.com/github/phossa2/session)
[![PHP 7 ready](http://php7ready.timesplinter.ch/phossa2/session/master/badge.svg)](https://travis-ci.org/phossa2/session)
[![HHVM](https://img.shields.io/hhvm/phossa2/session.svg?style=flat)](http://hhvm.h4cc.de/package/phossa2/session)
[![Latest Stable Version](https://img.shields.io/packagist/vpre/phossa2/session.svg?style=flat)](https://packagist.org/packages/phossa2/session)
[![License](https://img.shields.io/:license-mit-blue.svg)](http://mit-license.org/)

**phossa2/session** is a session library for PHP.

It requires PHP 5.4, supports PHP 7.0+ and HHVM. It is compliant with [PSR-1][PSR-1],
[PSR-2][PSR-2], [PSR-3][PSR-3], [PSR-4][PSR-4], and the proposed [PSR-5][PSR-5].

[PSR-1]: http://www.php-fig.org/psr/psr-1/ "PSR-1: Basic Coding Standard"
[PSR-2]: http://www.php-fig.org/psr/psr-2/ "PSR-2: Coding Style Guide"
[PSR-3]: http://www.php-fig.org/psr/psr-3/ "PSR-3: Logger Interface"
[PSR-4]: http://www.php-fig.org/psr/psr-4/ "PSR-4: Autoloader"
[PSR-5]: https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md "PSR-5: PHPDoc"

Installation
---
Install via the `composer` utility.

```bash
composer require "phossa2/session"
```

or add the following lines to your `composer.json`

```json
{
    "require": {
       "phossa2/session": "2.*"
    }
}
```

Usage
---

Features
---

- <a name="anchor"></a>**Feature One**


APIs
---

- <a name="api"></a>`LoggerInterface` related

Change log
---

Please see [CHANGELOG](CHANGELOG.md) from more information.

Testing
---

```bash
$ composer test
```

Contributing
---

Please see [CONTRIBUTE](CONTRIBUTE.md) for more information.

Dependencies
---

- PHP >= 5.4.0

- phossa2/shared >= 2.0.21

License
---

[MIT License](http://mit-license.org/)
