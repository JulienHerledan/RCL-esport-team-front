<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotNullAtCreation extends Constraint
{
  public $message = "Cet élément ne peut être null à la création.";
}
