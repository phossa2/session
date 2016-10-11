<?php
/**
 * Phossa Project
 *
 * PHP version 5.4
 *
 * @category  Library
 * @package   Phossa2\Session
 * @copyright Copyright (c) 2016 phossa.com
 * @license   http://mit-license.org/ MIT License
 * @link      http://www.phossa.com/
 */
/*# declare(strict_types=1); */

namespace Phossa2\Session\Traits;

use Phossa2\Session\Interfaces\GeneratorInterface;
use Phossa2\Session\Interfaces\GeneratorAwareInterface;

/**
 * GeneratorAwareTrait
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @see     GeneratorAwareInterface
 * @version 2.1.0
 * @since   2.1.0 added
 */
trait GeneratorAwareTrait
{
    /**
     * @var    callable
     * @access protected
     */
    protected $generator;

    /**
     * {@inheritDoc}
     */
    public function setGenerator(GeneratorInterface $generator = null)
    {
        if (null === $generator) {
            $this->generator = function () {
                return md5(microtime(true) + rand(1, 10000));
            };
        } else {
            $this->generator = [$generator, 'generate'];
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getGenerator()/*# : callable */
    {
        return $this->generator;
    }
}
