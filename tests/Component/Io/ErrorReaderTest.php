<?php
/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Tests\Component\Io;

use PHPUnit\Framework\TestCase;
use Ulrack\Cli\Component\Io\ErrorReader;
use Ulrack\Cli\Exception\ReadingDisabledException;

/**
 * @coversDefaultClass \Ulrack\Cli\Component\Io\ErrorReader
 * @covers \Ulrack\Cli\Exception\ReadingDisabledException
 */
class ErrorReaderTest extends TestCase
{
    /**
     * @covers ::read
     *
     * @return void
     */
    public function testRead(): void
    {
        $subject = new ErrorReader();

        $this->expectException(ReadingDisabledException::class);

        $subject->read();
    }
}
