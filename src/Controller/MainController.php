<?php

namespace App\Controller;

use App\Entity\Exp;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



/**
 * @Route("/main")
 */
class MainController extends AbstractController
{
    /**
     * @Route("/new", name="exp_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);

            //aca iria el embebido 
            $orignalExp = new ArrayCollection();
            foreach ($user->getExp() as $exp) {
                $orignalExp->add($exp);
            }
    
            $form = $this->createForm(UserType::class, $user);
    
            $form->handleRequest($request);
    
            if ($form->isSubmitted()) {
                // get rid of the ones that the user got rid of in the interface (DOM)
                foreach ($orignalExp as $exp) {
                    // check if the exp is in the $user->getExp()
    //                dump($user->getExp()->contains($exp));
                    if ($user->getExp()->contains($exp) === false) {
                        $entityManager->remove($exp);
                    }
                }
                $entityManager->persist($user);
                
            }
            $entityManager->flush();

            return $this->redirectToRoute('user_show', array('id' => $user->getId()));

            //return $this->redirectToRoute('hecho_show', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    
    /**
     * @Route("/{id}", name="homepage")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        /**
         * @var $user User
         */
        $user = $em->getRepository(User::class)->findOneBy(['id' => $id]);
       
    

        // save the records that are in the database first to compare them with the new one the user sent
        // make sure this line comes before the $form->handleRequest();
        $orignalExp = new ArrayCollection();
        foreach ($user->getExp() as $exp) {
            $orignalExp->add($exp);
        }

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            // get rid of the ones that the user got rid of in the interface (DOM)
            foreach ($orignalExp as $exp) {
                // check if the exp is in the $user->getExp()
//                dump($user->getExp()->contains($exp));
                if ($user->getExp()->contains($exp) === false) {
                    $em->remove($exp);
                }
            }
            $em->persist($user);
            $em->flush();
        }

        // replace this example code with whatever you need
        return $this->render('main/index.html.twig', [
            'form' => $form->createView()
        ]);
    }



}
