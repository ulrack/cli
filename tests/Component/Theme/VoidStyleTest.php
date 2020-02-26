<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Tests\Component\Theme;

use PHPUnit\Framework\TestCase;
use Ulrack\Cli\Component\Theme\VoidStyle;

/**
 * @coversDefaultClass \Ulrack\Cli\Component\Theme\VoidStyle
 */
class VoidStyleTest extends TestCase
{
    /**
     * @covers ::apply
     *
     * @return void
     */
    public function testApply(): void
    {
        $subject = new VoidStyle();
        $this->assertEquals(null, $subject->apply());
    }

    /**
     * @covers ::reset
     *
     * @return void
     */
    public function testReset(): void
    {
        $subject = new VoidStyle();

        $this->assertEquals(null, $subject->reset());
    }
}
