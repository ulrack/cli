<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Component\Io;

use Ulrack\Cli\Common\Io\OptionProviderInterface;

class OptionProvider implements OptionProviderInterface
{
    /**
     * Contains all the options in the provider.
     *
     * @var array
     */
    private $options;

    /**
     * Constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * Searches the options for matches for the input.
     *
     * @param string $input
     *
     * @return array
     */
    public function __invoke(string $input): array
    {
        $options = $this->options;

        if (!empty($input)) {
            foreach ($options as $optionKey => $option) {
                if (strpos($option, $input) !== 0) {
                    unset($options[$optionKey]);
                }
            }
        }

        return $options;
    }
}
