# Zxcvbn Symfony Bundle

Password strength constraint for Symfony validator component.
Based on the [zxcvbn project](https://blogs.dropbox.com/tech/2012/04/zxcvbn-realistic-password-strength-estimation/)
from Dropbox and @lowe, this is using [zxcvbn-php](https://github.com/bjeavons/zxcvbn-php)
under the hood for password strength estimation.

> zxcvbn attempts to give sound password advice through pattern matching and
conservative entropy calculations. It finds 10k common passwords, common
American names and surnames, common English words, and common patterns like
dates, repeats (aaa), sequences (abcd), and QWERTY patterns.

## Installation

The library can be installed with [Composer](http://getcomposer.org) by adding it as a dependency to your composer.json file.

```
$ composer require double-star-systems/zxcvbn-symfony
```

## Usage

The constrint can be attached to an entity field using an annotation.

```php
use DoubleStarSystems\ZxcvbnSymfony\Constraint\PasswordStrength;

class User
{
    /**
     * @PasswordStrength(min_score=3, message="Custom message for weak password error")
     */
    private $password;
}
```

You may simply use the simpler `@PasswordStrength(3)` form for a minimum
password score of `3`, if you don't need a custom message.  
More information on validation with Symfony validator can be found in
[the documentation](http://symfony.com/doc/current/book/validation.html).

Alternatively, the constraint can be added directly to form fields.

```php
use DoubleStarSystems\ZxcvbnSymfony\Constraint\PasswordStrength;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        ->add('password', PasswordType::class, [
            'required' => true,
            'constraints' => [
                new PasswordStrength(['min_score' => 3]),
            ],
        ])
    ;
}
```

## Score
The score is an integer from 0-4 (you can mentally represent it as a strength bar)
- `0` too guessable: risky password. (guesses < 10^3)
- `1` very guessable: protection from throttled online attacks. (guesses < 10^6)
- `2` somewhat guessable: protection from unthrottled online attacks. (guesses < 10^8)
- `3` safely unguessable: moderate protection from offline slow-hash scenario. (guesses < 10^10)
- `4` very unguessable: strong protection from offline slow-hash scenario. (guesses >= 10^10)

## License
This Source Code Form is subject to the terms of the Mozilla Public
License, v. 2.0. If a copy of the MPL was not distributed with this
file, You can obtain one at http://mozilla.org/MPL/2.0/.  
See the [complete license](LICENSE).

This project is a fork of Mathieu Darse's [Password Strength
Validator](https://github.com/mdarse/password-strength-validator) which is no
longer in active development.
