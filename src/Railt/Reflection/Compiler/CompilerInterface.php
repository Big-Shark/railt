<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Compiler;

use Hoa\Compiler\Llk\TreeNode;
use Railt\Reflection\Contracts\Document;
use Railt\Support\Filesystem\ReadableInterface;

/**
 * Class CompilerInterface
 */
interface CompilerInterface extends Dictionary
{
    /**
     * @param ReadableInterface $readable
     * @return Document
     */
    public function compile(ReadableInterface $readable): Document;

    /**
     * @param TreeNode $ast
     * @return string
     */
    public function dump(TreeNode $ast): string;
}
