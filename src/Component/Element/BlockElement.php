<?php
/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Component\Element;

use Ulrack\Cli\Common\Io\WriterInterface;
use Ulrack\Cli\Component\Theme\VoidStyle;
use Ulrack\Cli\Common\Io\TerminalInterface;
use Ulrack\Cli\Common\Theme\StyleInterface;
use Ulrack\Cli\Common\Element\ElementInterface;

class BlockElement implements ElementInterface
{
    /**
     * Contains the writer to display the block.
     *
     * @var WriterInterface
     */
    private $writer;

    /**
     * Contains the style of the block.
     *
     * @var StyleInterface
     */
    private $style;

    /**
     * The content which will be rendered in the block.
     *
     * @var string
     */
    private $content;

    /**
     * Clockwise padding, starting from the top.
     *
     * @var int[]
     */
    private $padding = [0, 0, 0, 0];

    /**
     * Clockwise margin, starting from the top.
     *
     * @var int[]
     */
    private $margin = [0, 0, 0, 0];

    /**
     * Contains the terminal reader.
     *
     * @var TerminalInterface
     */
    private $terminal;

    /**
     * Constructor.
     *
     * @param string $content
     * @param WriterInterface $writer
     * @param TerminalInterface $terminal
     * @param StyleInterface $style
     */
    public function __construct(
        string $content,
        WriterInterface $writer,
        TerminalInterface $terminal,
        StyleInterface $style = null
    ) {
        $this->content = $content;
        $this->writer = $writer;
        $this->terminal = $terminal;
        $this->style = $style ?? new VoidStyle();
    }

    /**
     * Renders the element.
     *
     * @return void
     */
    public function render(): void
    {
        $terminalWidth = $this->terminal->getWidth();
        [
            $paddingTop,
            $paddingRight,
            $paddingBottom,
            $paddingLeft,
            $marginTop,
            $marginRight,
            $marginBottom,
            $marginLeft
        ] = $this->calculateOffsets($terminalWidth - 1);

        for ($i = 0; $i < $marginTop; $i++) {
            $this->writer->writeLine('');
        }

        $innerSize = $terminalWidth - ($marginLeft + $marginRight);
        $contentSize = $innerSize - ($paddingLeft + $paddingRight);

        for ($i = 0; $i < $paddingTop; $i++) {
            $this->writer->write(str_repeat(' ', $marginLeft));
            $this->style->apply();
            if ($innerSize > 0) {
                $this->writer->write(str_repeat(' ', $innerSize));
            }
            $this->style->reset();
            $this->writer->writeLine('');
        }

        $expContent = explode(PHP_EOL, $this->content);
        $content = [];
        foreach ($expContent as $exp) {
            $content = array_merge($content, str_split($exp, $contentSize));
        }

        foreach ($content as $line) {
            $this->writer->write(str_repeat(' ', $marginLeft));
            $this->style->apply();

            $innerContent = str_repeat(' ', $paddingLeft) .
                $line .
                str_repeat(' ', $paddingRight);

            $this->writer->write($innerContent);

            if (strlen($innerContent) < $innerSize) {
                $this->writer->write(
                    str_repeat(
                        ' ',
                        $innerSize - strlen($innerContent)
                    )
                );
            }

            $this->style->reset();
            $this->writer->writeLine('');
        }

        for ($i = 0; $i < $paddingBottom; $i++) {
            $this->writer->write(str_repeat(' ', $marginLeft));
            $this->style->apply();
            if ($innerSize > 0) {
                $this->writer->write(str_repeat(' ', $innerSize));
            }
            $this->style->reset();
            $this->writer->writeLine('');
        }

        for ($i = 0; $i < $marginBottom; $i++) {
            $this->writer->writeLine('');
        }
    }

    /**
     * Returns the possible offsets for the block.
     *
     * @param int $maxWidth
     *
     * @return int[]
     */
    private function calculateOffsets(int $maxWidth): array
    {
        [
            $paddingTop,
            $paddingRight,
            $paddingBottom,
            $paddingLeft
        ] = $this->padding;

        [
            $marginTop,
            $marginRight,
            $marginBottom,
            $marginLeft
        ] = $this->margin;

        $fullOffset = $paddingLeft;

        if (($fullOffset + $paddingRight) >= $maxWidth) {
            $marginLeft = $marginRight = $paddingRight = 0;
        }

        $fullOffset += $paddingRight;

        if (($fullOffset + $marginLeft) >= $maxWidth) {
            $marginLeft = $marginRight = 0;
        }

        $fullOffset += $marginLeft;

        if (($fullOffset + $marginRight) >= $maxWidth) {
            $marginRight = 0;
        }

        $fullOffset += $marginRight;

        return [
            $paddingTop,
            $paddingRight,
            $paddingBottom,
            $paddingLeft,
            $marginTop,
            $marginRight,
            $marginBottom,
            $marginLeft
        ];
    }

    /**
     * Sets the padding for the element.
     *
     * @param int $top
     * @param int $right
     * @param int $bottom
     * @param int $left
     *
     * @return void
     */
    public function setPadding(
        int $top,
        int $right,
        int $bottom,
        int $left
    ): void {
        $this->padding = [$top, $right, $bottom, $left];
    }

    /**
     * Sets the margin for the element.
     *
     * @param int $top
     * @param int $right
     * @param int $bottom
     * @param int $left
     *
     * @return void
     */
    public function setMargin(
        int $top,
        int $right,
        int $bottom,
        int $left
    ): void {
        $this->margin = [$top, $right, $bottom, $left];
    }
}
