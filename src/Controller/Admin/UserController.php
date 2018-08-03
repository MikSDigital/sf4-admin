<?php

namespace App\Controller\Admin;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @Route("admin/profile", name="user_profile")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function profileAction(Request $request)
    {
        return $this->render('admin/pages/profile.html.twig', []);
    }
}