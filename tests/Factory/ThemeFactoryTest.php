<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Tests\Factory;

use PHPUnit\Framework\TestCase;
use Ulrack\Cli\Common\Factory\IoFactoryInterface;
use Ulrack\Cli\Common\Theme\StyleEnum;
use Ulrack\Cli\Common\Theme\StyleInterface;
use Ulrack\Cli\Common\Theme\ThemeInterface;
use Ulrack\Cli\Factory\ThemeFactory;

/**
 * @coversDefaultClass \Ulrack\Cli\Factory\ThemeFactory
 */
class ThemeFactoryTest extends TestCase
{
    /**
     * @covers ::createStyle
     * @covers ::__construct
     *
     * @return void
     */
    public function testCreateStyle(): void
    {
        $ioFactory = $this->createMock(IoFactoryInterface::class);
        $subject = new ThemeFactory($ioFactory);
        $styles = $this->createMock(StyleEnum::class);

        $this->assertInstanceOf(
            StyleInterface::class,
            $subject->createStyle($styles)
        );
    }

    /**
     * @covers ::createTheme
     * @covers ::__construct
     *
     * @return void
     */
    public function testCreateTheme(): void
    {
        $ioFactory = $this->createMock(IoFactoryInterface::class);
        $subject = new ThemeFactory($ioFactory);

        $this->assertInstanceOf(
            ThemeInterface::class,
            $subject->createTheme()
        );
    }
}
