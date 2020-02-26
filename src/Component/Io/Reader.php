<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Component\Io;

use Ulrack\Cli\Common\Io\ReaderInterface;

class Reader implements ReaderInterface
{
    /**
     * Contains the input for opening a stream.
     *
     * @var string
     */
    private $streamInput;

    /**
     * Contains the mode for the stream.
     *
     * @var string
     */
    private $mode;

    /**
     * Constructor.
     *
     * @param string $streamInput
     * @param string $mode
     */
    public function __construct(
        string $streamInput = 'php://stdin',
        string $mode = 'r+b'
    ) {
        $this->streamInput = $streamInput;
        $this->mode = $mode;
    }

    /**
     * Reads the input and returns the users input.
     *
     * @return string
     */
    public function read(): string
    {
        $inputStream = fopen($this->streamInput, $this->mode, false);
        $input = rtrim(fgets($inputStream), chr(10));
        fclose($inputStream);

        return $input;
    }
}
