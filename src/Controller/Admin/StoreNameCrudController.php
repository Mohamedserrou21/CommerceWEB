<?php

namespace App\Controller\Admin;

use App\Entity\StoreName;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class StoreNameCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StoreName::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('name'),
            TextareaField::new('about'),
            TextareaField::new('description'),
            AssociationField::new('user'),
            ImageField::new('logo')
                ->SetBasePath($this->getParameter("app.path.product_images"))
                ->onlyOnIndex(),

            TextareaField::new('logoFile')
                ->hideOnIndex()
                ->setFormTypeOption(

                    'allow_delete',
                    false,

                )
                ->setFormType(VichImageType::class),

            ImageField::new('carsoule1')
                ->SetBasePath($this->getParameter("app.path.product_images"))
                ->onlyOnIndex(),

            TextareaField::new('carsoul1File')
                ->hideOnIndex()
                ->setFormTypeOption(

                    'allow_delete',
                    false,

                )
                ->setFormType(VichImageType::class),
            ImageField::new('carsoule2')
                ->SetBasePath($this->getParameter("app.path.product_images"))
                ->onlyOnIndex(),

            TextareaField::new('carsoul2File')
                ->hideOnIndex()
                ->setFormTypeOption(

                    'allow_delete',
                    false,

                )
                ->setFormType(VichImageType::class),
            ImageField::new('carsoule3')
                ->SetBasePath($this->getParameter("app.path.product_images"))
                ->onlyOnIndex(),

            TextareaField::new('carsoul3File')
                ->hideOnIndex()
                ->setFormTypeOption(

                    'allow_delete',
                    false,

                )
                ->setFormType(VichImageType::class),

            DateField::new('updatedAt'),
        ];
    }
}
