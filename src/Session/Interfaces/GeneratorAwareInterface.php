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

namespace Phossa2\Session\Interfaces;

/**
 * GeneratorAwareInterface
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.1.0
 * @since   2.1.0 added
 */
interface GeneratorAwareInterface
{
    /**
     * Set the id generator
     *
     * @param  GeneratorInterface $generator
     * @return $this
     * @access public
     */
    public function setGenerator(GeneratorInterface $generator = null);

    /**
     * Get a callable for id generating
     *
     * @return callable
     * @access public
     */
    public function getGenerator()/*# : callable */;
}
