<?php
/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Common\Element\Form;

use Ulrack\Cli\Common\Element\ElementInterface;

interface FieldInterface extends ElementInterface
{
    /**
     * Retrieves the input for the field.
     *
     * @return mixed
     */
    public function getInput();
}
