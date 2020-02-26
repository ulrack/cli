<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Exception;

use Exception;

class NotInitializedException extends Exception
{
    /**
     * Constructor.
     *
     * @param string $class
     * @param string $method
     * @param string $type
     */
    public function __construct(string $class, string $method, string $type)
    {
        parent::__construct(
            sprintf(
                'Generator for type "%s" requires initialization, run %s::%s before other methods.',
                $type,
                $class,
                $method
            )
        );
    }
}
