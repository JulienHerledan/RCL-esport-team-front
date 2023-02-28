<?php

namespace App\Controller\Admin;

use App\Entity\VideoClip;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class VideoClipCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VideoClip::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            UrlField::new('link'),
            DateField::new('createdAt'),
            DateField::new('updatedAt'),
        ];
    }
    
}
