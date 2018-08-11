<?php

namespace App\Controller;

use App\Entity\Movimentacao;
use App\Form\MovimentacaoType;
use App\Repository\MovimentacaoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/movimentacao")
 */
class MovimentacaoController extends Controller
{
    /**
     * @Route("/", name="movimentacao_index", methods="GET")
     */
    public function index(MovimentacaoRepository $movimentacaoRepository): Response
    {
        return $this->render('movimentacao/index.html.twig', ['movimentacoes' => $movimentacaoRepository->findAll()]);
    }

    /**
     * @Route("/new", name="movimentacao_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $movimentacao = new Movimentacao();
        $form_attrs = array('class' => 'form');
        $form = $this->createForm(MovimentacaoType::class, $movimentacao, array('attr' => $form_attrs));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($movimentacao);
            $em->flush();

            return $this->redirectToRoute('movimentacao_index');
        }

        return $this->render('movimentacao/new.html.twig', [
            'movimentacao' => $movimentacao,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="movimentacao_show", methods="GET")
     */
    public function show(Movimentacao $movimentacao): Response
    {
        return $this->render('movimentacao/show.html.twig', ['movimentacao' => $movimentacao]);
    }

    /**
     * @Route("/{id}/edit", name="movimentacao_edit", methods="GET|POST")
     */
    public function edit(Request $request, Movimentacao $movimentacao): Response
    {
        $form = $this->createForm(MovimentacaoType::class, $movimentacao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('movimentacao_edit', ['id' => $movimentacao->getId()]);
        }

        return $this->render('movimentacao/edit.html.twig', [
            'movimentacao' => $movimentacao,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="movimentacao_delete", methods="DELETE")
     */
    public function delete(Request $request, Movimentacao $movimentacao): Response
    {
        if ($this->isCsrfTokenValid('delete'.$movimentacao->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($movimentacao);
            $em->flush();
        }

        return $this->redirectToRoute('movimentacao_index');
    }
}
