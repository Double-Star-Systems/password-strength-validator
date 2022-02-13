<?php

namespace DoubleStarSystems\ZxcvbnSymfony\Constraint;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Exception\MissingOptionsException;

class PasswordStrengthTest extends TestCase
{
    public function testDefaultOption()
    {
        $constraint = new PasswordStrength(2);
        $this->assertEquals(2, $constraint->min_score);
    }

    public function testMinimumRequiredOptions()
    {
        new PasswordStrength(['min_score' => 2]);
    }

    public function testMissingScore()
    {
        $this->setExpectedException(MissingOptionsException::class);
        $this->expectExceptionMessageRegExp('/min_score/');

        new PasswordStrength();
    }
}
