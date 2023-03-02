<?php

namespace App\Controller\Admin;

use App\Entity\Member;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
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
      IdField::new('id')->hideOnForm(),
      TextField::new('username'),
      TextField::new('firstname'),
      TextField::new('lastname'),
      UrlField::new('photo')->hideOnIndex(),
      IntegerField::new('age'),
      TextareaField::new('biography')->hideOnIndex(),
      DateField::new('birthday')->hideOnIndex(),
      AssociationField::new('createdBy'),
      AssociationField::new('games')->hideOnIndex(),
      AssociationField::new('awards')->hideOnIndex(),
      AssociationField::new('socialNetworkLinks')->hideOnIndex(),
      DateField::new('createdAt')->onlyOnIndex(),
      DateField::new('updatedAt')->onlyOnIndex(),
    ];
  }

  public function configureActions(Actions $actions): Actions
  {
      return $actions
        ->add(Crud::PAGE_INDEX, Action::DETAIL);
  }
}
