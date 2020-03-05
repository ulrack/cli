<?php
/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Common\Element\Form;

use Ulrack\Cli\Common\Element\ElementInterface;
use Ulrack\Validator\Common\ValidatorInterface;

interface FieldValidatorInterface extends ValidatorInterface
{
    /**
     * Retrieves the error message for the field.-white
     *
     * @return ElementInterface
     */
    public function getError(): ElementInterface;
}
