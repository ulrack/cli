<?php
/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Tests\Factory;

use PHPUnit\Framework\TestCase;
use Ulrack\Cli\Common\Element\ElementInterface;
use Ulrack\Cli\Common\Element\Form\FieldInterface;
use Ulrack\Cli\Common\Element\FormInterface;
use Ulrack\Cli\Common\Factory\IoFactoryInterface;
use Ulrack\Cli\Common\Io\OptionProviderInterface;
use Ulrack\Cli\Common\Theme\ThemeInterface;
use Ulrack\Cli\Factory\FormFactory;

/**
 * @coversDefaultClass \Ulrack\Cli\Factory\FormFactory
 */
class FormFactoryTest extends TestCase
{
    /**
     * @covers ::createForm
     * @covers ::__construct
     *
     * @return void
     */
    public function testCreateForm(): void
    {
        $ioFactory = $this->createMock(IoFactoryInterface::class);
        $theme = $this->createMock(ThemeInterface::class);
        $subject = new FormFactory($ioFactory, $theme);
        $description = $this->createMock(ElementInterface::class);

        $this->assertInstanceOf(
            FormInterface::class,
            $subject->createForm($description)
        );
    }

    /**
     * @covers ::createField
     * @covers ::__construct
     *
     * @return void
     */
    public function testCreateField(): void
    {
        $ioFactory = $this->createMock(IoFactoryInterface::class);
        $theme = $this->createMock(ThemeInterface::class);
        $subject = new FormFactory($ioFactory, $theme);
        $label = $this->createMock(ElementInterface::class);

        $this->assertInstanceOf(
            FieldInterface::class,
            $subject->createField($label)
        );
    }

    /**
     * @covers ::createObscuredField
     * @covers ::__construct
     *
     * @return void
     */
    public function testCreateObscuredField(): void
    {
        $ioFactory = $this->createMock(IoFactoryInterface::class);
        $theme = $this->createMock(ThemeInterface::class);
        $subject = new FormFactory($ioFactory, $theme);
        $label = $this->createMock(ElementInterface::class);

        $this->assertInstanceOf(
            FieldInterface::class,
            $subject->createObscuredField($label)
        );
    }

    /**
     * @covers ::createAutocompletingField
     * @covers ::__construct
     *
     * @return void
     */
    public function testCreateAutocompletingField(): void
    {
        $ioFactory = $this->createMock(IoFactoryInterface::class);
        $theme = $this->createMock(ThemeInterface::class);
        $subject = new FormFactory($ioFactory, $theme);
        $label = $this->createMock(ElementInterface::class);
        $optionProvider = $this->createMock(OptionProviderInterface::class);
        $style = 'foo';

        $this->assertInstanceOf(
            FieldInterface::class,
            $subject->createAutocompletingField(
                $label,
                $optionProvider,
                $style
            )
        );
    }

    /**
     * @covers ::createArrayField
     * @covers ::__construct
     *
     * @return void
     */
    public function testCreateArrayField(): void
    {
        $ioFactory = $this->createMock(IoFactoryInterface::class);
        $theme = $this->createMock(ThemeInterface::class);
        $subject = new FormFactory($ioFactory, $theme);
        $label = $this->createMock(ElementInterface::class);
        $extraLabel = $this->createMock(ElementInterface::class);

        $this->assertInstanceOf(
            FieldInterface::class,
            $subject->createArrayField($label, $extraLabel)
        );
    }

    /**
     * @covers ::createObscuredArrayField
     * @covers ::__construct
     *
     * @return void
     */
    public function testCreateObscuredArrayField(): void
    {
        $ioFactory = $this->createMock(IoFactoryInterface::class);
        $theme = $this->createMock(ThemeInterface::class);
        $subject = new FormFactory($ioFactory, $theme);
        $label = $this->createMock(ElementInterface::class);
        $extraLabel = $this->createMock(ElementInterface::class);

        $this->assertInstanceOf(
            FieldInterface::class,
            $subject->createObscuredArrayField(
                $label,
                $extraLabel
            )
        );
    }

    /**
     * @covers ::createAutocompletingArrayField
     * @covers ::__construct
     *
     * @return void
     */
    public function testCreateAutocompletingArrayField(): void
    {
        $ioFactory = $this->createMock(IoFactoryInterface::class);
        $theme = $this->createMock(ThemeInterface::class);
        $subject = new FormFactory($ioFactory, $theme);
        $label = $this->createMock(ElementInterface::class);
        $extraLabel = $this->createMock(ElementInterface::class);
        $optionProvider = $this->createMock(OptionProviderInterface::class);
        $style = 'foo';

        $this->assertInstanceOf(
            FieldInterface::class,
            $subject->createAutocompletingArrayField(
                $label,
                $extraLabel,
                $optionProvider,
                $style
            )
        );
    }
}
