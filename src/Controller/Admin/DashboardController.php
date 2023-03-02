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
use App\Entity\VideoClip;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('RCL eSport Team')
            ->setFaviconPath('assets/images/Logo.png');
            // ->renderContentMaximized();
            // ->renderSidebarMinimized();

    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {

        // i get back the user to use Setemail / setNickname and setPassword
        /** @var User $user */
        $user = $this->getUser();
        // Usually it's better to call the parent method because that gives you a
        // user menu with some menu items already created ("sign out", "exit impersonation", etc.)
        // if you prefer to create the user menu from scratch, use: return UserMenu::new()->...
        return parent::configureUserMenu($user)
            // use the given $user object to get the user name
            ->setName($user->getEmail())
            // use this method if you don't want to display the name of the user
            ->displayUserName(true)

            // you can return an URL with the avatar image
            ->setAvatarUrl('https://i.imgur.com/oL8pwL0.jpg')
            ->displayUserAvatar(true)

           ->addMenuItems([
            MenuItem::linkToRoute('My Profile', 'fa fa-id-card', '...', ['...' => '...']),
        ]);
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Users');
        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);

        yield MenuItem::section('Articles');
        yield MenuItem::linkToCrud('Articles', 'far fa-newspaper', Article::class);
        yield MenuItem::linkToCrud('Comments', 'far fa-comments', Comment::class);

        yield MenuItem::section('Apply');
        yield MenuItem::linkToCrud('Applys', 'fas fa-id-card-alt', Apply::class);

        yield MenuItem::section('Members');
        yield MenuItem::linkToCrud('Members', 'fas fa-headset', Member::class);
        yield MenuItem::linkToCrud('Games', 'fas fa-gamepad', Game::class);
        yield MenuItem::linkToCrud('SocialNetworks', 'fab fa-twitter-square', SocialNetwork::class);
        yield MenuItem::linkToCrud('SocialNetwork links', 'fas fa-link', SocialNetworkLink::class);
        yield MenuItem::linkToCrud('VideoClips', 'fas fa-video', VideoClip::class);
        yield MenuItem::linkToCrud('Awards', 'fas fa-trophy', Award::class);
        yield MenuItem::linkToCrud('Competitions', 'fas fa-calendar-week', Competition::class);
        yield MenuItem::linkToCrud('Matches', 'fas fa-sitemap', Matche::class);

        //@todo rajouter le lien vers le font office
        // ==> MenuItem::linkToUrl
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);

    }
}
