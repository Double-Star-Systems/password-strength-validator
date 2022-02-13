<?php

namespace DoubleStarSystems\ZxcvbnSymfony\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use ZxcvbnPhp\Zxcvbn;

class PasswordStrengthValidator extends ConstraintValidator
{
    private $zxcvbn;

    public function __construct(Zxcvbn $zxcvbn = null)
    {
        $this->zxcvbn = $zxcvbn ?: new Zxcvbn();
    }

    public function validate($value, Constraint $constraint)
    {
        // TODO Implement another annotation to mark user data to use these
        // properties in dictionary match

        $strength = $this->zxcvbn->passwordStrength($value);
        if (!isset($strength['score'])) {
            throw new \LogicException('Invalid strength data from zxcvbn.');
        }

        if ($strength['score'] < $constraint->min_score) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
