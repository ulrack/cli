<?php
/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Factory;

use Ulrack\Cli\Common\Element\Form\FieldInterface;
use Ulrack\Cli\Common\Io\OptionProviderInterface;
use Ulrack\Cli\Common\Theme\ThemeInterface;
use Ulrack\Cli\Common\Element\FormInterface;
use Ulrack\Cli\Component\Element\Form\Field;
use Ulrack\Cli\Component\Element\FormElement;
use Ulrack\Cli\Common\Element\ElementInterface;
use Ulrack\Cli\Common\Factory\IoFactoryInterface;
use Ulrack\Cli\Component\Element\Form\ArrayField;
use Ulrack\Cli\Common\Factory\FormFactoryInterface;

class FormFactory implements FormFactoryInterface
{
    /**
     * Contains the io factory to create writers and readers.
     *
     * @var IoFactoryInterface
     */
    private $ioFactory;

    /**
     * Constructor.
     *
     * @param IoFactoryInterface $ioFactory
     * @param ThemeInterface $theme
     */
    public function __construct(
        IoFactoryInterface $ioFactory,
        ThemeInterface $theme
    ) {
        $this->ioFactory = $ioFactory;
        $this->theme = $theme;
    }

    /**
     * Creates a new form.
     *
     * @param ElementInterface ...$description
     *
     * @return FormInterface
     */
    public function createForm(
        ElementInterface ...$description
    ): FormInterface {
        return new FormElement(
            ...$description
        );
    }

    /**
     * Creates a new field.
     *
     * @param ElementInterface $label
     *
     * @return FieldInterface
     */
    public function createField(
        ElementInterface $label
    ): FieldInterface {
        return new Field(
            $this->ioFactory->createStandardReader(),
            $label
        );
    }

    /**
     * Creates a new obscured field.
     *
     * @param ElementInterface $label
     *
     * @return FieldInterface
     */
    public function createObscuredField(
        ElementInterface $label
    ): FieldInterface {
        return new Field(
            $this->ioFactory->createHiddenReader(),
            $label
        );
    }

    /**
     * Creates a new autocompleting field.
     *
     * @param ElementInterface $label
     * @param OptionProviderInterface $optionProvider
     * @param string $style
     *
     * @return FieldInterface
     */
    public function createAutocompletingField(
        ElementInterface $label,
        OptionProviderInterface $optionProvider,
        string $style = 'autocomplete'
    ): FieldInterface {
        return new Field(
            $this->ioFactory->createAutocompletingReader(
                $optionProvider,
                $this->theme->getStyle($style)
            ),
            $label
        );
    }

    /**
     * Creates a new array field.
     *
     * @param ElementInterface $label
     * @param ElementInterface $extraLabel
     *
     * @return FieldInterface
     */
    public function createArrayField(
        ElementInterface $label,
        ElementInterface $extraLabel
    ): FieldInterface {
        return new ArrayField(
            $this->ioFactory->createStandardReader(),
            $label,
            $this->createField($extraLabel)
        );
    }

    /**
     * Creates a new obscured array field.
     *
     * @param ElementInterface $label
     * @param ElementInterface $extraLabel
     *
     * @return FieldInterface
     */
    public function createObscuredArrayField(
        ElementInterface $label,
        ElementInterface $extraLabel
    ): FieldInterface {
        return new ArrayField(
            $this->ioFactory->createHiddenReader(),
            $label,
            $this->createField($extraLabel)
        );
    }

    /**
     * Creates a new autocompleting array field.
     *
     * @param ElementInterface $label
     * @param ElementInterface $extraLabel
     * @param OptionProviderInterface $optionProvider
     * @param string $style
     *
     * @return FieldInterface
     */
    public function createAutocompletingArrayField(
        ElementInterface $label,
        ElementInterface $extraLabel,
        OptionProviderInterface $optionProvider,
        string $style = 'autocomplete'
    ): FieldInterface {
        return new ArrayField(
            $this->ioFactory->createAutocompletingReader(
                $optionProvider,
                $this->theme->getStyle($style)
            ),
            $label,
            $this->createField($extraLabel)
        );
    }
}
