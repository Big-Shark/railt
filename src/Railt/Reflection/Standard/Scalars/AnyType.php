<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Standard\Scalars;

use Railt\Reflection\Base\BaseScalar;
use Railt\Reflection\Contracts\Document;
use Railt\Reflection\Standard\StandardType;

/**
 * RFC325 Implementation.
 *
 * @see https://github.com/facebook/graphql/pull/325
 */
class AnyType extends BaseScalar implements StandardType
{
    /**
     * The Any scalar public name constant.
     * This name will be used in the future as the
     * type name available for use in our schema.
     */
    protected const TYPE_NAME = 'Any';

    /**
     * Short Any scalar public description.
     */
    protected const TYPE_DESCRIPTION = 'The `Any` scalar type represents any value that is supported by underlying
serialization protocol (including lists and maps). It is intended to be used
as an opt-out type in cases when the exact type is not known in advance.';

    /**
     * @param Document $document
     */
    public function __construct(Document $document)
    {
        $this->document = $document;
        $this->name = static::TYPE_NAME;
        $this->description = static::TYPE_DESCRIPTION;
    }
}
