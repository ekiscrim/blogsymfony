<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Entradas;
use FOS\UserBundle\FOSUserBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        $repository = $this->getDoctrine()->getRepository('AppBundle:Entradas');
        $entradas = $repository->findBy([],['fecha' =>'DESC']);
        return $this->render('entradas.html.twig',array('entradas'=>$entradas,));
    }
    /**
     * @Route("/entradas/crear", name="crear_entrada")
     */
    public function crearEntrada(Request $request){
        //comprobar que esta logueado
        if($this->isGranted('ROLE_SUPER_ADMIN')){
            $entradas = new Entradas();
            $entradas->setAutor($this->getUser()->getUserName());

            $form = $this->createFormBuilder($entradas)
                ->add('title', TextType::class)
                ->add('fecha', DateType::class)
                ->add('contenido', TextType::class)
                ->add('slug', TextType::class)
                ->add('autor', TextType::class)
                ->add('save', SubmitType::class, array('label' => 'Crear entrada'))
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // $form->getData() holds the submitted values
                $entradas = $form->getData();

                // ... perform some action, such as saving the task to the database
                // for example, if Task is a Doctrine entity, save it!
                $em = $this->getDoctrine()->getManager();
                $em->persist($entradas);
                $em->flush();

                $this->addFlash(
                    'notice',
                    'Entrada insertada!'
                );

                return $this->redirectToRoute('entradas');
            }

            return $this->render('crearEntrada.html.twig', array(
                'form' => $form->createView(),
            ));
        }else{
            return $this->redirectToRoute('homepage');
        }

    }
}
