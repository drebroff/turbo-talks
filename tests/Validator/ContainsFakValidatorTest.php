<?php

namespace App\Tests\Validator;

use App\Validator\FakValidator;
use App\Validator\Fak;
use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class ContainsFakValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): ConstraintValidatorInterface
    {
        return new FakValidator();
    }

    public function testNullIsValid(): void
    {
        $this->validator->validate(null, new Fak());

        $this->assertNoViolation();
    }

    /**
     * @dataProvider provideInvalidConstraints
     */
    public function testTrueIsInvalid(Fak $constraint): void
    {
        $this->validator->validate('...', $constraint);
//
//        $this->buildViolation('...')
//            ->setParameter('{{ string }}', '...')
//            ->assertRaised();
    }

    public function provideInvalidConstraints(): \Generator
    {
        yield [new Fak()];
        // ...
    }
}