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
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
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

  /** @var EntityManagerInterface */
  private $entityManager;

  public function __construct(EntityManagerInterface $entityManager)
  {

    $this->entityManager = $entityManager;

  }

  /**
   * @Route("/admin", name="admin")
   */
  public function index(): Response
  {
    return $this->render('admin/welcome.html.twig', [
      'userCount' => $this->entityManager->getRepository(User::class)->count([]),
      'articlesCount' => $this->entityManager->getRepository(Article::class)->count([]),
      'commentsCount' => $this->entityManager->getRepository(Comment::class)->count([]),
      'notResolvedApplies' => $this->entityManager->getRepository(Apply::class)->count(['isAccepted' => false]),
    ]);
  }

  public function configureDashboard(): Dashboard
  {
    return Dashboard::new()
      ->setTitle('RCL eSport Team')
      ->setFaviconPath('assets/images/Logo.png');
  }

  public function configureCrud(): Crud
  {
    return parent::configureCrud()->setSearchFields(null);
  }

  public function configureUserMenu(UserInterface $user): UserMenu
  {

    /** @var User $user */

    // Usually it's better to call the parent method because that gives you a
    // user menu with some menu items already created ("sign out", "exit impersonation", etc.)
    // if you prefer to create the user menu from scratch, use: return UserMenu::new()->...
    return parent::configureUserMenu($user)
      // use the given $user object to get the username
      ->setName($user->getEmail())
      // use this method if you don't want to display the name of the user
      ->displayUserName(true)

      // you can return an URL with the avatar image
      ->setAvatarUrl('https://i.imgur.com/oL8pwL0.jpg')
      ->displayUserAvatar(true)
      ->addMenuItems([
        MenuItem::linkToUrl('Front-Office', 'fa fa-home', 'http://localhost:8080/'),
      ]);
  }

  public function configureAssets(): Assets
  {
    return parent::configureAssets()->addCssFile("assets/css/style.css");
  }

  public function configureMenuItems(): iterable
  {
    yield MenuItem::section('Compte');
    yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-users', User::class);

    yield MenuItem::section('Blog');
    yield MenuItem::linkToCrud('Articles', 'far fa-newspaper', Article::class);
    yield MenuItem::linkToCrud('Commentaires', 'far fa-comments', Comment::class);

    yield MenuItem::section('Candidature');
    yield MenuItem::linkToCrud('Candidature', 'fas fa-id-card-alt', Apply::class);

    yield MenuItem::section('E-Sport');
    yield MenuItem::linkToCrud('Membres équipe', 'fas fa-headset', Member::class);
    yield MenuItem::linkToCrud('Jeux', 'fas fa-gamepad', Game::class);
    yield MenuItem::linkToCrud('Réseaux sociaux', 'fab fa-twitter-square', SocialNetwork::class);
    yield MenuItem::linkToCrud('Liens réseaux sociaux', 'fas fa-link', SocialNetworkLink::class);
    yield MenuItem::linkToCrud('Clips vidéos', 'fas fa-video', VideoClip::class);
    yield MenuItem::linkToCrud('Réussites', 'fas fa-trophy', Award::class);
    yield MenuItem::linkToCrud('Competitions', 'fas fa-calendar-week', Competition::class);
    yield MenuItem::linkToCrud('Matchs', 'fas fa-sitemap', Matche::class);

    //@todo rajouter le lien vers le font office
    // ==> MenuItem::linkToUrl
    // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);

  }
}
