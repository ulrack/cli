<?php
/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Tests\Component\Element;

use PHPUnit\Framework\TestCase;
use Ulrack\Cli\Common\Element\ElementInterface;
use Ulrack\Cli\Common\Element\Form\FieldInterface;
use Ulrack\Cli\Common\Element\Form\FieldValidatorInterface;
use Ulrack\Cli\Component\Element\FormElement;

/**
 * @coversDefaultClass \Ulrack\Cli\Component\Element\FormElement
 */
class FormElementTest extends TestCase
{
    /**
     * @covers ::addField
     * @covers ::render
     * @covers ::getInput
     * @covers ::__construct
     *
     * @return void
     */
    public function testRender(): void
    {
        $description = $this->createMock(ElementInterface::class);
        $subject = new FormElement($description);

        $name = 'foo';
        $field = $this->createMock(FieldInterface::class);
        $validator = $this->createMock(FieldValidatorInterface::class);

        $subject->addField($name, $field, $validator);

        $field->expects(static::exactly(2))
            ->method('render');

        $validator->expects(static::exactly(2))
            ->method('__invoke')
            ->with('bar')
            ->willReturnOnConsecutiveCalls(false, true);

        $field->expects(static::exactly(2))
            ->method('getInput')
            ->willReturn('bar');

        $subject->render();

        $this->assertEquals(['foo' => 'bar'], $subject->getInput());
    }
}
