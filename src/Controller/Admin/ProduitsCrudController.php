<?php

namespace App\Controller\Admin;

use App\Entity\Produits;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ProduitsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produits::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('nom'),
            TextareaField::new('description'),
            ImageField::new('image')
                ->SetBasePath($this->getParameter("app.path.product_images"))
                ->onlyOnIndex(),

            TextareaField::new('ImageFile')
                ->hideOnIndex()
                ->setFormTypeOption(

                    'allow_delete',
                    false,

                )
                ->setFormType(VichImageType::class),
            MoneyField::new('prix')->setCurrency('MAD'),
            AssociationField::new('store'),
            DateField::new('updatedAt'),
        ];
    }
}
