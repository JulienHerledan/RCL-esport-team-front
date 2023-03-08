<?php

namespace App\Controller\Admin;

use App\Entity\SocialNetworkLink;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class SocialNetworkLinkCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SocialNetworkLink::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            UrlField::new('link'),
            AssociationField::new('member'),
            AssociationField::new('socialNetwork'),
        ];
    }
    
}
