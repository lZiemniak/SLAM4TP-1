<?php

namespace App\Controller;
use App\Entity\Bien;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\BienType;
use Symfony\Component\HttpFoundation\Session\Session;

class BiensController extends AbstractController
{
    /**
     * @Route("/biens", name="biens")
     */
    public function index()
    {
        return $this->render('biens/index.html.twig', [
            'controller_name' => 'BiensController',
        ]);
    }
    
    /**
     * @Route("/insertionBien", name="InsertionBien")
     */
    public function creerBien(Request $query) {

        // On crée un objet Article
        $bien = new Bien();

        $form = $this->createForm(BienType::class, $bien);

        $form->handleRequest($query);
          // On fait le lien Requête <-> Formulaire
          // À partir de maintenant, la variable $article contient les valeurs entrées dans le formulaire

        if ($form->isSubmitted() && $form->isValid()) {

          // On vérifie que les valeurs entrées sont correctes (Nous verrons la validation des objets en détail dans le prochain chapitre)

          // On enregistre notre objet $advert dans la base de données, par exemple

            $em = $this->getDoctrine()->getManager();
            $em->persist($bien);
            $em->flush();    

            $query->getSession()->getFlashBag()->add('success','Bien ajouté avec succès');

            return $this->redirectToRoute('InsertionBien');
        }
         return $this->render('biens/CreationBien.html.twig',array('form'=>$form->createView()));    
    }

     
    /**
      *
      *@Route("/bien/verif/supprimer/{id}",name="verif_del_bien")
      *
      */
    public function deleteVerif(Session $session, $id){
        $bien = $this->getDoctrine()->getManager()->getRepository(Bien::class)->getUnBien($id);
        return $this->render('bien/delete.html.twig', array('bien'=>$bien));
    }
    
    
     /**
      *
      *@Route("/article/supprimer/{id}",name="del_bien")
      *
      */
    public function deleterBien(Session $session, $id){

        $bien = $this->getDoctrine()->getManager()->getRepository(Bien::class)->getUnBien($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($bien);
        $em->flush();
        return $this->redirectToRoute('affichage_final');
    }
          
    /**
      *
      *@Route("/bien/update/{id}",name="upd_bien")
      *
      */    
     public function updateAction(Request $request, Session $session, $id){
         
        $bien = new Bien() ;
        $bien = $this->getDoctrine()->getManager()->getRepository(Bien::class)->getUnBien($id);
       
        //$id = $session->get('login');
        $request->getSession()->getFlashBag()->add('notice', '');
       
        $form = $this->createForm(BienType::class, $bien);
       
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $request->getSession()->getFlashBag()->add('success', 'Article modifié avec succès.');
                return $this->redirectToRoute('upd_bien',array('id'=>$id));
            }
        }
        return $this->render( 'biens/updateBien.html.twig', array('form' =>$form->createView(), 'bien'=>$bien));
    }
   
    /**
      *
      *@Route("/article/update/register",name="r_register")
      *
      */
    public function  register(){
        return $this->render("article/register.html.twig");
    }

    /**
     * @Route("/Afficher_bien", name="Afficher_bien")
     */
    public function AfficherBien(){
        $em = $this->getDoctrine()->getManager();
 
        $unBien = $em->getRepository(Bien::class)->findAll();
        
        return $this->render('biens/AfficherBiens.html.twig', array('bien' => $unBien));
        
    }
}
