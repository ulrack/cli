<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Tests\Component\Element;

use PHPUnit\Framework\TestCase;
use Ulrack\Cli\Common\Element\ElementInterface;
use Ulrack\Cli\Component\Element\ChainElement;

/**
 * @coversDefaultClass \Ulrack\Cli\Component\Element\ChainElement
 */
class ChainElementTest extends TestCase
{
    /**
     * @covers ::render
     * @covers ::__construct
     *
     * @return void
     */
    public function testRender(): void
    {
        $elements = $this->createMock(ElementInterface::class);
        $subject = new ChainElement($elements);

        $elements->expects(static::once())
            ->method('render');

        $subject->render();
    }
}
