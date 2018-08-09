<?php

namespace App\Controller;

use App\Entity\Departamento;
use App\Form\DepartamentoType;
use App\Repository\DepartamentoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/departamento")
 */
class DepartamentoController extends Controller
{
    /**
     * @Route("/", name="departamento_index", methods="GET")
     */
    public function index(DepartamentoRepository $departamentoRepository): Response
    {
        return $this->render('departamento/index.html.twig', ['departamentos' => $departamentoRepository->findAll()]);
    }

    /**
     * @Route("/new", name="departamento_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $departamento = new Departamento();
        $form = $this->createForm(DepartamentoType::class, $departamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($departamento);
            $em->flush();

            return $this->redirectToRoute('departamento_index');
        }

        return $this->render('departamento/new.html.twig', [
            'departamento' => $departamento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="departamento_show", methods="GET")
     */
    public function show(Departamento $departamento): Response
    {
        return $this->render('departamento/show.html.twig', ['departamento' => $departamento]);
    }

    /**
     * @Route("/{id}/edit", name="departamento_edit", methods="GET|POST")
     */
    public function edit(Request $request, Departamento $departamento): Response
    {
        $form = $this->createForm(DepartamentoType::class, $departamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('departamento_edit', ['id' => $departamento->getId()]);
        }

        return $this->render('departamento/edit.html.twig', [
            'departamento' => $departamento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="departamento_delete", methods="DELETE")
     */
    public function delete(Request $request, Departamento $departamento): Response
    {
        if ($this->isCsrfTokenValid('delete'.$departamento->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($departamento);
            $em->flush();
        }

        return $this->redirectToRoute('departamento_index');
    }
}
