<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotNullAtCreation extends Constraint
{
  public $message = "Cet élément ne peut être null à la création.";

  public function __construct($options = null, string $message = null, array $groups = null, $payload = null)
  {
    parent::__construct($options, $groups, $payload);

    $this->message = $message ?? $this->message;
  }
}
