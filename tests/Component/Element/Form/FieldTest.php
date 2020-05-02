<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Tests\Component\Element\Form;

use PHPUnit\Framework\TestCase;
use Ulrack\Cli\Common\Element\ElementInterface;
use Ulrack\Cli\Common\Io\ReaderInterface;
use Ulrack\Cli\Component\Element\Form\Field;

/**
 * @coversDefaultClass \Ulrack\Cli\Component\Element\Form\Field
 */
class FieldTest extends TestCase
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
        $subject = new Field($reader, $label);

        $label->expects(static::once())
            ->method('render');

        $reader->expects(static::once())
            ->method('read')
            ->willReturn('foo');

        $subject->render();

        $this->assertEquals('foo', $subject->getInput());
    }
}
