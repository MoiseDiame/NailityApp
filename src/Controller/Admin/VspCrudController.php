<?php

namespace App\Controller\Admin;

use App\Entity\Vsp;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityDeletedEvent as BeforeEntityDeletedEvent;



class VspCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vsp::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()
                ->hideOnIndex(),
            TextField::new('name', 'Référence'),
            SlugField::new('slug')->setTargetFieldName('name')
                ->hideOnIndex(),
            TextEditorField::new('description'),
            BooleanField::new('new', 'Nouveauté?'),
            ImageField::new('presentation_picture', 'Photo de présentation')->setBasePath('uploads/Vsp')
                ->setUploadDir('public/uploads/Vsp')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            ImageField::new('illustration_picture1', 'Illustration 1')->setBasePath('uploads/Vsp')
                ->setUploadDir('public/uploads/Vsp')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            ImageField::new('illustration_picture2', 'Illustration 2')->setBasePath('uploads/Vsp')
                ->setUploadDir('public/uploads/Vsp')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            DateTimeField::new('created_at', 'Date de création'),
            AssociationField::new('color', 'Couleur'),
            AssociationField::new('availablity', 'Disponibilité')


        ];
    }
}
