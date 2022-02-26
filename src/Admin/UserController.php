<?php

namespace App\Admin;

use App\User\Role;
use App\User\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractCrudController
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }


    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->setPermission(Action::BATCH_DELETE, Role::ROLE_SUPER_ADMIN)
            ->setPermission(Action::NEW, Role::ROLE_SUPER_ADMIN)
            ->setPermission(Action::EDIT, Role::ROLE_SUPER_ADMIN)
            ->setPermission(Action::INDEX, Role::ROLE_SUPER_ADMIN)
            ->setPermission(Action::DETAIL, Role::ROLE_SUPER_ADMIN)
            ->setPermission(Action::SAVE_AND_RETURN, Role::ROLE_SUPER_ADMIN)
            ->setPermission(Action::SAVE_AND_CONTINUE, Role::ROLE_SUPER_ADMIN)
            ->setPermission(Action::SAVE_AND_ADD_ANOTHER, Role::ROLE_SUPER_ADMIN)
            ->setPermission(Action::DELETE, Role::ROLE_SUPER_ADMIN);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('email')->setRequired(true),
            TextField::new('plainPassword')->setFormType(PasswordType::class)->setRequired(false),
            ChoiceField::new('roles')
                ->setChoices(array_merge([
                    'Admin' => Role::ROLE_ADMIN,
                    'Super admin (can edit users)' => Role::ROLE_SUPER_ADMIN,
                ], Role::allRegion()))
                ->allowMultipleChoices(true),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->setUserPlainPassword($entityInstance);

        parent::persistEntity($entityManager, $entityInstance);
    }

    private function setUserPlainPassword(User $user): void
    {
        if ($user->getPlainPassword()) {
            $user->setPassword($this->hasher->hashPassword($user, $user->getPlainPassword()));
        }
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->setUserPlainPassword($entityInstance);

        parent::updateEntity($entityManager, $entityInstance);
    }


}
