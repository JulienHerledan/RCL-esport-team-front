<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }



    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            EmailField::new('email'),
            TextField::new('nickname'),
            ArrayField::new('roles'),
            TextField::new('password')->onlyOnForms(),
            AssociationField::new('articles')->onlyOnForms(),
            BooleanField::new('isActive'),
            DateField::new('createdAt')->onlyOnIndex(),
            DateField::new('updatedAt')->onlyOnIndex(),
            AssociationField::new('members')->onlyOnForms(),
            AssociationField::new('applies')->onlyOnForms(),
        ];
    }

}
