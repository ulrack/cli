<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Factory;

use Ulrack\Cli\Component\Io\Reader;
use Ulrack\Cli\Component\Io\Styler;
use Ulrack\Cli\Component\Io\Writer;
use Ulrack\Cli\Component\Io\Pointer;
use Ulrack\Cli\Component\Io\ErrorReader;
use Ulrack\Cli\Common\Io\ReaderInterface;
use Ulrack\Cli\Common\Io\StylerInterface;
use Ulrack\Cli\Common\Io\WriterInterface;
use Ulrack\Cli\Component\Io\SttyTerminal;
use Ulrack\Cli\Component\Theme\VoidStyle;
use Ulrack\Cli\Common\Io\PointerInterface;
use Ulrack\Cli\Common\Io\TerminalInterface;
use Ulrack\Cli\Common\Theme\StyleInterface;
use Ulrack\Cli\Component\Io\SttyObscuredReader;
use Ulrack\Cli\Common\Factory\IoFactoryInterface;
use Ulrack\Cli\Common\Io\OptionProviderInterface;
use Ulrack\Cli\Component\Io\SttyAutocompletingReader;

class IoFactory implements IoFactoryInterface
{
    /**
     * Contains the error writer after it is generated.
     *
     * @var WriterInterface
     */
    private $errorWriter;

    /**
     * Contains the standard writer after it is generated.
     *
     * @var WriterInterface
     */
    private $standardWriter;

    /**
     * Contains the pointer after it is generated.
     *
     * @var PointerInterface
     */
    private $pointer;

    /**
     * Contains the styler after it is generated.
     *
     * @var StylerInterface
     */
    private $styler;

    /**
     * Contains the standard reader after it is generated.
     *
     * @var ReaderInterface
     */
    private $standardReader;

    /**
     * Contains the hidden reader after it is generated.
     *
     * @var ReaderInterface
     */
    private $hiddenReader;

    /**
     * Contains the error outputting reader.
     *
     * @var ReaderInterface
     */
    private $errorReader;

    /**
     * Contains the terminal after it is generated.
     *
     * @var TerminalInterface
     */
    private $terminal;

    /**
     * Whether output can be read.
     *
     * @var bool
     */
    private $allowReading = true;

    /**
     * Creates an error writer.
     *
     * @return WriterInterface
     */
    public function createErrorWriter(): WriterInterface
    {
        if ($this->errorWriter === null) {
            $this->errorWriter = new Writer('php://stderr');
        }

        return $this->errorWriter;
    }

    /**
     * Creates a standard writer.
     *
     * @return WriterInterface
     */
    public function createStandardWriter(): WriterInterface
    {
        if ($this->standardWriter === null) {
            $this->standardWriter = new Writer();
        }

        return $this->standardWriter;
    }

    /**
     * Creates a pointer.
     *
     * @return PointerInterface
     */
    public function createPointer(): PointerInterface
    {
        if ($this->pointer === null) {
            $this->pointer = new Pointer(
                $this->createStandardWriter()
            );
        }

        return $this->pointer;
    }

    /**
     * Creates a styler.
     *
     * @return StylerInterface
     */
    public function createStyler(): StylerInterface
    {
        if ($this->styler === null) {
            $this->styler = new Styler(
                $this->createStandardWriter()
            );
        }

        return $this->styler;
    }

    /**
     * Creates a standard reader.
     *
     * @return ReaderInterface
     */
    public function createStandardReader(): ReaderInterface
    {
        if ($this->allowReading === true) {
            if ($this->standardReader === null) {
                $this->standardReader = new Reader();
            }

            return $this->standardReader;
        }

        return $this->createErrorReader();
    }

    /**
     * Creates a hidden reader.
     *
     * @return ReaderInterface
     */
    public function createHiddenReader(): ReaderInterface
    {
        if ($this->allowReading === true) {
            if ($this->hiddenReader === null) {
                $this->hiddenReader = new SttyObscuredReader(
                    $this->createStandardReader()
                );
            }

            return $this->hiddenReader;
        }

        return $this->createErrorReader();
    }

    /**
     * Creates an error reader.
     *
     * @return ReaderInterface
     */
    public function createErrorReader(): ReaderInterface
    {
        if ($this->errorReader === null) {
            $this->errorReader = new ErrorReader();
        }

        return $this->errorReader;
    }

    /**
     * Creates a autocompleting reader.
     *
     * @param OptionProviderInterface $optionProvider
     * @param StyleInterface $style
     *
     * @return ReaderInterface
     */
    public function createAutocompletingReader(
        OptionProviderInterface $optionProvider,
        StyleInterface $style = null
    ): ReaderInterface {
        if ($this->allowReading === true) {
            return new SttyAutocompletingReader(
                $optionProvider,
                $this->createStandardWriter(),
                $this->createPointer(),
                $style ?? new VoidStyle()
            );
        }

        return $this->createErrorReader();
    }

    /**
     * Creates a terminal.
     *
     * @return TerminalInterface
     */
    public function createTerminal(): TerminalInterface
    {
        if ($this->terminal === null) {
            $this->terminal = new SttyTerminal();
        }

        return $this->terminal;
    }

    /**
     * Turns all readers into error readers.
     *
     * @param bool $allowReading
     *
     * @return void
     */
    public function setAllowReading(bool $allowReading = true): void
    {
        $this->allowReading = $allowReading;
    }
}
