<?php
/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Tests\Component\Element;

use PHPUnit\Framework\TestCase;
use Ulrack\Cli\Common\Io\WriterInterface;
use Ulrack\Cli\Common\Theme\StyleInterface;
use Ulrack\Cli\Component\Element\ExplainedListElement;

/**
 * @coversDefaultClass \Ulrack\Cli\Component\Element\ExplainedListElement
 */
class ExplainedListElementTest extends TestCase
{
    /**
     * @covers ::render
     * @covers ::addItem
     * @covers ::prepareArray
     * @covers ::__construct
     *
     * @return void
     */
    public function testRender(): void
    {
        $writer = $this->createMock(WriterInterface::class);
        $keyStyle = $this->createMock(StyleInterface::class);
        $descriptionStyle = $this->createMock(StyleInterface::class);
        $subject = new ExplainedListElement($writer, $keyStyle, $descriptionStyle);

        $description = 'foo';
        $keys = ['bar', 'baz'];

        $subject->addItem($description, ...$keys);

        $writer->expects(static::exactly(2))
            ->method('writeLine');

        $subject->render();
    }
}
