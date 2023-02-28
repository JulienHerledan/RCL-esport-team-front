<?php

namespace App\Controller\Admin;

use App\Entity\Apply;
use App\Entity\Article;
use App\Entity\Award;
use App\Entity\Comment;
use App\Entity\Competition;
use App\Entity\Game;
use App\Entity\Matche;
use App\Entity\Member;
use App\Entity\SocialNetwork;
use App\Entity\SocialNetworkLink;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Projet 14 Rcl Esport Team Back');
    }

    public function configureMenuItems(): iterable
    {
        
        yield MenuItem::linkToCrud('User', 'fas fa-users', User::class);

        yield MenuItem::linkToCrud('Articles', 'far fa-newspaper', Article::class);
        yield MenuItem::linkToCrud('Comment', 'far fa-comments', Comment::class);
        yield MenuItem::linkToCrud('Apply', 'fas fa-id-card-alt', Apply::class);
        yield MenuItem::linkToCrud('Member', 'fas fa-headset', Member::class);
        yield MenuItem::linkToCrud('Game', 'fas fa-gamepad', Game::class);
        yield MenuItem::linkToCrud('SocialNetwork', 'fab fa-twitter-square', SocialNetwork::class);
        yield MenuItem::linkToCrud('SocialNetwork link', 'fas fa-link', SocialNetworkLink::class);
        yield MenuItem::linkToDashboard('videoClip', 'fas fa-video');
        yield MenuItem::linkToCrud('Award', 'fas fa-trophy', Award::class);
        yield MenuItem::linkToCrud('Competition', 'fas fa-calendar-week', Competition::class);
        yield MenuItem::linkToCrud('Matche', 'fas fa-sitemap', Matche::class);

        

        //@todo rajouter le lien vers le font office
        // ==> MenuItem::linkToUrl
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
