<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Component\Theme;

use Ulrack\Cli\Common\Theme\StyleEnum;
use Ulrack\Cli\Common\Theme\ThemeInterface;
use Ulrack\Cli\Common\Theme\ApplicationThemeInterface;
use Ulrack\Cli\Common\Generator\ThemeGeneratorInterface;

class DefaultTheme implements ApplicationThemeInterface
{
    /**
     * Contains the theme generator to create the default theme.
     *
     * @var ThemeGeneratorInterface
     */
    private $themeGenerator;

    /**
     * Constructor.
     *
     * @param ThemeGeneratorInterface $themeGenerator
     */
    public function __construct(
        ThemeGeneratorInterface $themeGenerator
    ) {
        $this->themeGenerator = $themeGenerator;
    }

    /**
     * Constructs and retrieves the theme.
     *
     * @return ThemeInterface
     */
    public function getTheme(): ThemeInterface
    {
        return $this->themeGenerator
            ->init()
            ->addStyle('autocomplete', StyleEnum::INVERSE())
            ->addStyle('text', StyleEnum::TEXT_BRIGHT_GRAY())
            ->addStyle('table-style', StyleEnum::TEXT_BRIGHT_GRAY())
            ->addStyle('table-box-style', StyleEnum::TEXT_BRIGHT_GRAY())
            ->addStyle(
                'table-key-style',
                StyleEnum::BOLD(),
                StyleEnum::TEXT_BRIGHT_GRAY()
            )->addVariable(
                'table-characters',
                [
                    'corner' => [
                        'top' => [
                            'left' => '┌',
                            'right' => '┐',
                        ],
                        'bottom' => [
                            'left' => '└',
                            'right' => '┘',
                        ],
                    ],
                    'cross' => [
                        'left' => '├',
                        'right' => '┤',
                        'top' => '┬',
                        'bottom' => '┴',
                        'center' => '┼'
                    ],
                    'line' => [
                        'horizontal' => '─',
                        'vertical' => '│',
                    ],
                ]
            )->addStyle('list', StyleEnum::TEXT_BRIGHT_GRAY())
            ->addStyle(
                'explained-list-key',
                StyleEnum::TEXT_BRIGHT_GRAY(),
                StyleEnum::BOLD()
            )->addStyle(
                'explained-list-description',
                StyleEnum::TEXT_BRIGHT_GRAY()
            )->addStyle(
                'command-explained-list-key',
                StyleEnum::TEXT_BLUE(),
                StyleEnum::BOLD()
            )->addStyle(
                'command-explained-list-description',
                StyleEnum::TEXT_GREEN()
            )->addStyle('block', StyleEnum::INVERSE())
            ->addVariable('block-padding', [1, 2, 1, 2])
            ->addVariable('block-margin', [1, 2, 1, 2])
            ->addStyle(
                'error-block',
                StyleEnum::BACKGROUND_RED(),
                StyleEnum::TEXT_BRIGHT_GRAY()
            )->addStyle(
                'label',
                StyleEnum::TEXT_BRIGHT_GRAY()
            )->addStyle(
                'title',
                StyleEnum::TEXT_BRIGHT_GRAY(),
                StyleEnum::BOLD()
            )->addVariable(
                'progress-characters',
                [
                    'border' => [
                        'left' => '[',
                        'right' => ']',
                    ],
                    'progress' => [
                        'done' => '=',
                        'pending' => '-',
                        'current' => '>',
                    ],
                ]
            )->addStyle(
                'progress-text',
                StyleEnum::TEXT_BRIGHT_GRAY()
            )->addStyle(
                'progress-bar',
                StyleEnum::TEXT_BRIGHT_GRAY()
            )->getTheme();
    }
}
