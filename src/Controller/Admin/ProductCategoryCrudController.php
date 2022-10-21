<?php

namespace App\Controller\Admin;

use App\Entity\ProductCategory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;




class ProductCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductCategory::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()
                ->hideOnIndex(),
            TextField::new('name', 'Catégorie'),
            ImageField::new('picture', 'Photo de présentation')->setBasePath('uploads/Category')
                ->setUploadDir('public/uploads/Category')
                ->setUploadedFileNamePattern('[slug].[randomhash].[extension]')
                ->setRequired(true),
            SlugField::new('slug')->setTargetFieldName('name')
                ->hideOnIndex()
                ->hideOnDetail(),

        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Catégorie')
            ->setEntityLabelInPlural('Catégories Produits')
            ->setPageTitle('index', '%entity_label_plural%');
    }
}
