<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;


class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()
                ->hideOnIndex(),
            AssociationField::new('category', 'Catégorie'),
            TextField::new('name', 'Référence'),
            SlugField::new('slug')->setTargetFieldName('name')
                ->hideOnIndex(),
            TextEditorField::new('description'),
            BooleanField::new('new', 'Nouveauté?'),
            BooleanField::new('best', 'Meilleures ventes?'),
            ImageField::new('presentation_pic', 'Photo de présentation')->setBasePath('uploads/Vsp')
                ->setUploadDir('public/uploads/Vsp')
                ->setUploadedFileNamePattern('[slug].[randomhash].[extension]')
                ->setRequired(false),
            DateTimeField::new('created_at', 'Date de création')
                ->hideOnIndex()
                ->setFormat('short', 'none'),
            AssociationField::new('availablity', 'Disponibilité'),

        ];
    }
}
