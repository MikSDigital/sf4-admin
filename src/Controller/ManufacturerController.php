<?php

namespace App\Controller;

use App\Entity\Manufacturer;
use App\Form\Manufacturer1Type;
use App\Form\ManufacturerType;
use App\Repository\ManufacturerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/manufacturer")
 */
class ManufacturerController extends Controller
{
    /**
     * @Route("/", name="manufacturer_index", methods="GET")
     */
    public function index(ManufacturerRepository $manufacturerRepository): Response
    {
        return $this->render('admin/pages/manufacturer/index.html.twig', ['manufacturers' => $manufacturerRepository->findAll()]);
    }

    /**
     * @Route("/new", name="manufacturer_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $manufacturer = new Manufacturer();
        $form = $this->createForm(ManufacturerType::class, $manufacturer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($manufacturer);
            $em->flush();

            return $this->redirectToRoute('manufacturer_show', ['id' => $manufacturer->getId()]);
        }

        return $this->render('admin/pages/manufacturer/new.html.twig', [
            'manufacturer'  => $manufacturer,
            'form'          => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="manufacturer_show", methods="GET")
     */
    public function show(Manufacturer $manufacturer): Response
    {
        return $this->render('admin/pages/manufacturer/show.html.twig', [
            'manufacturer' => $manufacturer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="manufacturer_edit", methods="GET|POST")
     */
    public function edit(Request $request, Manufacturer $manufacturer): Response
    {
        $form = $this->createForm(ManufacturerType::class, $manufacturer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('manufacturer_edit', ['id' => $manufacturer->getId()]);
        }

        return $this->render('admin/pages/manufacturer/edit.html.twig', [
            'manufacturer' => $manufacturer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="manufacturer_delete", methods="DELETE")
     */
    public function delete(Request $request, Manufacturer $manufacturer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$manufacturer->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($manufacturer);
            $em->flush();
        }

        return $this->redirectToRoute('manufacturer_index');
    }
}
