<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class NotNullAtCreationValidator extends ConstraintValidator
{

  /** @var RequestStack */
  private $request;

  public function __construct(RequestStack $request)
  {
    $this->request = $request;
  }

  /**
   * @inheritDoc
   */
  public function validate($value, Constraint $constraint): void
  {

    if (!$constraint instanceof NotNullAtCreation) {
      throw new UnexpectedTypeException($constraint, NotNullAtCreation::class);
    }

    if ($value === null && $this->isCreating()) {
      $this->context->buildViolation($constraint->message)
        ->addViolation();
    }
  }

  private function isCreating(): bool
  {
    return !str_contains($this->request->getCurrentRequest()->getQueryString(), "entityId");
  }
}
