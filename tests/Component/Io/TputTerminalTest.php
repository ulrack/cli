<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Tests\Component\Io;

use PHPUnit\Framework\TestCase;
use Ulrack\Cli\Component\Io\TputTerminal;

/**
 * @coversDefaultClass \Ulrack\Cli\Component\Io\TputTerminal
 */
class TputTerminalTest extends TestCase
{
    /**
     * @covers ::getHeight
     *
     * @return void
     */
    public function testGetHeight(): void
    {
        $subject = new TputTerminal();

        $this->assertIsInt($subject->getHeight());
    }

    /**
     * @covers ::getWidth
     *
     * @return void
     */
    public function testGetWidth(): void
    {
        $subject = new TputTerminal();

        $this->assertIsInt($subject->getWidth());
    }
}
