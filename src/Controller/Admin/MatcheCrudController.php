<?php

namespace App\Controller\Admin;

use App\Entity\Matche;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MatcheCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Matche::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
