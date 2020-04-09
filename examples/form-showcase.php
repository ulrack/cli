<?php

use GrizzIt\Validator\Component\Textual\PatternValidator;
use Ulrack\Cli\Factory\IoFactory;
use Ulrack\Cli\Factory\FormFactory;
use Ulrack\Cli\Factory\ThemeFactory;
use Ulrack\Cli\Factory\ElementFactory;
use Ulrack\Cli\Generator\FormGenerator;
use Ulrack\Cli\Generator\ThemeGenerator;
use Ulrack\Cli\Component\Theme\DefaultTheme;

require_once(__DIR__ . '/../vendor/autoload.php');

$ioFactory = new IoFactory();
$theme = (new DefaultTheme(new ThemeGenerator(new ThemeFactory(
    $ioFactory
))))->getTheme();

$formFactory = new FormFactory($ioFactory, $theme);
$elementFactory = new ElementFactory($theme, $ioFactory);

$formGenerator = new FormGenerator($formFactory, $elementFactory);

$form = $formGenerator->init(
    'About me',
    'A form which asks you who you are.'
)->addOpenArrayField(
    'What\'s your name?',
    true,
    'Do you have any more?'
)->addOpenField(
    'What is your age?',
    false,
    'You know how numbers work right?',
    new PatternValidator('[0-9]+')
)->addAutocompletingField(
    'What is your job?',
    [
        'Still going to school',
        'Developer',
        'CEO',
        'Other'
    ]
)->addHiddenField(
    'You are not going to see this.. immediately anyway'
)->getForm();

$form->render();

echo "\nThe information you provided:\n";
print_r($form->getInput());
