<?php

namespace App\Controller\Admin;

use App\Entity\VspPrice;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

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
            AssociationField::new('size', 'Conditionnement'),
            MoneyField::new('price', 'Prix')
                ->setCurrency('EUR'),
            MoneyField::new('priceFor5', 'Prix à partir de 5')
                ->setCurrency('EUR'),
            MoneyField::new('priceFor10', 'Prix à partir de 10')
                ->setCurrency('EUR'),


        ];
    }
}
