<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Standard\Scalars;

/**
 * The Float standard scalar implementation.
 *
 * @see http://facebook.github.io/graphql/#sec-Float
 */
class FloatType extends AnyType
{
    /**
     * The Float scalar public name constant.
     * This name will be used in the future as
     * the type name available for use in our GraphQL schema.
     */
    protected const TYPE_NAME = 'Float';

    /**
     * Short Float scalar public description.
     */
    protected const TYPE_DESCRIPTION = 'The `Float` scalar type represents signed double-precision fractional
values as specified by [IEEE 754](http://en.wikipedia.org/wiki/IEEE_floating_point).';
}
