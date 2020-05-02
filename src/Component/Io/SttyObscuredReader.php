<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Component\Io;

use Ulrack\Cli\Common\Io\ReaderInterface;

class SttyObscuredReader implements ReaderInterface
{
    /**
     * Contains the reader used to read the stream.
     *
     * @var ReaderInterface
     */
    private $reader;

    /**
     * Constructor.
     *
     * @param ReaderInterface $reader
     */
    public function __construct(ReaderInterface $reader)
    {
        $this->reader = $reader;
    }

    /**
     * Reads the input and returns the users input.
     *
     * @return string
     */
    public function read(): string
    {
        system('stty -echo');
        $input = $this->reader->read();
        system('stty echo');

        return $input;
    }
}
