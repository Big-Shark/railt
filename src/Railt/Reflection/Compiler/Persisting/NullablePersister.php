<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Compiler\Persisting;

use Railt\Reflection\Contracts\Document;
use Railt\Support\Filesystem\ReadableInterface;

/**
 * Class NullablePersister
 */
class NullablePersister implements Persister
{
    /**
     * @param ReadableInterface $readable
     * @param \Closure $then
     * @return Document
     */
    public function remember(ReadableInterface $readable, \Closure $then): Document
    {
        return $then($readable);
    }
}
