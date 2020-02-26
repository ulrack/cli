<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Tests\Component\Theme;

use PHPUnit\Framework\TestCase;
use Ulrack\Cli\Common\Theme\StyleInterface;
use Ulrack\Cli\Component\Theme\Theme;

/**
 * @coversDefaultClass \Ulrack\Cli\Component\Theme\Theme
 */
class ThemeTest extends TestCase
{
    /**
     * @covers ::addStyle
     * @covers ::getStyle
     * @covers ::__construct
     *
     * @return void
     */
    public function testStyle(): void
    {
        $defaultStyle = $this->createMock(StyleInterface::class);
        $subject = new Theme($defaultStyle);
        $key = 'foo';
        $style = $this->createMock(StyleInterface::class);

        $subject->addStyle($key, $style);
        $this->assertEquals($style, $subject->getStyle($key));
    }

    /**
     * @covers ::addVariable
     * @covers ::getVariable
     * @covers ::__construct
     *
     * @return void
     */
    public function testVariable(): void
    {
        $defaultStyle = $this->createMock(StyleInterface::class);
        $subject = new Theme($defaultStyle);
        $key = 'foo';
        $value = 'bar';

        $subject->addVariable($key, $value);
        $this->assertEquals($value, $subject->getVariable($key));
    }
}
