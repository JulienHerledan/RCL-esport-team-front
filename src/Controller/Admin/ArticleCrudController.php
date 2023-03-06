<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class ArticleCrudController extends AbstractCrudController
{
  public static function getEntityFqcn(): string
  {
    return Article::class;
  }

  public function configureFields(string $pageName): iterable
  {
    return [
      IdField::new('id')->hideOnForm(),
      AssociationField::new('author'),
      TextField::new('title'),
      UrlField::new('image')->hideOnIndex(),
      TextareaField::new('resume')->hideOnIndex(),
      TextareaField::new('content')->hideOnIndex(),
      DateField::new('createdAt')->onlyOnIndex(),
      DateField::new('updatedAt')->onlyOnIndex(),
    ];
  }
}
