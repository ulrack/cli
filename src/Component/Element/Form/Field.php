<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Component\Element\Form;

use Ulrack\Cli\Common\Io\ReaderInterface;
use Ulrack\Cli\Common\Element\ElementInterface;
use Ulrack\Cli\Common\Element\Form\FieldInterface;

class Field implements FieldInterface
{
    /**
     * Contains the reader to read the input.
     *
     * @var ReaderInterface
     */
    private $reader;

    /**
     * Contains the label for the field.
     *
     * @var ElementInterface
     */
    private $label;

    /**
     * Contains the input when it is set.
     *
     * @var mixed
     */
    private $input = '';

    /**
     * Constructor.
     *
     * @param ReaderInterface $reader
     * @param ElementInterface $label
     */
    public function __construct(
        ReaderInterface $reader,
        ElementInterface $label
    ) {
        $this->reader = $reader;
        $this->label = $label;
    }

    /**
     * Processes the field and stores the users input.
     *
     * @return void
     */
    public function render(): void
    {
        $this->label->render();
        $this->input = $this->reader->read();
    }

    /**
     * Retrieves the input of the element.
     *
     * @return string
     */
    public function getInput(): string
    {
        return $this->input;
    }
}
