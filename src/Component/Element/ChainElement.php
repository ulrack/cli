<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Component\Element;

use Ulrack\Cli\Common\Element\ElementInterface;

class ChainElement implements ElementInterface
{
    /**
     * The elements which need to be rendered.
     *
     * @var ElementInterface[]
     */
    private $elements;

    /**
     * Constructor.
     *
     * @param ElementInterface ...$elements
     */
    public function __construct(
        ElementInterface ...$elements
    ) {
        $this->elements = $elements;
    }

    /**
     * Renders the element.
     *
     * @return void
     */
    public function render(): void
    {
        foreach ($this->elements as $element) {
            $element->render();
        }
    }
}
