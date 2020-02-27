<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Tests\Component\Element\Form;

use PHPUnit\Framework\TestCase;
use Ulrack\Cli\Common\Element\ElementInterface;
use Ulrack\Cli\Common\Element\Form\FieldInterface;
use Ulrack\Cli\Common\Io\ReaderInterface;
use Ulrack\Cli\Component\Element\Form\ArrayField;

/**
 * @coversDefaultClass \Ulrack\Cli\Component\Element\Form\ArrayField
 */
class ArrayFieldTest extends TestCase
{
    /**
     * @covers ::render
     * @covers ::getInput
     * @covers ::__construct
     *
     * @return void
     */
    public function testField(): void
    {
        $reader = $this->createMock(ReaderInterface::class);
        $label = $this->createMock(ElementInterface::class);
        $confirmationField = $this->createMock(FieldInterface::class);
        $subject = new ArrayField($reader, $label, 'a', $confirmationField);

        $reader->expects(static::exactly(2))
            ->method('read')
            ->willReturnOnConsecutiveCalls('foo', 'bar');

        $label->expects(static::exactly(2))
            ->method('render');

        $confirmationField->expects(static::exactly(3))
            ->method('render');

        $confirmationField->expects(static::exactly(3))
            ->method('getInput')
            ->willReturnOnConsecutiveCalls('', 'y', 'n');

        $subject->render();

        $this->assertEquals(['foo', 'bar'], $subject->getInput());
    }
}
