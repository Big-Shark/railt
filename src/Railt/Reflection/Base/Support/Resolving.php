<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Base\Support;

/**
 * Trait Resolving
 */
trait Resolving
{
    /**
     * @return $this
     */
    protected function resolve()
    {
        return $this;
    }
}
