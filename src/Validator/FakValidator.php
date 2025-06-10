<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class FakValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        /* @var Fak $constraint */

        if (null === $value || '' === $value) {
            return;
        }

        // TODO: implement the validation here
        if(str_contains($value, 'fak')) {
                    $this->context->buildViolation($constraint->message)
                        ->setParameter('{{ value }}', $value)
                        ->addViolation();
        }

    }
}
