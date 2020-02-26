<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Tests\Component\Element\Form;

use PHPUnit\Framework\TestCase;
use Ulrack\Cli\Common\Element\ElementInterface;
use Ulrack\Cli\Component\Element\Form\FieldValidator;
use Ulrack\Validator\Common\ValidatorInterface;

/**
 * @coversDefaultClass \Ulrack\Cli\Component\Element\Form\FieldValidator
 */
class FieldValidatorTest extends TestCase
{
    /**
     * @covers ::getError
     * @covers ::__construct
     *
     * @return void
     */
    public function testGetError(): void
    {
        $validator = $this->createMock(ValidatorInterface::class);
        $error = $this->createMock(ElementInterface::class);
        $subject = new FieldValidator($validator, $error);

        $this->assertEquals($error, $subject->getError());
    }

    /**
     * @covers ::__invoke
     * @covers ::__construct
     *
     * @return void
     */
    public function testInvoke(): void
    {
        $validator = $this->createMock(ValidatorInterface::class);
        $error = $this->createMock(ElementInterface::class);
        $subject = new FieldValidator($validator, $error);

        $data = 'foo';

        $validator->expects(static::once())
            ->method('__invoke')
            ->with($data)
            ->willReturn(true);

        $this->assertEquals(true, $subject->__invoke($data));
    }
}
