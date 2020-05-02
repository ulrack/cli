<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Tests\Component\Io;

use PHPUnit\Framework\TestCase;
use Ulrack\Cli\Common\Io\WriterInterface;
use Ulrack\Cli\Common\Theme\StyleEnum;
use Ulrack\Cli\Component\Io\Styler;

/**
 * @coversDefaultClass \Ulrack\Cli\Component\Io\Styler
 */
class StylerTest extends TestCase
{
    /**
     * @covers ::style
     * @covers ::__construct
     *
     * @return void
     */
    public function testStyle(): void
    {
        $writer = $this->createMock(WriterInterface::class);
        $subject = new Styler($writer);

        $styles = $this->createMock(StyleEnum::class);
        $styles->expects(static::once())
            ->method('__toString')
            ->willReturn('THIS_IS_A_STYLE');

        $writer->expects(static::once())
            ->method('write')
            ->with($this->stringContains('THIS_IS_A_STYLE'));

        $subject->style($styles);
    }
}
