<?php

namespace App\Controller\Admin;

use App\Entity\Offer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;

class OfferCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Offer::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('reference'),
            AssociationField::new('client')->autocomplete(),
            TextEditorField::new('description'),
            BooleanField::new('isActive'),
            TextField::new('jobTitle'),
            AssociationField::new('type')->autocomplete(),
            TextField::new('jobLocation')->setRequired(false),
            AssociationField::new('category')->autocomplete(),
            DateTimeField::new('closingAt')->setRequired(false),
            IntegerField::new('salary')->setRequired(false),
            DateTimeField::new('createdAt'),
        ];
    }

}
