<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Base\Behavior;

use Railt\Reflection\Contracts\Behavior\AllowsTypeIndication;
use Railt\Reflection\Contracts\Types\NamedTypeInterface;

/**
 * Trait BaseTypeIndicator
 * @mixin AllowsTypeIndication
 */
trait BaseTypeIndicator
{
    /**
     * @var NamedTypeInterface
     */
    protected $type;

    /**
     * @var bool
     */
    protected $isNonNull = false;

    /**
     * @var bool
     */
    protected $isList = false;

    /**
     * @var bool
     */
    protected $isNonNullList = false;

    /**
     * @return NamedTypeInterface
     * @throws \Railt\Reflection\Exceptions\TypeNotFoundException
     */
    public function getType(): NamedTypeInterface
    {
        return $this->resolve()->type;
    }

    /**
     * @param NamedTypeInterface $type
     * @return void
     */
    public function setType(NamedTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * @param AllowsTypeIndication $other
     * @return bool
     */
    public function canBeOverridenBy(AllowsTypeIndication $other): bool
    {
        if ($other instanceof AllowsTypeIndication) {
            $this->resolve();

            return $this->isAllowedContainerInheritance($other);
        }

        return false;
    }

    /**
     * @todo Implementation requires resolving of #369
     * @see https://github.com/facebook/graphql/issues/369
     *
     * @param AllowsTypeIndication $other
     * @return bool
     */
    private function isAllowedContainerInheritance(AllowsTypeIndication $other): bool
    {
        $same =
            $other->isList() === $this->isList() &&
            $other->isNonNull() === $this->isNonNull() &&
            $other->isNonNullList() === $this->isNonNullList();

        if ($same) {
            return true;
        }

        switch (true) {
            // field: Type
            case ! $this->isNonNull && ! $this->isList && ! $this->isNonNullList:
                return ! $other->isList();

            // field: [Type]
            case ! $this->isNonNull && $this->isList && ! $this->isNonNullList:
                return $other->isList();


            // field: Type!
            case $this->isNonNull && ! $this->isList && ! $this->isNonNullList:
                return false;
            // field: [Type!]!
            case $this->isNonNull && $this->isList && $this->isNonNullList:
                return false;


            // field: [Type!]
            case $this->isNonNull && $this->isList && ! $this->isNonNullList:
                return $other->isNonNullList() && $other->isNonNull();
            // field: [Type]!
            case ! $this->isNonNull && $this->isList && $this->isNonNullList:
                return $other->isNonNullList() && $other->isNonNull();
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isList(): bool
    {
        return $this->resolve()->isList;
    }

    /**
     * @return bool
     */
    public function isNonNull(): bool
    {
        return $this->resolve()->isNonNull;
    }

    /**
     * @return bool
     */
    public function isNonNullList(): bool
    {
        return $this->resolve()->isList && $this->isNonNullList;
    }

    /**
     * @return bool
     */
    private function isNullable(): bool
    {
        return ! ($this->isNonNull() || $this->isNonNullList());
    }
}
