<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Tests\Generator;

use PHPUnit\Framework\TestCase;
use Ulrack\Cli\Generator\FormGenerator;
use Ulrack\Cli\Common\Element\FormInterface;
use Ulrack\Cli\Common\Element\ElementInterface;
use Ulrack\Validator\Common\ValidatorInterface;
use Ulrack\Cli\Common\Io\OptionProviderInterface;
use Ulrack\Cli\Exception\NotInitializedException;
use Ulrack\Cli\Common\Element\Form\FieldInterface;
use Ulrack\Cli\Common\Factory\FormFactoryInterface;
use Ulrack\Cli\Common\Factory\ElementFactoryInterface;
use Ulrack\Cli\Common\Generator\FormGeneratorInterface;
use Ulrack\Cli\Common\Element\Form\FieldValidatorInterface;

/**
 * @coversDefaultClass \Ulrack\Cli\Generator\FormGenerator
 * @covers \Ulrack\Cli\Exception\NotInitializedException
 */
class FormGeneratorTest extends TestCase
{
    /**
     * @covers ::init
     * @covers ::__construct
     *
     * @return void
     */
    public function testInit(): void
    {
        $formFactory = $this->createMock(FormFactoryInterface::class);
        $elementFactory = $this->createMock(ElementFactoryInterface::class);
        $subject = new FormGenerator($formFactory, $elementFactory);

        $title = 'title';
        $description = 'description';

        $titleMock = $this->createMock(ElementInterface::class);
        $descriptionMock = $this->createMock(ElementInterface::class);

        $elementFactory->expects(static::exactly(2))
            ->method('createText')
            ->withConsecutive(
                [$title, true, 'title'],
                [$description, true, 'text']
            )->willReturnOnConsecutiveCalls(
                $titleMock,
                $descriptionMock
            );

        $formFactory->expects(static::once())
            ->method('createForm')
            ->with($titleMock, $descriptionMock)
            ->willReturn($this->createMock(FormInterface::class));

        $this->assertInstanceOf(
            FormGeneratorInterface::class,
            $subject->init($title, $description)
        );
    }

    /**
     * @covers ::reinit
     * @covers ::__construct
     * @covers ::preAddCheck
     * @covers ::getForm
     *
     * @return void
     */
    public function testReinit(): void
    {
        $formFactory = $this->createMock(FormFactoryInterface::class);
        $elementFactory = $this->createMock(ElementFactoryInterface::class);
        $subject = new FormGenerator($formFactory, $elementFactory);

        $form = $this->createMock(FormInterface::class);

        $this->assertInstanceOf(
            FormGeneratorInterface::class,
            $subject->reinit($form)
        );

        $this->assertSame($form, $subject->getForm());
    }

    /**
     * @covers ::__construct
     * @covers ::preAddCheck
     * @covers ::getForm
     *
     * @return void
     */
    public function testErrorCheck(): void
    {
        $formFactory = $this->createMock(FormFactoryInterface::class);
        $elementFactory = $this->createMock(ElementFactoryInterface::class);
        $subject = new FormGenerator($formFactory, $elementFactory);

        $this->expectException(NotInitializedException::class);

        $subject->getForm();
    }

    /**
     * @covers ::createValidator
     * @covers ::convertKeyToLabel
     * @covers ::preAddCheck
     * @covers ::addOpenField
     * @covers ::__construct
     *
     * @return void
     */
    public function testAddOpenField(): void
    {
        $formFactory = $this->createMock(FormFactoryInterface::class);
        $elementFactory = $this->createMock(ElementFactoryInterface::class);
        $subject = new FormGenerator($formFactory, $elementFactory);

        $name = 'first_name';
        $required = true;
        $errorMessage = 'This is a required field.';
        $additionalValidators = $this->createMock(ValidatorInterface::class);

        $form = $this->createMock(FormInterface::class);
        $subject->reinit($form);

        $label = $this->createMock(ElementInterface::class);

        $elementFactory->expects(static::once())
            ->method('createText')
            ->with('First Name*: ', false, 'label')
            ->willReturn($label);

        $elementFactory->expects(static::once())
            ->method('createBlock')
            ->with($errorMessage, 'error-block')
            ->willReturn($this->createMock(ElementInterface::class));

        $field = $this->createMock(FieldInterface::class);

        $formFactory->expects(static::once())
            ->method('createField')
            ->with($label)
            ->willReturn($field);

        $form->expects(static::once())
            ->method('addField')
            ->with(
                $name,
                $field,
                $this->isInstanceOf(FieldValidatorInterface::class)
            );


        $this->assertInstanceOf(
            FormGeneratorInterface::class,
            $subject->addOpenField(
                $name,
                $required,
                $errorMessage,
                $additionalValidators
            )
        );
    }

    /**
     * @covers ::createValidator
     * @covers ::convertKeyToLabel
     * @covers ::preAddCheck
     * @covers ::addHiddenField
     * @covers ::__construct
     *
     * @return void
     */
    public function testAddHiddenField(): void
    {
        $formFactory = $this->createMock(FormFactoryInterface::class);
        $elementFactory = $this->createMock(ElementFactoryInterface::class);
        $subject = new FormGenerator($formFactory, $elementFactory);

        $name = 'password';
        $required = false;
        $errorMessage = 'This is a required field.';
        $additionalValidators = $this->createMock(ValidatorInterface::class);

        $form = $this->createMock(FormInterface::class);
        $subject->reinit($form);

        $label = $this->createMock(ElementInterface::class);

        $elementFactory->expects(static::once())
            ->method('createText')
            ->with('Password(hidden): ', false, 'label')
            ->willReturn($label);

        $elementFactory->expects(static::once())
            ->method('createBlock')
            ->with($errorMessage, 'error-block')
            ->willReturn($this->createMock(ElementInterface::class));

        $field = $this->createMock(FieldInterface::class);

        $formFactory->expects(static::once())
            ->method('createObscuredField')
            ->with($label)
            ->willReturn($field);

        $form->expects(static::once())
            ->method('addField')
            ->with(
                $name,
                $field,
                $this->isInstanceOf(FieldValidatorInterface::class)
            );


        $this->assertInstanceOf(
            FormGeneratorInterface::class,
            $subject->addHiddenField(
                $name,
                $required,
                $errorMessage,
                $additionalValidators
            )
        );
    }

    /**
     * @covers ::createValidator
     * @covers ::convertKeyToLabel
     * @covers ::preAddCheck
     * @covers ::addAutocompletingField
     * @covers ::__construct
     *
     * @return void
     */
    public function testAddAutocompletingField(): void
    {
        $formFactory = $this->createMock(FormFactoryInterface::class);
        $elementFactory = $this->createMock(ElementFactoryInterface::class);
        $subject = new FormGenerator($formFactory, $elementFactory);

        $name = 'option';
        $options = [];
        $required = false;
        $errorMessageRequired = 'This is a required field.';
        $errorMessageEnum = 'The value must be in the options list.';
        $additionalValidators = $this->createMock(ValidatorInterface::class);

        $form = $this->createMock(FormInterface::class);
        $subject->reinit($form);

        $label = $this->createMock(ElementInterface::class);
        $listLabel = $this->createMock(ElementInterface::class);
        $chainLabel = $this->createMock(ElementInterface::class);

        $elementFactory->expects(static::once())
            ->method('createText')
            ->with('Option: ', false, 'label')
            ->willReturn($label);

        $elementFactory->expects(static::once())
            ->method('createList')
            ->with($options)
            ->willReturn($listLabel);

        $elementFactory->expects(static::once())
            ->method('createChain')
            ->with($label, $listLabel)
            ->willReturn($chainLabel);

        $elementFactory->expects(static::once())
            ->method('createBlock')
            ->with($errorMessageEnum, 'error-block')
            ->willReturn($this->createMock(ElementInterface::class));

        $field = $this->createMock(FieldInterface::class);

        $formFactory->expects(static::once())
            ->method('createAutocompletingField')
            ->with(
                $chainLabel,
                $this->isInstanceOf(OptionProviderInterface::class)
            )->willReturn($field);

        $form->expects(static::once())
            ->method('addField')
            ->with(
                $name,
                $field,
                $this->isInstanceOf(FieldValidatorInterface::class)
            );

        $this->assertInstanceOf(
            FormGeneratorInterface::class,
            $subject->addAutocompletingField(
                $name,
                $options,
                $required,
                $errorMessageRequired,
                $errorMessageEnum,
                $additionalValidators
            )
        );
    }

    /**
     * @covers ::createAdditionalMessage
     * @covers ::createValidator
     * @covers ::convertKeyToLabel
     * @covers ::preAddCheck
     * @covers ::addOpenArrayField
     * @covers ::__construct
     *
     * @return void
     */
    public function testAddOpenArrayField(): void
    {
        $formFactory = $this->createMock(FormFactoryInterface::class);
        $elementFactory = $this->createMock(ElementFactoryInterface::class);
        $subject = new FormGenerator($formFactory, $elementFactory);

        $name = 'name';
        $required = true;
        $errorMessage = 'This is a required field.';
        $additionalMessage = 'Add another value?';
        $additionalValidators = $this->createMock(ValidatorInterface::class);

        $form = $this->createMock(FormInterface::class);
        $subject->reinit($form);

        $label = $this->createMock(ElementInterface::class);
        $additionalLabel = $this->createMock(ElementInterface::class);

        $elementFactory->expects(static::exactly(2))
            ->method('createText')
            ->withConsecutive(
                ['Name*: ', false, 'label'],
                [$additionalMessage . ' (Y/n): ', false, 'label']
            )->willReturnOnConsecutiveCalls($label, $additionalLabel);

        $elementFactory->expects(static::once())
            ->method('createBlock')
            ->with($errorMessage, 'error-block')
            ->willReturn($this->createMock(ElementInterface::class));

        $field = $this->createMock(FieldInterface::class);

        $formFactory->expects(static::once())
            ->method('createArrayField')
            ->with($label, $additionalLabel)
            ->willReturn($field);

        $form->expects(static::once())
            ->method('addField')
            ->with(
                $name,
                $field,
                $this->isInstanceOf(FieldValidatorInterface::class)
            );


        $this->assertInstanceOf(
            FormGeneratorInterface::class,
            $subject->addOpenArrayField(
                $name,
                $required,
                'y',
                $additionalMessage,
                $errorMessage,
                $additionalValidators
            )
        );
    }

    /**
     * @covers ::createAdditionalMessage
     * @covers ::createValidator
     * @covers ::convertKeyToLabel
     * @covers ::preAddCheck
     * @covers ::addHiddenArrayField
     * @covers ::__construct
     *
     * @return void
     */
    public function testAddHiddenArrayField(): void
    {
        $formFactory = $this->createMock(FormFactoryInterface::class);
        $elementFactory = $this->createMock(ElementFactoryInterface::class);
        $subject = new FormGenerator($formFactory, $elementFactory);

        $name = 'password';
        $required = false;
        $errorMessage = 'This is a required field.';
        $additionalMessage = 'Add another value?';
        $additionalValidators = $this->createMock(ValidatorInterface::class);

        $form = $this->createMock(FormInterface::class);
        $subject->reinit($form);

        $label = $this->createMock(ElementInterface::class);
        $additionalLabel = $this->createMock(ElementInterface::class);

        $elementFactory->expects(static::exactly(2))
            ->method('createText')
            ->withConsecutive(
                ['Password(hidden): ', false, 'label'],
                [$additionalMessage . ' (Y/n): ', false, 'label']
            )->willReturnOnConsecutiveCalls($label, $additionalLabel);

        $elementFactory->expects(static::once())
            ->method('createBlock')
            ->with($errorMessage, 'error-block')
            ->willReturn($this->createMock(ElementInterface::class));

        $field = $this->createMock(FieldInterface::class);

        $formFactory->expects(static::once())
            ->method('createObscuredArrayField')
            ->with($label, $additionalLabel)
            ->willReturn($field);

        $form->expects(static::once())
            ->method('addField')
            ->with(
                $name,
                $field,
                $this->isInstanceOf(FieldValidatorInterface::class)
            );


        $this->assertInstanceOf(
            FormGeneratorInterface::class,
            $subject->addHiddenArrayField(
                $name,
                $required,
                'y',
                $additionalMessage,
                $errorMessage,
                $additionalValidators
            )
        );
    }

    /**
     * @covers ::createValidator
     * @covers ::convertKeyToLabel
     * @covers ::preAddCheck
     * @covers ::addAutocompletingArrayField
     * @covers ::__construct
     *
     * @return void
     */
    public function testAddAutocompletingArrayField(): void
    {
        $formFactory = $this->createMock(FormFactoryInterface::class);
        $elementFactory = $this->createMock(ElementFactoryInterface::class);
        $subject = new FormGenerator($formFactory, $elementFactory);

        $name = 'option';
        $options = [];
        $required = false;
        $additionalMessage = 'Add another value?';
        $errorMessageRequired = 'This is a required field.';
        $errorMessageEnum = 'The value must be in the options list.';
        $additionalValidators = $this->createMock(ValidatorInterface::class);

        $form = $this->createMock(FormInterface::class);
        $subject->reinit($form);

        $label = $this->createMock(ElementInterface::class);
        $listLabel = $this->createMock(ElementInterface::class);
        $chainLabel = $this->createMock(ElementInterface::class);
        $additionalLabel = $this->createMock(ElementInterface::class);

        $elementFactory->expects(static::exactly(2))
            ->method('createText')
            ->withConsecutive(
                ['Option: ', false, 'label'],
                [$additionalMessage . ' (Y/n): ', false, 'label']
            )->willReturn($label, $additionalLabel);

        $elementFactory->expects(static::once())
            ->method('createList')
            ->with($options)
            ->willReturn($listLabel);

        $elementFactory->expects(static::once())
            ->method('createChain')
            ->with($label, $listLabel)
            ->willReturn($chainLabel);

        $elementFactory->expects(static::once())
            ->method('createBlock')
            ->with($errorMessageEnum, 'error-block')
            ->willReturn($this->createMock(ElementInterface::class));

        $field = $this->createMock(FieldInterface::class);

        $formFactory->expects(static::once())
            ->method('createAutocompletingArrayField')
            ->with(
                $chainLabel,
                $additionalLabel,
                $this->isInstanceOf(OptionProviderInterface::class)
            )->willReturn($field);

        $form->expects(static::once())
            ->method('addField')
            ->with(
                $name,
                $field,
                $this->isInstanceOf(FieldValidatorInterface::class)
            );

        $this->assertInstanceOf(
            FormGeneratorInterface::class,
            $subject->addAutocompletingArrayField(
                $name,
                $options,
                $required,
                'y',
                $additionalMessage,
                $errorMessageRequired,
                $errorMessageEnum,
                $additionalValidators
            )
        );
    }
}
