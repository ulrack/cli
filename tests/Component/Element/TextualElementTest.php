<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Tests\Component\Element;

use PHPUnit\Framework\TestCase;
use Ulrack\Cli\Common\Io\WriterInterface;
use Ulrack\Cli\Common\Theme\StyleInterface;
use Ulrack\Cli\Component\Element\TextualElement;

/**
 * @coversDefaultClass \Ulrack\Cli\Component\Element\TextualElement
 */
class TextualElementTest extends TestCase
{
    /**
     * @covers ::render
     * @covers ::__construct
     *
     * @return void
     */
    public function testRender(): void
    {
        $content = 'foo';
        $writer = $this->createMock(WriterInterface::class);
        $newLine = true;
        $style = $this->createMock(StyleInterface::class);
        $subject = new TextualElement($content, $writer, $newLine, $style);

        $writer->expects(static::once())
            ->method('write')
            ->with($content);

        $writer->expects(static::once())
            ->method('writeLine');

        $subject->render();
    }
}
