<?php

namespace App\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 *
 * @Route("/admin")
 */

class DashboardController extends Controller
{
    /**
     * @Route("/", name="dashboard")
     *
     * @param Request $request Request
     *
     * @return Response
     */
    public function dashboardAction(Request $request)
    {
        return $this->render('admin/pages/dashboard.html.twig', []);
    }
}
