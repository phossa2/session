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

Highlights
---

- Able to co-exists with other session libs or utilities including PHP session.

- Able to run [multiple sessions](#multiple) at the same time.

- Data seperation using [cartons](#carton).

- [Handler](#handler), [driver](#driver), [validator](#validator) support and
  dependency injection.

- [Middleware](#middleware) support.

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

Start the session, normally in your bootstrap file.

```php
use Phossa2\Session\Session;
use Phossa2\Session\Carton;

// start a 'global' session
$sessGlobal = new Session('global');

// set 'global' session as the default
Carton::setDefaultSession($sessGlobal);

// start another 'private' session at the same time
$sessPrivate = new Session('private');
```

Then in your code using session data,

```php
// a box using default session 'global'
$boxGlobal = new Carton();

// global counter
++$boxGlobal['counter'];

// another box named 'toy' using the private session
$boxPrivate = new Carton('toy', $sessPrivate);

// private counter
++$boxPrivate['counter'];
```

Features
---

- <a name="multiple"></a>**Multiple sessions supported**

  `Phossa2\Session\Session` uses its own infra-structure. It can co-exists with
  other session libs or PHP session. By default, it uses cookie as session id
  exchange protocol. Different session then use different cookies.

  ```php
  // use a cookie named 'one'
  $sessOne = new Session('one');

  // use a cookie named 'two'
  $sessTwo = new Session('two');
  ```

  Close or destroy one session has no influence on other sessions.

- <a name="carton"></a>**Data seperation using `Carton`**

  In PHP session, session data is stored the global variable `$_SESSION`. It
  provides storage only and there is no other utilities.

  `Phossa2\Session\Carton` is a sandbox for data. User may name a carton box
  instead of using the default name `'default'`. Or even attach to a different
  session instead of using the default session.

  ```php
  // box 1
  $boxOne = new Carton('one', $sessPrivate);
  $boxOne['drone'] = 2;

  // box 2
  $boxTwo = new Carton('two', $sessPrivate);
  $boxTwo['drone'] = 1;
  ```

  If either `$name` or `$session` is different, then the data is in different
  namespaces.

  By extending `Phossa2\Session\Carton`, user may even provide utilities, such
  as data locking, usage monitoring, access control etc.

- <a name="extend"></a>**Extending the library**

  **phossa2/session** refactoring most of the dependents into seperate classes.

  - <a name="handler"></a>**Session saving handler**

    Handler is implementing the most widely adopted `\SessionHandlerInterface`
    shipped in PHP. If no handler injected into session, it will utilize the
    `Phossa2\Session\Handler\FileHandler` by default.

    ```php
    use Phossa2\Session\Handler\StorageHandler;

    // use phossa2/storage as handler
    $session->setHandler(new StorageHandler($storage, '/tmp/session'));
    ```

  - <a name="driver"></a>**Session id exchange protocol**

    Driver is implementing `Phossa2\Session\Interfaces\DriverInterface`. By
    default, the `Phossa2\Session\Driver\CookieDriver` is used to `set/get/del`
    session id on the client side by using cookies.

    Users may write their own drivers to communicate with the client.

    ```php
    use My\Own\HeaderDriver;

    // stores session id in `X-My-Own-Session` header
    $session->setDriver(new HeaderDriver());
    ```

  - <a name="validator"></a>**Session validation**

    Multiple validators may be injected into session to do validation.

    ```php
    use Phossa2\Session\Validator\RemoteIp;

    $session->addValidator(new RemoteIp());
    ```

  - <a name="generator"></a>**Session id generator**

    By default, session id is generated by a built-in routine. User may use
    his own generator such as using `phossa2/uuid`.

    ```php
    use Phossa2\Session\Generator\UuidGenerator;

    $session->setGenerator(new UuidGenerator());
    ```

  - <a name="middleware"></a>**Middleware supported**
  
    Middleware of this lib can be found in
    [phossa2/middleware](https://github.com/phossa2/middleware)
  
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
