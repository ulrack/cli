<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Component\Theme;

use Ulrack\Cli\Common\Theme\StyleEnum;
use Ulrack\Cli\Common\Io\StylerInterface;
use Ulrack\Cli\Common\Theme\AbstractStyle;

class ConfigurableStyle extends AbstractStyle
{
    /**
     * Contains the applicators to create the style.
     *
     * @var StyleEnum[]
     */
    private $styles;

    /**
     * Constructor.
     *
     * @param StylerInterface $styler
     * @param StyleEnum ...$styles
     */
    public function __construct(StylerInterface $styler, StyleEnum ...$styles)
    {
        parent::__construct($styler);
        $this->styles = $styles;
    }

    /**
     * Applies the style.
     *
     * @return void
     */
    public function apply(): void
    {
        $this->getStyler()->style(...$this->styles);
    }
}
