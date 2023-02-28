<?php

namespace App\Controller\Admin;

use App\Entity\VideoClip;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VideoClipCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VideoClip::class;
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
