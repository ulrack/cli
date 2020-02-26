<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Common\Factory;

use Ulrack\Cli\Common\Theme\StyleEnum;
use Ulrack\Cli\Common\Theme\StyleInterface;
use Ulrack\Cli\Common\Theme\ThemeInterface;

interface ThemeFactoryInterface
{
    /**
     * Creates a new style.
     *
     * @param StyleEnum ...$styles
     *
     * @return StyleInterface
     */
    public function createStyle(
        StyleEnum ...$styles
    ): StyleInterface;

    /**
     * Creates a new theme.
     *
     * @return ThemeInterface
     */
    public function createTheme(): ThemeInterface;
}
