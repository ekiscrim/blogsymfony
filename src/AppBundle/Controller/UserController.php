<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @Route("/usuarios", name="usuarios")
     */
    public function indexAction(Request $request)
    {
        //$response = new Response('Hola guapo',Response::HTTP_OK,array('content-type' => 'text/html'));
        //return $response;
        return $this->render('entradas.html.twig');
    }
    /**
     * @Route("/usuarios/crear", name="crear usuario")
     */
    public function crearUser(){
        $user = new User();
        $user->setNick('ekiscrim');
        $user->setPass('123');
        $user->setEmail('xcstudiosonly@gmail.com');
        $user->setFecha(new \DateTime('now'));
        $user->setTipo('admin');

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($user);
        $em->flush();


        return new Response('Hecho');
    }
}
