<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Generator;

use Ulrack\Cli\Common\Theme\StyleEnum;
use Ulrack\Cli\Common\Theme\ThemeInterface;
use Ulrack\Cli\Exception\NotInitializedException;
use Ulrack\Cli\Common\Factory\ThemeFactoryInterface;
use Ulrack\Cli\Common\Generator\ThemeGeneratorInterface;

class ThemeGenerator implements ThemeGeneratorInterface
{
    /**
     * Contains the theme factory.
     *
     * @var ThemeFactoryInterface
     */
    private $themeFactory;

    /**
     * Contains the current theme.
     *
     * @var ThemeInterface
     */
    private $theme;

    /**
     * Constructor.
     *
     * @param ThemeFactoryInterface $themeFactory
     */
    public function __construct(
        ThemeFactoryInterface $themeFactory
    ) {
        $this->themeFactory = $themeFactory;
    }

    /**
     * Creates a new theme.
     *
     * @return ThemeGeneratorInterface
     */
    public function init(): ThemeGeneratorInterface
    {
        $this->theme = $this->themeFactory->createTheme();

        return $this;
    }

    /**
     * Reinitializes a theme.
     *
     * @param ThemeInterface $theme
     *
     * @return ThemeGeneratorInterface
     */
    public function reinit(ThemeInterface $theme): ThemeGeneratorInterface
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Checks whether the theme is created before certain actions can be performed.
     *
     * @return void
     *
     * @throws NotInitializedException When the theme is not initialized.
     */
    private function preAddCheck(): void
    {
        if ($this->theme === null) {
            throw new NotInitializedException(
                self::class,
                'init',
                'theme'
            );
        }
    }

    /**
     * Adds a new style to the current theme.
     *
     * @param string $key
     * @param StyleEnum ...$styles
     *
     * @return ThemeGeneratorInterface
     *
     * @throws NotInitializedException When the theme is not initialized.
     */
    public function addStyle(
        string $key,
        StyleEnum ...$styles
    ): ThemeGeneratorInterface {
        $this->preAddCheck();

        $this->theme->addStyle(
            $key,
            $this->themeFactory->createStyle(...$styles)
        );

        return $this;
    }

    /**
     * Adds a variable to the theme.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return ThemeGeneratorInterface
     *
     * @throws NotInitializedException When the theme is not initialized.
     */
    public function addVariable(
        string $key,
        $value
    ): ThemeGeneratorInterface {
        $this->preAddCheck();

        $this->theme->addVariable($key, $value);

        return $this;
    }

    /**
     * Retrieves the current generating theme.
     *
     * @return ThemeInterface
     *
     * @throws NotInitializedException When the theme is not initialized.
     */
    public function getTheme(): ThemeInterface
    {
        $this->preAddCheck();

        $theme = $this->theme;

        $this->theme = null;

        return $theme;
    }
}
