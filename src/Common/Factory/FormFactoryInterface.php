<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Common\Factory;

use Ulrack\Cli\Common\Element\Form\FieldInterface;
use Ulrack\Cli\Common\Element\FormInterface;
use Ulrack\Cli\Common\Element\ElementInterface;
use Ulrack\Cli\Common\Io\OptionProviderInterface;

interface FormFactoryInterface
{
    /**
     * Creates a new form.
     *
     * @param ElementInterface ...$description
     *
     * @return FormInterface
     */
    public function createForm(
        ElementInterface ...$description
    ): FormInterface;

    /**
     * Creates a new field.
     *
     * @param ElementInterface $label
     *
     * @return FieldInterface
     */
    public function createField(
        ElementInterface $label
    ): FieldInterface;

    /**
     * Creates a new obscured field.
     *
     * @param ElementInterface $label
     *
     * @return FieldInterface
     */
    public function createObscuredField(
        ElementInterface $label
    ): FieldInterface;

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
    ): FieldInterface;

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
        ElementInterface $extraLabel,
        string $default = 'y'
    ): FieldInterface;

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
        ElementInterface $extraLabel,
        string $default = 'y'
    ): FieldInterface;

    /**
     * Creates a new autocompleting array field.
     *
     * @param ElementInterface $label
     * @param ElementInterface $extraLabel
     * @param OptionProviderInterface $optionProvider
     * @param string $default
     * @param string $style
     *
     * @return FieldInterface
     */
    public function createAutocompletingArrayField(
        ElementInterface $label,
        ElementInterface $extraLabel,
        OptionProviderInterface $optionProvider,
        string $default = 'y',
        string $style = 'autocomplete'
    ): FieldInterface;
}
