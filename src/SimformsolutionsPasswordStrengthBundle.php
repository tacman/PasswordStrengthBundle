<?php

namespace Simformsolutions\PasswordStrengthBundle;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class SimformsolutionsPasswordStrengthBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return dirname(__DIR__);
    }
}