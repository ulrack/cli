<?php
/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Component\Element;

use Ulrack\Cli\Common\Io\WriterInterface;
use Ulrack\Cli\Component\Theme\VoidStyle;
use Ulrack\Cli\Common\Theme\StyleInterface;
use Ulrack\Cli\Common\Element\ElementInterface;

class TextualElement implements ElementInterface
{
    /**
     * Contains the writer to display the text.
     *
     * @var WriterInterface
     */
    private $writer;

    /**
     * Contains the style of the text field.
     *
     * @var StyleInterface
     */
    private $style;

    /**
     * Contains the content of the element.
     *
     * @var string
     */
    private $content;

    /**
     * Whether a new line should be used for the element.
     *
     * @var bool
     */
    private $newLine;

    /**
     * Constructor.
     *
     * @param string $content
     * @param WriterInterface $writer
     * @param bool $newLine
     * @param StyleInterface $style
     */
    public function __construct(
        string $content,
        WriterInterface $writer,
        bool $newLine = true,
        StyleInterface $style = null
    ) {
        $this->content = $content;
        $this->writer = $writer;
        $this->newLine = $newLine;
        $this->style = $style ?? new VoidStyle();
    }

    /**
     * Renders the element.
     *
     * @return void
     */
    public function render(): void
    {
        $this->style->apply();
        $this->writer->write($this->content);
        $this->style->reset();

        if ($this->newLine) {
            $this->writer->writeLine('');
        }
    }
}
