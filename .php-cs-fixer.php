<?php

$config = new PhpCsFixer\Config();
return $config->setRules([
    '@PSR12' => true,
    'strict_param' => false,
    'array_syntax' => ['syntax' => 'short'],
    '@Symfony' => true
]);
