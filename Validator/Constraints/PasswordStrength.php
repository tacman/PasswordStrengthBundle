<?php

namespace Simformsolutions\PasswordStrengthBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PasswordStrength extends Constraint
{
    public string $tooShortMessage = 'Your password must be at least {{length}} characters long.';
    public string $missingLettersMessage = 'Your password must include at least one letter.';
    public string $requireCaseDiffMessage = 'Your password must include both upper and lower case letters.';
    public string $missingNumbersMessage = 'Your password must include at least one number.';
    public string $missingSpecialsMessage = 'Your password must include at least one special character.';

    public int $minLength = 5;
    public bool $requireLetters = true;
    public bool $requireCaseDiff = false;
    public bool $requireNumbers = false;
    public bool $requireSpecials = false;

    public string $charset = 'UTF-8';
}