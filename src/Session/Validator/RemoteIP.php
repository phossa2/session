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

namespace Phossa2\Session\Validator;

use Phossa2\Shared\Base\ObjectAbstract;
use Phossa2\Session\Interfaces\ValidatorInterface;

/**
 * RemoteIp
 *
 * Check remote ip is allowed or not
 *
 * @package Phossa2\package
 * @author  Hong Zhang <phossa@126.com>
 * @see     ObjectAbstract
 * @see     ValidatorInterface
 * @version 2.1.0
 * @since   2.1.0 added
 */
class RemoteIp extends ObjectAbstract implements ValidatorInterface
{
    /**
     * Allowed ip patterns
     *
     * @var    array
     * @access protected
     */
    protected $allowed;

    /**
     * Denied ip patterns
     *
     * @var    array
     * @access protected
     */
    protected $denied;

    /**
     * Inject allowed or denied ip patterns like '216.110.124.0/24' etc.
     *
     * @param  array $denied
     * @param  array $allowed
     * @access protected
     */
    public function __construct(array $denied = [], array $allowed = [])
    {
        $this->allowed = $this->processPattern($allowed);
        $this->denied = $this->processPattern($denied);
    }

    /**
     * {@inheritDoc}
     */
    public function validate()/*# : bool */
    {
        $ip = $_SERVER['REMOTE_ADDR'];

        // allowed ?
        if ($this->matchIp($ip, $this->allowed)) {
            return true;
        }

        // blocked ?
        if ($this->matchIp($ip, $this->denied)) {
            return false;
        }

        return empty($this->allowed) ? true : false;
    }

    /**
     * Match ip with patterns
     *
     * @param  string $ip
     * @param  array $patterns
     * @return boolean
     * @access protected
     */
    protected function matchIp(/*# string */ $ip, array $patterns)/*# : bool */
    {
        $num = ip2long($ip);
        foreach ($patterns as $pat) {
            if ($num & $pat[1] == $pat[0]) {
                return true;
            }
        }
        return false;
    }

    /**
     * Pre-process ip matching pattern
     *
     * @param  array $patterns
     * @return array
     * @access protected
     */
    protected function processPattern(array $patterns)/*# : array */
    {
        $result = [];
        foreach ($patterns as $pat) {
            $part = explode('/', $pat);
            $addr = ip2long($part[0]);
            $mask = isset($part[1]) ? ((int) $part[1]) : 32;

            // fix
            $mask = $this->getMask($mask);
            $addr = ip2long($addr) & $mask;

            $result[] = [$addr, $mask];
        }
        return $result;
    }

    /**
     * Convert mask length to mask in decimal
     *
     * @param  int $length
     * @return int
     * @access protected
     */
    protected function getMask(/*# int */ $length = 32)/*# : int */
    {
        $bin = substr(str_repeat('1', $length) . str_repeat('0', 32), 0, 32);
        return bindec($bin);
    }
}
