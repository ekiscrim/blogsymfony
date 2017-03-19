<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EntradaController extends Controller
{
    /**
     * @Route("/entradas", name="entradas")
     */
    public function indexAction(Request $request)
    {
        //$response = new Response('Hola guapo',Response::HTTP_OK,array('content-type' => 'text/html'));
        //return $response;
        return $this->render('entradas.html.twig');
    }
    /**
     * @Route("/entradas/crear", name="crear entrada")
     */
    public function crearEntrada(){



        return $this->render('crearEntrada.html.twig');
    }
}
