<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Base\Behavior;

use Railt\Reflection\Contracts\Behavior\Deprecatable;

/**
 * Trait BaseDeprecations
 * @mixin Deprecatable
 */
trait BaseDeprecations
{
    /**
     * @var string|null
     */
    protected $deprecationReason;

    /**
     * @return bool
     */
    public function isDeprecated(): bool
    {
        return $this->resolve()->deprecationReason !== null;
    }

    /**
     * @return string
     */
    public function getDeprecationReason(): string
    {
        return (string)$this->resolve()->deprecationReason;
    }
}
