<?php

namespace App\Admin;

use App\Admin\Fields\EnumField;
use App\Notification\Notification;
use App\Notification\NotificationRegion;
use App\Notification\Notifier;
use App\User\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
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

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        return parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters)
            ->andWhere('entity.region in (:regions)')
            ->orderBy('entity.createdAt', 'DESC')
            ->setParameter('regions', collect($this->getUser()->getAllowedRegions())
                ->map(fn(NotificationRegion $region) => $region->getValue())
                ->all());
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            EnumField::new('region', 'Регіон')
                ->setEnumType(NotificationRegion::class)
                ->setFormTypeOption('choices', $this->getRegions()),
            ChoiceField::new('signal', 'Сигнал')
                ->setChoices([
                    "🚨" => "🚨",
                    "‼️" => "‼️",
                    "⚠️" => "⚠️"
                ])->setCustomOption('autocomplete', false),
            BooleanField::new('duplicateToAll', 'Також на всю Україну!!!'),
            $this->addNewDataOnEdit(
                TextareaField::new('title', 'Tитул')
                    ->setRequired(true), $pageName, ' - Повітряна тривога'
            ),
            $this->addNewDataOnEdit(
                TextareaField::new('body', 'Текст')
                    ->setRequired(true), $pageName, 'Рухайтесь до укриттів!'
            ),
            Field::new('created_at', 'Створено')
                ->setTemplatePath('date.html.twig')
                ->onlyOnIndex(),
        ];
    }

    private function getRegions(): array
    {
        /** @var User $user */
        $user = $this->getUser();
        return collect($user->getAllowedRegions())
            ->keyBy(fn(NotificationRegion $region) => $region->getReadable())->all();
    }

    private function addNewDataOnEdit(TextareaField $field, string $pageName, string $text): TextareaField
    {
        if ($pageName === 'new') {
            $field->setFormTypeOption('data', $text);
        }
        return $field;
    }

}
