<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Component\Element\Form;

use Ulrack\Cli\Common\Io\ReaderInterface;
use Ulrack\Cli\Common\Element\ElementInterface;
use Ulrack\Cli\Common\Element\Form\FieldInterface;

class ArrayField implements FieldInterface
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
    private $input = [];

    /**
     * Contains the confirmation field.
     *
     * @var FieldInterface
     */
    private $confirmationField;

    /**
     * Contains the default value.
     *
     * @var string
     */
    private $default;

    /**
     * Constructor.
     *
     * @param ReaderInterface $reader
     * @param ElementInterface $label
     * @param FieldInterface $confirmationField
     * @param string $default
     */
    public function __construct(
        ReaderInterface $reader,
        ElementInterface $label,
        string $default = 'y',
        FieldInterface $confirmationField = null
    ) {
        $this->reader = $reader;
        $this->label = $label;
        $this->default = $default;
        $this->confirmationField = $confirmationField;
    }

    /**
     * Processes the field and stores the users input.
     *
     * @return void
     */
    public function render(): void
    {
        while (true) {
            $this->label->render();
            $input = $this->reader->read();
            if ($input !== '') {
                $this->input[] = $input;
            }

            $this->confirmationField->render();
            $confirm = strtolower($this->confirmationField->getInput());

            $check = ['y', 'n'];
            if (in_array($this->default, $check)) {
                $check[] = '';
            }

            while (!in_array($confirm, $check)) {
                $this->confirmationField->render();
                $confirm = strtolower($this->confirmationField->getInput());
            }

            if ($confirm === '') {
                $confirm = $this->default;
            }

            if ($confirm === 'n') {
                break;
            }
        }
    }

    /**
     * Retrieves the input of the element.
     *
     * @return array
     */
    public function getInput(): array
    {
        return $this->input;
    }
}
