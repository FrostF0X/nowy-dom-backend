<?php

namespace App\Admin;

use App\Admin\Fields\EnumField;
use App\Notification\Notification;
use App\Notification\NotificationRegion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class NotificationController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Notification::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            EnumField::new('region')->setEnumType(NotificationRegion::class),
            TextareaField::new('text'),
        ];
    }


}
