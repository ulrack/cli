<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Component\Element;

use GrizzIt\Task\Common\TaskListInterface;
use Ulrack\Cli\Common\Io\WriterInterface;
use Ulrack\Cli\Component\Theme\VoidStyle;
use Ulrack\Cli\Common\Io\TerminalInterface;
use Ulrack\Cli\Common\Theme\StyleInterface;
use Ulrack\Cli\Common\Element\ElementInterface;

class ProgressElement implements ElementInterface
{
    /**
     * Contains the writer for the output.
     *
     * @var WriterInterface
     */
    private $writer;

    /**
     * Contains the characters for displaying the progress.
     *
     * @var array
     */
    private $progressCharacters;

    /**
     * Contains the style for the progress text.
     *
     * @var StyleInterface
     */
    private $style;

    /**
     * Contains the style for the progress bar.
     *
     * @var StyleInterface
     */
    private $progressStyle;

    /**
     * Contains the terminal reader.
     *
     * @var TerminalInterface
     */
    private $terminal;

    /**
     * Contains the task list used to determine the progress.
     *
     * @var TaskListInterface
     */
    private $taskList;

    /**
     * Constructor.
     *
     * @param WriterInterface $writer
     * @param array $progressCharacters
     * @param TerminalInterface $terminal
     * @param TaskListInterface $taskList
     * @param StyleInterface $style
     * @param StyleInterface $progressStyle
     */
    public function __construct(
        WriterInterface $writer,
        array $progressCharacters,
        TerminalInterface $terminal,
        TaskListInterface $taskList,
        StyleInterface $style = null,
        StyleInterface $progressStyle = null
    ) {
        $this->writer = $writer;
        $this->progressCharacters = $progressCharacters;
        $this->terminal = $terminal;
        $this->taskList = $taskList;
        $this->style = $style ?? new VoidStyle();
        $this->progressStyle = $progressStyle ?? new VoidStyle();
    }

    /**
     * Renders the element.
     *
     * @return void
     */
    public function render(): void
    {
        $maxWidth = $this->terminal->getWidth();
        $progressWidth = round($maxWidth * .6);
        foreach ($this->taskList as $name => $percentage) {
            $this->writer->overWrite(
                "\033[K" .
                $this->generateProgressBar($progressWidth, $percentage) .
                sprintf(
                    ' %s (%d%%)',
                    $name,
                    round($percentage, 1)
                )
            );
        }

        $this->writer->writeLine(
            "\033[K" .
            $this->generateProgressBar(
                $progressWidth,
                100
            ) . ' Done. (100%)'
        );
    }

    /**
     * Generates the progress bar.
     *
     * @param int $maxWidth
     * @param float $progress
     *
     * @return string
     */
    private function generateProgressBar(int $maxWidth, float $progress): string
    {
        $maxWidth = $maxWidth - 2;
        $innerProgress = 1;
        if ($progress > 0) {
            $innerProgress = round($maxWidth * ($progress / 100));
        }
        $leftOver = $maxWidth - $innerProgress;

        return $this->progressCharacters['border']['left'] .
        str_repeat(
            $this->progressCharacters['progress']['done'],
            $innerProgress
        ) .
        $this->progressCharacters['progress']['current'] .
        str_repeat(
            $this->progressCharacters['progress']['pending'],
            $leftOver
        ) .
        $this->progressCharacters['border']['right'];
    }
}
