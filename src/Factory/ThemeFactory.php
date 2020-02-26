<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Factory;

use Ulrack\Cli\Component\Theme\Theme;
use Ulrack\Cli\Common\Theme\StyleEnum;
use Ulrack\Cli\Common\Theme\StyleInterface;
use Ulrack\Cli\Common\Theme\ThemeInterface;
use Ulrack\Cli\Common\Factory\IoFactoryInterface;
use Ulrack\Cli\Component\Theme\ConfigurableStyle;
use Ulrack\Cli\Common\Factory\ThemeFactoryInterface;

class ThemeFactory implements ThemeFactoryInterface
{
    /**
     * Contains the IO factory.
     *
     * @var IoFactoryInterface
     */
    private $ioFactory;

    /**
     * Constructor.
     *
     * @param IoFactoryInterface $ioFactory
     */
    public function __construct(IoFactoryInterface $ioFactory)
    {
        $this->ioFactory = $ioFactory;
    }

    /**
     * Creates a new style.
     *
     * @param StyleEnum ...$styles
     *
     * @return StyleInterface
     */
    public function createStyle(
        StyleEnum ...$styles
    ): StyleInterface {
        return new ConfigurableStyle(
            $this->ioFactory->createStyler(),
            ...$styles
        );
    }

    /**
     * Creates a new theme.
     *
     * @return ThemeInterface
     */
    public function createTheme(): ThemeInterface
    {
        return new Theme();
    }
}
