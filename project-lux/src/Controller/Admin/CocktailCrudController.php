<?php

namespace App\Controller\Admin;

use App\Entity\Cocktail;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class CocktailCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cocktail::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('name'),
            ImageField::new('photo')->setUploadDir('/public/img')->setBasePath('/img/'),
            Field::new('description')
        ];
    }
}
