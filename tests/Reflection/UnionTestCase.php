<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Tests\Reflection;

use Railt\Reflection\Contracts\Document;
use Railt\Reflection\Contracts\Types\UnionType;

/**
 * Class UnionTestCase
 */
class UnionTestCase extends AbstractReflectionTestCase
{
    /**
     * @return array
     * @throws \Psr\Cache\InvalidArgumentException
     * @throws \Railt\Parser\Exceptions\CompilerException
     * @throws \Railt\Parser\Exceptions\UnexpectedTokenException
     * @throws \Railt\Parser\Exceptions\UnrecognizedTokenException
     */
    public function provider(): array
    {
        $schema = '"""This is an example union"""' .
            'union Person = | User | Bot ' .
            'type User {}' .
            'type Bot {}';

        return $this->dataProviderDocuments($schema);
    }

    /**
     * @dataProvider provider
     *
     * @param Document $document
     * @return void
     * @throws \PHPUnit\Framework\AssertionFailedError
     * @throws \PHPUnit\Framework\Exception
     */
    public function testUnionDefinition(Document $document): void
    {
        /** @var UnionType $union */
        $union = $document->getType('Person');
        static::assertNotNull($union);

        static::assertEquals('Person', $union->getName());
        static::assertEquals('This is an example union', $union->getDescription());

        static::assertEquals('Union', $union->getTypeName());

        static::assertFalse($union->isDeprecated());
        static::assertSame('', $union->getDeprecationReason());
        static::assertCount(0, $union->getDirectives());
        static::assertNull($union->getDirective('deprecated'));
        static::assertFalse($union->hasDirective('deprecated'));
        static::assertSame(0, $union->getNumberOfDirectives());
    }

    /**
     * @dataProvider provider
     *
     * @param Document $document
     * @return void
     * @throws \PHPUnit\Framework\AssertionFailedError
     */
    public function testUnionRelations(Document $document): void
    {
        /** @var UnionType $union */
        $union = $document->getType('Person');
        static::assertNotNull($union);

        static::assertSame(2, $union->getNumberOfTypes());
        static::assertNotNull($union->getType('User'));
        static::assertNotNull($union->getType('Bot'));
        static::assertNull($union->getType('user'));
        static::assertNull($union->getType('bot'));

        static::assertSame('User', $union->getType('User')->getName());
        static::assertSame('Object', $union->getType('User')->getTypeName());
        static::assertSame('Bot', $union->getType('Bot')->getName());
        static::assertSame('Object', $union->getType('Bot')->getTypeName());
    }
}
