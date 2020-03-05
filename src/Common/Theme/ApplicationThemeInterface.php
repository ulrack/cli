<?php
/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Common\Theme;

interface ApplicationThemeInterface
{
    /**
     * Constructs and retrieves the theme.
     *
     * @return ThemeInterface
     */
    public function getTheme(): ThemeInterface;
}
