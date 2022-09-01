<?php

namespace App\Controller\Admin;

use App\Entity\VspPrice;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class VspPriceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VspPrice::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Prix')
            ->setEntityLabelInPlural('Prix')
            ->setPageTitle('index', '%entity_label_plural%');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()
                ->hideOnIndex(),
            TextField::new('size', 'Conditionnement'),
            TextField::new('price', 'Prix'),
            TextField::new('priceFor5', 'Prix à partir de 5'),
            TextField::new('priceFor10', 'Prix à partir de 10'),

        ];
    }
}
