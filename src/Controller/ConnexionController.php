<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Admin;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\AdminConnexionType;
use App\Form\CreeAdminType;


class ConnexionController extends AbstractController
{
    /**
     * @Route("/", name="connexion")
     */
    public function index()
    {
        return $this->redirectToRoute('AdminConnexion'); 
        
    }
    
    /**
     * @Route("/connexionAdmin", name="AdminConnexion")
     * @param Request $query
     * @return type
     */
    public function creerFormConnexionAction(Request $query) {
       
        // On crée un objet Comptable
        $adm = new Admin();

        $form = $this->createForm(\App\Form\AdminConnexionType::class, $adm);

        //$request = Request::createFromGlobals();

        $form->handleRequest($query);
          // On fait le lien Requête <-> Formulaire
          // À partir de maintenant, la variable $user contient les valeurs entrées dans le formulaire par le candidat

        if ($form->isSubmitted() && $form->isValid()) {

          // On vérifie que les valeurs entrées sont correctes (Nous verrons la validation des objets en détail dans le prochain chapitre)

            // On enregistre notre objet $advert dans la base de données, par exemple
                $em = $this->getDoctrine()->getManager();
                $data = $form->getData();      

                $login = $form['login']->getData();
                $mdp = $form['mdp']->getData();

                $result = $em->getRepository(Admin::class)->seConnecter($login,$mdp); //on envoie les données reçus pour tester
                
                if(!empty($result)){ //on teste si le user existe ou pas !!
                    //on crée une session
                    $session = new Session();
                    $login = $session->set('login', $login);
                    
                
                    return $this->redirectToRoute('AccueilAdmin');            
                }
                
        }
        return $this->render('connexion/ConnexionAdmin.html.twig',array('form'=>$form->createView(),));
    }
    
    /**
     * @Route("/AccueilAdmin", name="AccueilAdmin")
     */
    public function accueilAdmin(){
        
        return $this->render("accueil/AccueilAdmin.html.twig");
    }
    
    /**
     * @Route("/inscriptionAdmin", name="InscriptionAdmin")
     */
    public function creeAdmin(Request $query){
        
        $admin = new Admin();
        $form = $this->createForm(CreeAdminType::class, $admin);
        
        $form->handleRequest($query);
        
        if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $data = $form->getData();      
                
                $login = $form['login']->getData();
                $mdp = $form['mdp']->getData();
                $nom = $form['nom']->getData();
                $prenom = $form['prenom']->getData();
                
                $admin->setLogin($login);
                $admin->setMdp($mdp);
                $admin->setNom($nom);
                $admin->setPrenom($prenom);
                
                $em->persist($admin);
                $em->flush();
                return $this->redirectToRoute('AdminConnexion');
        }
        
        
        return $this->render('connexion/creationAdmin.html.twig',array('form'=>$form->createView(),));
        
    }

}
