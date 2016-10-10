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
 * GeneratorInterface
 *
 * Session id generator
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.1.0
 * @since   2.1.0 added
 */
interface GeneratorInterface
{
    /**
     * Generate a new session id
     *
     * @return string
     * @access public
     * @api
     */
    public function generate()/*# : string */;
}
