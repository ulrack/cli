<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Component\Io;

use Ulrack\Cli\Common\Io\TerminalInterface;

class TputTerminal implements TerminalInterface
{
    /**
     * Retrieves the height of the current terminal.
     *
     * @return int
     */
    public function getHeight(): int
    {
        return trim(shell_exec('tput lines'));
    }

    /**
     * Retrieves the wdith of the current terminal.
     *
     * @return int
     */
    public function getWidth(): int
    {
        return trim(shell_exec('tput cols'));
    }
}
