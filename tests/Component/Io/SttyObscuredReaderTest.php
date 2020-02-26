<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Tests\Component\Io;

use PHPUnit\Framework\TestCase;
use Ulrack\Cli\Common\Io\ReaderInterface;
use Ulrack\Cli\Component\Io\SttyObscuredReader;

/**
 * @coversDefaultClass \Ulrack\Cli\Component\Io\SttyObscuredReader
 */
class SttyObscuredReaderTest extends TestCase
{
    /**
     * @covers ::read
     * @covers ::__construct
     *
     * @return void
     */
    public function testRead(): void
    {
        $reader = $this->createMock(ReaderInterface::class);
        $subject = new SttyObscuredReader($reader);

        $reader->expects(static::once())
            ->method('read')
            ->willReturn('foo');

        $this->assertEquals('foo', $subject->read());
    }
}
