<?php

declare(strict_types = 1);

namespace BeHappy\SyliusAgeVerificationPlugin\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class AgeVerificationValidator
 *
 * @package BeHappy\SyliusAgeVerificationPlugin\Validator\Constraints
 */
class AgeVerificationValidator extends ConstraintValidator
{
    /**
     * @param \DateTime                  $value
     * @param AgeVerification|Constraint $constraint
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$value instanceof \DateTime) {
            return;
        }
        $today = new \DateTime();
        if ($today < $value) {
            $this->context->buildViolation($constraint->dateInFutureMessage)
                ->setTranslationDomain('messages')
                ->addViolation();
        
            return;
        }
    
        $difference = $value->diff($today);
    
        if ($difference->y < $constraint->age) {
            $this->context->buildViolation($constraint->tooYoungMessage)
                ->setParameter('%minimal_age%', $constraint->age)
                ->setTranslationDomain('messages')
                ->addViolation();
            return;
        }
    }
}