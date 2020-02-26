<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Tests\Generator;

use PHPUnit\Framework\TestCase;
use Ulrack\Cli\Common\Theme\StyleEnum;
use Ulrack\Cli\Generator\ThemeGenerator;
use Ulrack\Cli\Common\Theme\StyleInterface;
use Ulrack\Cli\Common\Theme\ThemeInterface;
use Ulrack\Cli\Exception\NotInitializedException;
use Ulrack\Cli\Common\Factory\ThemeFactoryInterface;
use Ulrack\Cli\Common\Generator\ThemeGeneratorInterface;

/**
 * @coversDefaultClass \Ulrack\Cli\Generator\ThemeGenerator
 * @covers \Ulrack\Cli\Exception\NotInitializedException
 */
class ThemeGeneratorTest extends TestCase
{
    /**
     * @covers ::init
     * @covers ::__construct
     *
     * @return void
     */
    public function testInit(): void
    {
        $themeFactory = $this->createMock(ThemeFactoryInterface::class);
        $subject = new ThemeGenerator($themeFactory);

        $this->assertInstanceOf(ThemeGeneratorInterface::class, $subject->init());
    }

    /**
     * @covers ::reinit
     * @covers ::__construct
     * @covers ::getTheme
     * @covers ::preAddCheck
     *
     * @return void
     */
    public function testReinit(): void
    {
        $themeFactory = $this->createMock(ThemeFactoryInterface::class);
        $subject = new ThemeGenerator($themeFactory);

        $theme = $this->createMock(ThemeInterface::class);

        $this->assertInstanceOf(
            ThemeGeneratorInterface::class,
            $subject->reinit($theme)
        );

        $this->assertEquals($theme, $subject->getTheme());
    }

    /**
     * @covers ::reinit
     * @covers ::__construct
     * @covers ::getTheme
     * @covers ::preAddCheck
     *
     * @return void
     */
    public function testErrorCheck(): void
    {
        $themeFactory = $this->createMock(ThemeFactoryInterface::class);
        $subject = new ThemeGenerator($themeFactory);

        $this->expectException(NotInitializedException::class);

        $subject->getTheme();
    }

    /**
     * @covers ::addStyle
     * @covers ::reinit
     * @covers ::__construct
     * @covers ::preAddCheck
     *
     * @return void
     */
    public function testAddStyle(): void
    {
        $themeFactory = $this->createMock(ThemeFactoryInterface::class);
        $subject = new ThemeGenerator($themeFactory);
        $key = 'string';
        $styles = $this->createMock(StyleEnum::class);
        $theme = $this->createMock(ThemeInterface::class);
        $style = $this->createMock(StyleInterface::class);

        $themeFactory->expects(static::once())
            ->method('createStyle')
            ->with($styles)
            ->willReturn($style);

        $subject->reinit($theme);

        $theme->expects(static::once())
            ->method('addStyle')
            ->with($key, $style);

        $this->assertInstanceOf(
            ThemeGeneratorInterface::class,
            $subject->addStyle($key, $styles)
        );
    }

    /**
     * @covers ::addVariable
     * @covers ::reinit
     * @covers ::__construct
     * @covers ::preAddCheck
     *
     * @return void
     */
    public function testAddVariable(): void
    {
        $themeFactory = $this->createMock(ThemeFactoryInterface::class);
        $subject = new ThemeGenerator($themeFactory);

        $key = 'string';
        $value = 'value';

        $theme = $this->createMock(ThemeInterface::class);

        $subject->reinit($theme);

        $theme->expects(static::once())
            ->method('addVariable')
            ->with($key, $value);

        $this->assertInstanceOf(
            ThemeGeneratorInterface::class,
            $subject->addVariable($key, $value)
        );
    }
}
