<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Entradas;
use FOS\UserBundle\FOSUserBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        //$response = new Response('Hola guapo',Response::HTTP_OK,array('content-type' => 'text/html'));
        //return $response;
        /*$userName = $this->getUser()->getUserName();
        $entrada = new Entradas();
        $entrada->setTitle('Hola mundo');
        $entrada->setFecha(new \DateTime('now'));
        $entrada->setContenido('Hola mundo contenido');
        $entrada->setSlug('hola-mundo');
        $entrada->setAutor($userName);

        $em = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($entrada);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();


        return new Response('Saved new product with id '.$entrada->getId());*/

        $repository = $this->getDoctrine()->getRepository('AppBundle:Entradas');
        $entradas = $repository->findAll();

        return $this->render('home.html.twig', array('entradas'=> $entradas,));
    }
}
