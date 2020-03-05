<?php
/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Component\Theme;

use Ulrack\Cli\Common\Theme\StyleInterface;
use Ulrack\Cli\Common\Theme\ThemeInterface;

class Theme implements ThemeInterface
{
    /**
     * Contains the styles of the theme.
     *
     * @var StyleInterface[]
     */
    private $styles = [];

    /**
     * Contains the default style.
     *
     * @var StyleInterface
     */
    private $defaultStyle;

    /**
     * Contains the variables for the theme.
     *
     * @var mixed[]
     */
    private $variables;

    /**
     * Constructor.
     *
     * @param StyleInterface $defaultStyle
     */
    public function __construct(
        StyleInterface $defaultStyle = null
    ) {
        $this->defaultStyle = $defaultStyle ?? new VoidStyle();
    }

    /**
     * Adds a style to a keyword.
     *
     * @param string $key
     * @param StyleInterface $style
     *
     * @return void
     */
    public function addStyle(string $key, StyleInterface $style): void
    {
        $this->styles[$key] = $style;
    }

    /**
     * Adds a variable to the theme.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return void
     */
    public function addVariable(string $key, $value): void
    {
        $this->variables[$key] = $value;
    }

    /**
     * Retrieve a style based on the provided keyword.
     *
     * @param string $key
     *
     * @return StyleInterface
     */
    public function getStyle(string $key): StyleInterface
    {
        return $this->styles[$key] ?? $this->defaultStyle;
    }

    /**
     * Retrieves the variable of the theme.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getVariable(string $key)
    {
        return $this->variables[$key];
    }
}
