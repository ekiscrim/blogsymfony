<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
    public function crearUserForm(Request $request)
    {
            $user = new User();
            $form = $this->createForm(UserType::class, $user);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $password = $this->get('security.password_encoder')
                    ->encodePassword($user, $user->getPass());
                $user->setPass($password);
                $user->setFecha(new \DateTime('now'));
                $user->setTipo('user');

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();


                return $this->redirectToRoute('homepage');
            }
        return $this->render('crearUsuario.html.twig',array('form' => $form->createView(),));
    }
}
