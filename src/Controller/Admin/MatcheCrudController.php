<?php

namespace App\Controller\Admin;

use App\Entity\Matche;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class MatcheCrudController extends AbstractCrudController
{
  public static function getEntityFqcn(): string
  {
    return Matche::class;
  }

  public function configureFields(string $pageName): iterable
  {
    return [
      IdField::new('id'),
      AssociationField::new('competition'),
      TextField::new('opponent'),
      UrlField::new('opponentIcon'),
      DateField::new('date'),
      TextField::new('score'),
      DateField::new('createdAt'),
      DateField::new('updatedAt'),
    ];
  }
}
