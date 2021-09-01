<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('author'),
            TextField::new('title'),
            SlugField::new('slug')->setTargetFieldName('title'),
            ImageField::new('illustration')->setBasePath('img/')
                ->setUploadDir('public/img/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired('false'),
            MoneyField::new('price')->setCurrency('EUR'),
            BooleanField::new('bestseller'),

        ];
    }

}
