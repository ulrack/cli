<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Component\Theme;

use Ulrack\Cli\Common\Theme\StyleInterface;

class VoidStyle implements StyleInterface
{
    /**
     * Applies the style.
     *
     * @return void
     */
    public function apply(): void
    {
        return;
    }

    /**
     * Resets the style.
     *
     * @return void
     */
    public function reset(): void
    {
        return;
    }
}
