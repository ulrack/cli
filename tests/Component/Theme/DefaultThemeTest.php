<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Tests\Component\Theme;

use PHPUnit\Framework\TestCase;
use Ulrack\Cli\Common\Generator\ThemeGeneratorInterface;
use Ulrack\Cli\Common\Theme\ThemeInterface;
use Ulrack\Cli\Component\Theme\DefaultTheme;

/**
 * @coversDefaultClass \Ulrack\Cli\Component\Theme\DefaultTheme
 */
class DefaultThemeTest extends TestCase
{
    /**
     * @covers ::getTheme
     * @covers ::__construct
     *
     * @return void
     */
    public function testGetTheme(): void
    {
        $themeGenerator = $this->createMock(ThemeGeneratorInterface::class);
        $subject = new DefaultTheme($themeGenerator);
        $this->assertInstanceOf(ThemeInterface::class, $subject->getTheme());
    }
}
