<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Client::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('companyName'),
            TextField::new('typeOfActivity'),
            TextField::new('contactName'),
            TextField::new('contactPosition'),
            TextField::new('contactNumber'),
            TextField::new('contactEmail'),
            TextEditorField::new('notes'),
        ];
    }
}
