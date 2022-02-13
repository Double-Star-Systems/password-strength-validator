<?php

namespace DoubleStarSystems\ZxcvbnSymfony\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PasswordStrength extends Constraint
{
    public $min_score;
    public $message = 'Password is too weak.';

    public function getDefaultOption()
    {
        return 'min_score';
    }

    public function getRequiredOptions()
    {
        return ['min_score'];
    }
}
