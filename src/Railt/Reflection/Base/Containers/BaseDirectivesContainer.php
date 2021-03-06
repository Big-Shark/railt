<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Base\Containers;

use Railt\Reflection\Contracts\Containers\HasDirectives;
use Railt\Reflection\Contracts\Types\Directive\DirectiveInvocation;
use Railt\Reflection\Contracts\Types\DirectiveType;

/**
 * Trait BaseDirectivesContainer
 * @mixin HasDirectives
 */
trait BaseDirectivesContainer
{
    /**
     * @var array|DirectiveInvocation[]
     */
    protected $directives = [];

    /**
     * @return iterable|DirectiveInvocation[]
     */
    public function getDirectives(): iterable
    {
        return \array_values($this->resolve()->directives);
    }

    /**
     * @param DirectiveInvocation $directive
     * @return void
     */
    public function addDirective(DirectiveInvocation $directive): void
    {
        $this->directives[$directive->getName()] = $directive;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasDirective(string $name): bool
    {
        return \array_key_exists($name, $this->resolve()->directives);
    }

    /**
     * @param string $name
     * @return null|DirectiveInvocation
     */
    public function getDirective(string $name): ?DirectiveInvocation
    {
        return $this->resolve()->directives[$name] ?? null;
    }

    /**
     * @return int
     */
    public function getNumberOfDirectives(): int
    {
        return \count($this->resolve()->directives);
    }
}
