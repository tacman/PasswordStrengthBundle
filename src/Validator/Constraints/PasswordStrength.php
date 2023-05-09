<?php

namespace Simformsolutions\PasswordStrengthBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"CLASS", "ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_PROPERTY | \Attribute::IS_REPEATABLE)]
class PasswordStrength extends Constraint
{
    public string $tooShortMessage = 'Password must be at least {{length}} characters long.';
    public string $missingLettersMessage = 'Password must include at least one letter.';
    public string $requireCaseDiffMessage = 'Password must include both upper and lower case letters.';
    public string $missingNumbersMessage = 'Password must include at least one number.';
    public string $missingSpecialsMessage = 'Password must include at least one special character.';

    public int $minLength = 5;
    public bool $requireLetters = true;
    public bool $requireCaseDiff = false;
    public bool $requireNumbers = false;
    public bool $requireSpecials = false;

    public string $charset = 'UTF-8';
}