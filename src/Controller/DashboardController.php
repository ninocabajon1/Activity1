<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        $user = $this->getUser();
        $isAdmin = $this->isGranted('ROLE_ADMIN');
        
        return $this->render('dashboard/index.html.twig', [
            'is_admin' => $isAdmin,
            'username' => $user ? $user->getUserIdentifier() : 'Guest',
        ]);
    }
}
