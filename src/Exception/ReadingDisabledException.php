<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Exception;

use Exception;

class ReadingDisabledException extends Exception
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'Can not read input, reading has been disabled.'
        );
    }
}
