<?php

namespace App\Controller\Admin;

use App\Entity\Game;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class GameCrudController extends AbstractCrudController
{
  public static function getEntityFqcn(): string
  {
    return Game::class;
  }

  public function configureFields(string $pageName): iterable
  {
    return [
      IdField::new('id')->hideOnForm(),
      TextField::new('name'),
      UrlField::new('photo'),
      DateField::new('createdAt'),
      DateField::new('updatedAt'),
    ];
  }
}
