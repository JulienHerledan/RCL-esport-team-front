<?php

namespace App\Controller\Admin;

use App\Entity\Competition;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CompetitionCrudController extends AbstractCrudController
{
  public static function getEntityFqcn(): string
  {
    return Competition::class;
  }

  public function configureFields(string $pageName): iterable
  {
    return [
      IdField::new('id')->hideOnForm(),
      TextField::new('name'),
      DateField::new('date'),
      DateField::new('createdAt')->onlyOnIndex(),
      DateField::new('updatedAt')->onlyOnIndex(),
    ];
  }
}
