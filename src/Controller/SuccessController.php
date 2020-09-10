<?php

namespace App\Controller;

use App\Entity\Success;
use App\Form\SuccessType;
use App\Repository\SuccessRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/success")
 */
class SuccessController extends AbstractController
{
    /**
     * @Route("/", name="success_index", methods={"GET"})
     */
    public function index(SuccessRepository $successRepository): Response
    {
        return $this->render('success/index.html.twig', [
            'successes' => $successRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="success_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $success = new Success();
        $form = $this->createForm(SuccessType::class, $success);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($success);
            $entityManager->flush();

            return $this->redirectToRoute('success_index');
        }

        return $this->render('success/new.html.twig', [
            'success' => $success,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="success_show", methods={"GET"})
     */
    public function show(Success $success): Response
    {
        return $this->render('success/show.html.twig', [
            'success' => $success,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="success_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Success $success): Response
    {
        $form = $this->createForm(SuccessType::class, $success);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('success_index');
        }

        return $this->render('success/edit.html.twig', [
            'success' => $success,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="success_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Success $success): Response
    {
        if ($this->isCsrfTokenValid('delete'.$success->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($success);
            $entityManager->flush();
        }

        return $this->redirectToRoute('success_index');
    }
}
