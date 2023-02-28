<?php

namespace App\Controller\Admin;

use App\Entity\Member;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class MemberCrudController extends AbstractCrudController
{
  public static function getEntityFqcn(): string
  {
    return Member::class;
  }

  public function configureFields(string $pageName): iterable
  {
    return [
      IdField::new('id'),
      TextField::new('username'),
      TextField::new('firstname'),
      TextField::new('lastname'),
      UrlField::new('photo'),
      IntegerField::new('age'),
      TextEditorField::new('biography'),
      DateField::new('birthday'),
      AssociationField::new('createdBy'),
      AssociationField::new('games'),
      AssociationField::new('awards'),
      AssociationField::new('socialNetworkLinks'),
      DateField::new('createdAt'),
      DateField::new('updatedAt'),
    ];
  }
}
