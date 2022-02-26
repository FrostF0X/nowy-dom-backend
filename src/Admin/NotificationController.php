<?php

namespace App\Admin;

use App\Admin\Fields\EnumField;
use App\Notification\Notification;
use App\Notification\NotificationRegion;
use App\Notification\Notifier;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;

class NotificationController extends AbstractCrudController
{

    public function __construct(private Notifier $notifier)
    {
    }

    public static function getEntityFqcn(): string
    {
        return Notification::class;
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param Notification $entityInstance
     * @throws FirebaseException
     * @throws MessagingException
     */
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        parent::persistEntity($entityManager, $entityInstance);
        $this->notifier->send($entityInstance);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            EnumField::new('region')->setEnumType(NotificationRegion::class),
            TextareaField::new('title'),
            TextareaField::new('body'),
            DateTimeField::new('created_at')->onlyOnIndex(),
        ];
    }


}
