<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Component\Io;

use Ulrack\Cli\Common\Io\TerminalInterface;

class SttyTerminal implements TerminalInterface
{
    /**
     * Retrieves the height of the current terminal.
     *
     * @return int
     */
    public function getHeight(): int
    {
        return explode(' ', trim(shell_exec('stty size')))[0];
    }

    /**
     * Retrieves the wdith of the current terminal.
     *
     * @return int
     */
    public function getWidth(): int
    {
        return explode(' ', trim(shell_exec('stty size')))[1];
    }
}
