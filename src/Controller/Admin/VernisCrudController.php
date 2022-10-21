<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Controller\Admin\ProductCrudController;
use App\Entity\ProductCategory;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
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
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use Doctrine\ORM\QueryBuilder;
use phpDocumentor\Reflection\PseudoTypes\True_;

/**
 * Pour chaque catégorie de produits, il y aura un CRUD de l'entité Produit afin de n'afficher 
 * que les caractéristiques propres à cette catégorie. Ici nous gérons que les vernis semi-permanents
 */
class VernisCrudController extends ProductCrudController
{
    public function __construct(EntityRepository $entityRepository, EntityManagerInterface $entitymanager, ProductRepository $productRepository)
    {
        $this->entityRepository = $entityRepository;
        $this->entitymanager = $entitymanager;
        $this->repository = $productRepository;
    }
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    /**
     * Afin d'éviter une mauvaise manipulation, on limite le choix de la catégorie 
     * au seul vernis semi-permanent durant l'ensemble des opérations CRUD
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()
                ->hideOnIndex()
                ->hideOnDetail(),
            AssociationField::new('category', 'Catégorie')
                ->hideOnIndex()
                ->hideOnDetail()
                ->setFormTypeOption('query_builder', function (ProductCategoryRepository $repository) {
                    return $repository->createQueryBuilder('c')
                        ->andWhere('c.name = :category')
                        ->setParameter('category', 'vernis semi-permanents');
                }),
            TextField::new('name', 'Référence'),
            AssociationField::new('VspSize', 'Conditionnement')
                ->setRequired(true),
            SlugField::new('slug')->setTargetFieldName('name')
                ->hideOnIndex()
                ->hideOnDetail(),
            AssociationField::new('VspColor', 'Colori')
                ->setLabel('Colori')
                ->setRequired(true),
            TextEditorField::new('description')
                ->hideOnIndex()
                ->setRequired(false),
            ImageField::new('presentation_pic', 'Photo de présentation')->setBasePath('uploads/ProductPictures')
                ->setUploadDir('public/uploads/ProductPictures')
                ->setUploadedFileNamePattern('[slug].[randomhash].[extension]')
                ->setRequired(true),
            DateTimeField::new('created_at', 'Date de création')
                ->hideOnIndex()
                ->setFormat('short', 'none'),
            AssociationField::new('availablity', 'Disponibilité'),
            BooleanField::new('new', 'Nouveauté?'),
            BooleanField::new('best', 'Meilleures ventes?'),
            AssociationField::new('VspPrice', 'Prix')
                ->setRequired(true),
            ImageField::new('illustration_pic1', 'Illustration 1')->setBasePath('uploads/ProductPictures')
                ->setUploadDir('public/uploads/ProductPictures')
                ->setUploadedFileNamePattern('[slug].[randomhash].[extension]')
                ->setRequired(false),
            ImageField::new('illustration_pic2', 'Illustration 2')->setBasePath('uploads/ProductPictures')
                ->setUploadDir('public/uploads/ProductPictures')
                ->setUploadedFileNamePattern('[slug].[randomhash].[extension]')
                ->setRequired(false),

            NumberField::new('weight', 'Poids(g)')
                ->setRequired(true)
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDateFormat('short')
            ->setEntityLabelInSingular('Vernis')
            ->setEntityLabelInPlural('Vernis')
            ->setPageTitle('index', ' Références des vernis semi-permanents ')
            ->setPageTitle('detail', 'Détails du produit')
            ->setSearchFields(['name', 'VspColor.color', 'description', 'availablity.status']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('VspColor')
            ->add('availablity');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);

        $category = $this->entitymanager->getRepository(ProductCategory::class)->findOneByName('vernis semi-permanents');

        $response = $this->entityRepository->createQueryBuilder($searchDto, $entityDto, $fields, $filters)
            ->andwhere('entity.category = :category')
            ->setParameter('category', $category);

        return $response;
    }
}
