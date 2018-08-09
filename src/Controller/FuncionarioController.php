<?php

namespace App\Controller;

use App\Entity\Funcionario;
use App\Form\FuncionarioType;
use App\Repository\FuncionarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/funcionario")
 */
class FuncionarioController extends Controller
{
    /**
     * @Route("/", name="funcionario_index", methods="GET")
     */
    public function index(FuncionarioRepository $funcionarioRepository): Response
    {
        return $this->render('funcionario/index.html.twig', ['funcionarios' => $funcionarioRepository->findAll()]);
    }

    /**
     * @Route("/new", name="funcionario_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $funcionario = new Funcionario();
        $form = $this->createForm(FuncionarioType::class, $funcionario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($funcionario);
            $em->flush();

            return $this->redirectToRoute('funcionario_index');
        }

        return $this->render('funcionario/new.html.twig', [
            'funcionario' => $funcionario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="funcionario_show", methods="GET")
     */
    public function show(Funcionario $funcionario): Response
    {
        return $this->render('funcionario/show.html.twig', ['funcionario' => $funcionario]);
    }

    /**
     * @Route("/{id}/edit", name="funcionario_edit", methods="GET|POST")
     */
    public function edit(Request $request, Funcionario $funcionario): Response
    {
        $form = $this->createForm(FuncionarioType::class, $funcionario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('funcionario_edit', ['id' => $funcionario->getId()]);
        }

        return $this->render('funcionario/edit.html.twig', [
            'funcionario' => $funcionario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="funcionario_delete", methods="DELETE")
     */
    public function delete(Request $request, Funcionario $funcionario): Response
    {
        if ($this->isCsrfTokenValid('delete'.$funcionario->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($funcionario);
            $em->flush();
        }

        return $this->redirectToRoute('funcionario_index');
    }
}
