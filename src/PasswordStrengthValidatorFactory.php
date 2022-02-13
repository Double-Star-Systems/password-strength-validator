<?php

namespace DoubleStarSystems\ZxcvbnSymfony;

use DoubleStarSystems\ZxcvbnSymfony\Constraint\PasswordStrength;
use DoubleStarSystems\ZxcvbnSymfony\Constraint\PasswordStrengthValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidatorFactory;
use ZxcvbnPhp\Zxcvbn;

class PasswordStrengthValidatorFactory extends ConstraintValidatorFactory
{
    private $zxcvbn;

    public function __construct(Zxcvbn $zxcvbn)
    {
        $this->zxcvbn = $zxcvbn;
    }

    public function getInstance(Constraint $constraint)
    {
        return $constraint instanceof PasswordStrength
            ? new PasswordStrengthValidator($this->zxcvbn)
            : parent::getInstance($constraint);
    }
}
