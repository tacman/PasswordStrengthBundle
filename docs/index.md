
## Installation

### Get the bundle

Add the following in your composer.json:

``` json
{
    "require": {
        "simformsolutions/password-strength-bundle": ">=0.1"
    }
}
```

Or,

``` bash
composer require simformsolutions/password-strength-bundle
```

### Initialize the bundle

This bundle is already Symfony 6 compatible and support flex structure. So below class is auto registered. If it is not exist then please add following code.

``` php
// config/bundles.php
return [
        // ...
        Simformsolutions\PasswordStrengthBundle\SimformsolutionsPasswordStrengthBundle::class => ['all' => true],
    ];
```

## Usage

If you are using annotations for validations, include the constraints namespace:

``` php
use Simformsolutions\PasswordStrengthBundle\Validator\Constraints as PasswordAssert;
```

and then add the ```PasswordStrength``` validator to the relevant field:

``` php
/**
 * #[PasswordAssert\PasswordStrength(['minLength'=> 7, 'requireNumbers'=> true])]
 */
protected $password;
```

Default options include:

- minLength = _5_
- requireLetters = _true_
- requireCaseDiff = _false_
- requireNumbers = _false_
- requireSpecials  = _false_

You can customize the validation error messages:

- tooShortMessage = _'Password must be at least {{length}} characters long.'_
- missingLettersMessage = _'Password must include at least one letter.'_
- requireCaseDiffMessage = _'Password must include both upper and lower case letters.'_
- missingNumbersMessage = _'Password must include at least one number.'_
- missingSpecialsMessage = _'Password must include at least one special character.'_
