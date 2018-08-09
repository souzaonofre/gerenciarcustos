<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Entity\Movimentacao;

class DashBoardController extends Controller
{
    /**
     * @Route("/", name="dash_board")
     */
    public function index()
    {
        $movimentacoes_le = $this->getDoctrine()
            ->getRepository(Movimentacao::class)
            ->lastedEntries();

        return $this->render('dash_board/index.html.twig', [
            'controller_name' => 'DashBoardController',
            'movimentacoes_le' => $movimentacoes_le,
        ]);
    }
}
