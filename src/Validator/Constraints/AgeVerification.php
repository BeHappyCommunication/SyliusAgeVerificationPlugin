<?php

declare(strict_types = 1);

namespace BeHappy\SyliusAgeVerificationPlugin\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class AgeVerification
 *
 * @package BeHappy\SyliusAgeVerificationPlugin\Validator\Constraints
 */
class AgeVerification extends Constraint
{
    /** @var string */
    public $tooYoungMessage = 'be_happy.age_verification.too_young';
    /** @var string */
    public $dateInFutureMessage = 'be_happy.age_verification.date_in_future';
    /** @var int */
    public $age = 0;
}