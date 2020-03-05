<?php
/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Component\Io;

use Ulrack\Cli\Common\Theme\StyleEnum;
use Ulrack\Cli\Common\Io\StylerInterface;
use Ulrack\Cli\Common\Io\WriterInterface;

class Styler implements StylerInterface
{
    /**
     * Contains the writer to apply the style.
     *
     * @var WriterInterface
     */
    private $writer;

    /**
     * Constructor.
     *
     * @param WriterInterface $writer
     */
    public function __construct(WriterInterface $writer)
    {
        $this->writer = $writer;
    }

    /**
     * Styles the output.
     *
     * @param StyleEnum ...$styles
     *
     * @return void
     */
    public function style(StyleEnum ...$styles): void
    {
        if (count($styles) > 0) {
            $this->writer->write(
                sprintf(
                    "\033[%sm",
                    implode(';', $styles)
                )
            );
        }
    }
}
