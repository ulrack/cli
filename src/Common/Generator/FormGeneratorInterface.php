<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Common\Generator;

use Ulrack\Cli\Common\Element\FormInterface;
use Ulrack\Validator\Common\ValidatorInterface;

interface FormGeneratorInterface
{
    /**
     * Creates a new theme.
     *
     * @param string $title
     * @param string $description
     *
     * @return FormGeneratorInterface
     */
    public function init(
        string $title,
        string $description = ''
    ): FormGeneratorInterface;

    /**
     * Reinitializes a form.
     *
     * @param FormInterface $form
     *
     * @return FormGeneratorInterface
     */
    public function reinit(FormInterface $form): FormGeneratorInterface;

    /**
     * Adds an open field to the form.
     *
     * @param string $name
     * @param bool $required
     * @param string $errorMessage
     * @param ValidatorInterface ...$additionalValidators
     *
     * @return FormGeneratorInterface
     */
    public function addOpenField(
        string $name,
        bool $required = true,
        string $errorMessage = 'This is a required field.',
        ValidatorInterface ...$additionalValidators
    ): FormGeneratorInterface;

    /**
     * Adds a hidden field to the form.
     *
     * @param string $name
     * @param bool $required
     * @param string $errorMessage
     * @param ValidatorInterface ...$additionalValidators
     *
     * @return FormGeneratorInterface
     */
    public function addHiddenField(
        string $name,
        bool $required = true,
        string $errorMessage = 'This is a required field.',
        ValidatorInterface ...$additionalValidators
    ): FormGeneratorInterface;

    /**
     * Adds an autocompleting (options) field to the form.
     *
     * @param string $name
     * @param array $options
     * @param boolean $required
     * @param string $errorMessageRequired
     * @param string $errorMessageEnum
     * @param ValidatorInterface ...$additionalValidators
     *
     * @return FormGeneratorInterface
     */
    public function addAutocompletingField(
        string $name,
        array $options,
        bool $required = true,
        string $errorMessageRequired = 'This is a required field.',
        string $errorMessageEnum = 'The value must be in the options list.',
        ValidatorInterface ...$additionalValidators
    ): FormGeneratorInterface;

    /**
     * Adds an open array field to the form.
     *
     * @param string $name
     * @param bool $required
     * @param string $additionalMessage
     * @param string $errorMessage
     * @param ValidatorInterface ...$additionalValidators
     *
     * @return FormGeneratorInterface
     */
    public function addOpenArrayField(
        string $name,
        bool $required = true,
        string $additionalMessage = 'Add another value?',
        string $errorMessage = 'This is a required field.',
        ValidatorInterface ...$additionalValidators
    ): FormGeneratorInterface;

    /**
     * Adds a hidden field to the form.
     *
     * @param string $name
     * @param bool $required
     * @param string $additionalMessage
     * @param string $errorMessage
     * @param ValidatorInterface ...$additionalValidators
     *
     * @return FormGeneratorInterface
     */
    public function addHiddenArrayField(
        string $name,
        bool $required = true,
        string $additionalMessage = 'Add another value?',
        string $errorMessage = 'This is a required field.',
        ValidatorInterface ...$additionalValidators
    ): FormGeneratorInterface;

    /**
     * Adds an autocompleting (options) field to the form.
     *
     * @param string $name
     * @param array $options
     * @param boolean $required
     * @param string $additionalMessage
     * @param string $errorMessageRequired
     * @param string $errorMessageEnum
     * @param ValidatorInterface ...$additionalValidators
     *
     * @return FormGeneratorInterface
     */
    public function addAutocompletingArrayField(
        string $name,
        array $options,
        bool $required = true,
        string $additionalMessage = 'Add another value?',
        string $errorMessageRequired = 'This is a required field.',
        string $errorMessageEnum = 'The value must be in the options list.',
        ValidatorInterface ...$additionalValidators
    ): FormGeneratorInterface;

    /**
     * Retrieves the current generating form.
     *
     * @return FormInterface
     */
    public function getForm(): FormInterface;
}
