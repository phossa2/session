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

namespace Phossa2\Session\Generator;

use Phossa2\Uuid\Uuid;
use Phossa2\Shared\Base\ObjectAbstract;
use Phossa2\Session\Interfaces\GeneratorInterface;

/**
 * UuidGenerator
 *
 * Generating new session using phossa2/uuid
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @see     ObjectAbstract
 * @see     GeneratorInterface
 * @version 2.1.0
 * @since   2.1.0 added
 */
class UuidGenerator extends ObjectAbstract implements GeneratorInterface
{
    /**
     * {@inheritDoc}
     *
     * @see    GeneratorInterface::generate()
     */
    public function generate()/*# : string */
    {
        return Uuid::get(Uuid::TYPE_SESSION);
    }
}
