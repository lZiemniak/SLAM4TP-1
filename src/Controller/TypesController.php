<?php

namespace App\Controller;

use App\Entity\Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\TypeFormType;
use Symfony\Component\HttpFoundation\Session\Session;
class TypesController extends AbstractController
{
    /**
     * @Route("/types", name="types")
     */
    public function index()
    {
        return $this->render('types/index.html.twig', [
            'controller_name' => 'TypesController',
        ]);
    }
    
    /**
     * @Route("/insertionType", name="insertionType")
     */
    public function creerType(Request $query) {

        // On crée un objet Article
        $type = new Type();

        $form = $this->createForm(TypeFormType::class, $type);

        $form->handleRequest($query);
          // On fait le lien Requête <-> Formulaire
          // À partir de maintenant, la variable $article contient les valeurs entrées dans le formulaire

        if ($form->isSubmitted() && $form->isValid()) {

          // On vérifie que les valeurs entrées sont correctes (Nous verrons la validation des objets en détail dans le prochain chapitre)

          // On enregistre notre objet $advert dans la base de données, par exemple

            $em = $this->getDoctrine()->getManager();
            $em->persist($type);
            $em->flush();    

            $query->getSession()->getFlashBag()->add('success','Type ajouté avec succès');

            return $this->redirectToRoute('insertionType');
        }
         return $this->render('types/CreationType.html.twig',array('form'=>$form->createView()));    
    }
    
    
    
    
    
    /**
      *
      *@Route("/bien/verif/supprimer/{id}",name="verif_del_type")
      *
      */
    public function deleteVerif(Session $session, $id){
        $type = $this->getDoctrine()->getManager()->getRepository(Type::class)->getUnType($id);
        return $this->render('types/delete.html.twig', array('type'=>$type));
    }
    
    
     /**
      *
      *@Route("/article/supprimer/{id}",name="del_art")
      *
      */
    public function deleterBien(Session $session, $id){

        $type = $this->getDoctrine()->getManager()->getRepository(Type::class)->getUnType($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($type);
        $em->flush();
        return $this->redirectToRoute('affichage_final');
    }
          
    /**
      *
      *@Route("/article/update/{id}",name="upd_type")
      *
      */    
     public function updateAction(Request $request, Session $session, $id){
         
        $type = new Type() ;
        $type = $this->getDoctrine()->getManager()->getRepository(Type::class)->getUnType($id);
       
        //$id = $session->get('login');
        $request->getSession()->getFlashBag()->add('notice', '');
       
        $form = $this->createForm(TypeFormType::class, $type);
       
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $request->getSession()->getFlashBag()->add('success', 'Article modifié avec succès.');
                return $this->redirectToRoute('upd_route',array('id'=>$id));
            }
        }
        return $this->render( 'types/update.html.twig', array('form' =>$form->createView(), 'type'=>$type));
    }
   
    /**
      *
      *@Route("/article/update/register",name="r_register")
      *
      */
    public function  register(){
        return $this->render("article/register.html.twig");
    }
    
    
}
