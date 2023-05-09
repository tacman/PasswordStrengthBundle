PasswordStrengthBundle
=============================

This bundle provides a validator for ensuring strong passwords in Symfony6 applications.

Validations provided include:

- minimum length
- contains alphabetic and/or numeric characters
- contains mixed case characters
- contains "special" characters (unicode characters in the Control, Mark, Punctuation, Symbol, and Separator classes)

## Installation

### Get the bundle

Add the following in your composer.json:

``` json
{
    "require": {
        "simformsolutions/password-strength-bundle": "^1.0"
    }
}
```

Or,

``` bash
composer require simformsolutions/password-strength-bundle
```

### Initialize the bundle

To start using the bundle, register the bundle in your application's kernel class:

``` php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        // ...
        new Simformsolutions\PasswordStrengthBundle(),
    );
)
```

## Usage

If you are using annotations for validations, include the constraints namespace:

``` php
use Simformsolutions\PasswordStrengthBundle\Validator\Constraints as PasswordAssert;
```

and then add the ```PasswordStrength``` validator to the relevant field:

``` php
/**
 * @PasswordAssert\PasswordStrength(minLength=7, requireNumbers=true)
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

- tooShortMessage = _'Your password must be at least {{length}} characters long.'_
- missingLettersMessage = _'Your password must include at least one letter.'_
- requireCaseDiffMessage = _'Your password must include both upper and lower case letters.'_
- missingNumbersMessage = _'Your password must include at least one number.'_
- missingSpecialsMessage = _'Your password must include at least one special character.'_

## License

This bundle is under the MIT license. See the complete license in the bundle:

- [LICENSE](https://github.com/SimformSolutionsPvtLtd/PasswordStrengthBundle/blob/master/LICENSE)
