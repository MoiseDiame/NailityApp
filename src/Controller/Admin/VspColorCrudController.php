<?php

namespace App\Controller\Admin;

use App\Entity\VspColor;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;



class VspColorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VspColor::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()
                ->hideOnIndex(),
            TextField::new('color', 'Coloris'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Coloris')
            ->setEntityLabelInPlural('Coloris')
            ->setPageTitle('index', ' Listing des %entity_label_plural%');
    }
}
