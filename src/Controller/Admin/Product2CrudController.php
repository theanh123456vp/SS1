<?php

namespace App\Controller\Admin;

use App\Entity\Product2;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class Product2CrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product2::class;
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
