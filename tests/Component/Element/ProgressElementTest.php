<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Tests\Component\Element;

use Iterator;
use ArrayIterator;
use IteratorAggregate;
use PHPUnit\Framework\TestCase;
use Ulrack\Task\Common\TaskInterface;
use Ulrack\Cli\Common\Io\WriterInterface;
use Ulrack\Task\Common\TaskListInterface;
use Ulrack\Cli\Common\Io\TerminalInterface;
use Ulrack\Cli\Common\Theme\StyleInterface;
use Ulrack\Cli\Component\Element\ProgressElement;

/**
 * @coversDefaultClass \Ulrack\Cli\Component\Element\ProgressElement
 */
class ProgressElementTest extends TestCase
{
    /**
     * @covers ::render
     * @covers ::generateProgressBar
     * @covers ::__construct
     *
     * @return void
     */
    public function testRender(): void
    {
        $writer = $this->createMock(WriterInterface::class);
        $progressCharacters = [
            'border' => [
                'left' => '[',
                'right' => ']',
            ],
            'progress' => [
                'done' => '=',
                'pending' => '-',
                'current' => '>',
            ],
        ];

        $terminal = $this->createMock(TerminalInterface::class);

        $taskList = (
            new class implements IteratorAggregate, TaskListInterface {
                /**
                 * Adds a task to the task list.
                 * Only implemented for testing, does not required to do anything.
                 *
                 * @param TaskInterface $task
                 * @param string $name
                 *
                 * @return void
                 */
                public function addTask(
                    TaskInterface $task,
                    string $name
                ): void {
                    echo $name;
                }

                /**
                 * Returns the iterator for testing.
                 *
                 * @return Iterator
                 */
                public function getIterator(): Iterator
                {
                    return new ArrayIterator([
                        'foo' => 20,
                        'bar' => 40,
                        'baz' => 60,
                        'qux' => 80,
                        'test' => 100
                    ]);
                }
            }
        );

        $style = $this->createMock(StyleInterface::class);
        $progressStyle = $this->createMock(StyleInterface::class);

        $subject = new ProgressElement(
            $writer,
            $progressCharacters,
            $terminal,
            $taskList,
            $style,
            $progressStyle
        );

        $terminal->expects(static::once())
            ->method('getWidth')
            ->willReturn(100);

        $writer->expects(static::exactly(5))
            ->method('overWrite');

        $writer->expects(static::once())
            ->method('writeLine');

        $subject->render();
    }
}
