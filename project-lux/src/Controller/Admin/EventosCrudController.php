<?php

namespace App\Controller\Admin;

use App\Entity\Eventos;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class EventosCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Eventos::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('name'),
            ImageField::new('photo')->setUploadDir('/public/img')->setBasePath('/img/'),
            DateField::new('date')
        ];
    }
}
