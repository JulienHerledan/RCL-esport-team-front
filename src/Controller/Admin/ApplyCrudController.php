<?php

namespace App\Controller\Admin;

use App\Entity\Apply;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;

class ApplyCrudController extends AbstractCrudController
{
  public static function getEntityFqcn(): string
  {
    return Apply::class;
  }

  public function configureFields(string $pageName): iterable
  {
    return [
      IdField::new('id')->hideOnForm(),
      TextField::new('name')->hideOnForm(),
      EmailField::new('email')->hideOnForm(),
      TelephoneField::new('phoneNumber')->hideOnForm(),
      TextEditorField::new('presentation')->hideOnForm(),
      BooleanField::new('IsAccepted'),
      AssociationField::new('acceptedBy')->hideOnForm(),
      DateField::new('createdAt')->hideOnForm(),
      DateField::new('updatedAt')->hideOnForm(),
    ];
  }

}
