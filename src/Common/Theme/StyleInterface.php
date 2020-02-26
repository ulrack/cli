<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Common\Theme;

interface StyleInterface
{
    /**
     * Applies the style.
     *
     * @return void
     */
    public function apply(): void;

    /**
     * Resets the style.
     *
     * @return void
     */
    public function reset(): void;
}
