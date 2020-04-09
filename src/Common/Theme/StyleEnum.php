<?php
/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Common\Theme;

use GrizzIt\Enum\Enum;

/**
 * @method static StyleEnum RESET_ALL()
 * @method static StyleEnum BOLD()
 * @method static StyleEnum DIM()
 * @method static StyleEnum CURSIVE()
 * @method static StyleEnum UNDERLINE()
 * @method static StyleEnum BLINK()
 * @method static StyleEnum BLINK_2()
 * @method static StyleEnum INVERSE()
 * @method static StyleEnum HIDDEN()
 * @method static StyleEnum STRIKETHROUGH()
 * @method static StyleEnum DOULBE_UNDERLINE()
 * @method static StyleEnum TEXT_BLACK()
 * @method static StyleEnum TEXT_RED()
 * @method static StyleEnum TEXT_GREEN()
 * @method static StyleEnum TEXT_YELLOW()
 * @method static StyleEnum TEXT_BLUE()
 * @method static StyleEnum TEXT_MAGENTA()
 * @method static StyleEnum TEXT_CYAN()
 * @method static StyleEnum TEXT_GRAY()
 * @method static StyleEnum TEXT_BRIGHT_BLACK()
 * @method static StyleEnum TEXT_BRIGHT_RED()
 * @method static StyleEnum TEXT_BRIGHT_GREEN()
 * @method static StyleEnum TEXT_BRIGHT_YELLOW()
 * @method static StyleEnum TEXT_BRIGHT_BLUE()
 * @method static StyleEnum TEXT_BRIGHT_MAGENTA()
 * @method static StyleEnum TEXT_BRIGHT_CYAN()
 * @method static StyleEnum TEXT_BRIGHT_GRAY()
 * @method static StyleEnum BACKGROUND_BLACK()
 * @method static StyleEnum BACKGROUND_RED()
 * @method static StyleEnum BACKGROUND_GREEN()
 * @method static StyleEnum BACKGROUND_YELLOW()
 * @method static StyleEnum BACKGROUND_BLUE()
 * @method static StyleEnum BACKGROUND_MAGENTA()
 * @method static StyleEnum BACKGROUND_CYAN()
 * @method static StyleEnum BACKGROUND_GRAY()
 * @method static StyleEnum BACKGROUND_BRIGHT_BLACK()
 * @method static StyleEnum BACKGROUND_BRIGHT_RED()
 * @method static StyleEnum BACKGROUND_BRIGHT_GREEN()
 * @method static StyleEnum BACKGROUND_BRIGHT_YELLOW()
 * @method static StyleEnum BACKGROUND_BRIGHT_BLUE()
 * @method static StyleEnum BACKGROUND_BRIGHT_MAGENTA()
 * @method static StyleEnum BACKGROUND_BRIGHT_CYAN()
 * @method static StyleEnum BACKGROUND_BRIGHT_GRAY()
 */
class StyleEnum extends Enum
{
    // Attributes
    const RESET_ALL = '0';
    const BOLD = '1';
    const DIM = '2';
    const CURSIVE = '3';
    const UNDERLINE = '4';
    const BLINK = '5';
    const BLINK_2 = '6';
    const INVERSE = '7';
    const HIDDEN = '8';
    const STRIKETHROUGH = '9';
    const DOUBLE_UNDERLINE = '21';

    // Text colors
    const TEXT_BLACK = '30';
    const TEXT_RED = '31';
    const TEXT_GREEN = '32';
    const TEXT_YELLOW = '33';
    const TEXT_BLUE = '34';
    const TEXT_MAGENTA = '35';
    const TEXT_CYAN = '36';
    const TEXT_GRAY = '37';

    const TEXT_BRIGHT_BLACK = '90';
    const TEXT_BRIGHT_RED = '91';
    const TEXT_BRIGHT_GREEN = '92';
    const TEXT_BRIGHT_YELLOW = '93';
    const TEXT_BRIGHT_BLUE = '94';
    const TEXT_BRIGHT_MAGENTA = '95';
    const TEXT_BRIGHT_CYAN = '96';
    const TEXT_BRIGHT_GRAY = '97';

    // Background colors
    const BACKGROUND_BLACK = '40';
    const BACKGROUND_RED = '41';
    const BACKGROUND_GREEN = '42';
    const BACKGROUND_YELLOW = '43';
    const BACKGROUND_BLUE = '44';
    const BACKGROUND_MAGENTA = '45';
    const BACKGROUND_CYAN = '46';
    const BACKGROUND_GRAY = '47';

    const BACKGROUND_BRIGHT_BLACK = '100';
    const BACKGROUND_BRIGHT_RED = '101';
    const BACKGROUND_BRIGHT_GREEN = '102';
    const BACKGROUND_BRIGHT_YELLOW = '103';
    const BACKGROUND_BRIGHT_BLUE = '104';
    const BACKGROUND_BRIGHT_MAGENTA = '105';
    const BACKGROUND_BRIGHT_CYAN = '106';
    const BACKGROUND_BRIGHT_GRAY = '107';
}
