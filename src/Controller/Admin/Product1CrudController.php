<?php

namespace App\Controller\Admin;

use App\Entity\Product1;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class Product1CrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product1::class;
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