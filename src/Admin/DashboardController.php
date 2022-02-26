<?php

namespace App\Admin;

use App\Notification\Notification;
use App\User\Role;
use App\User\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(NotificationController::class)->generateUrl());
    }

    #[Route('/', name: 'index')]
    public function appIndex(): Response
    {
        return $this->redirectToRoute('admin');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Www');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Notifications', 'fas fa-list', Notification::class);
        yield MenuItem::linkToCrud('User', 'fa fa-user-circle', User::class)
            ->setPermission(Role::ROLE_SUPER_ADMIN);
    }
}
