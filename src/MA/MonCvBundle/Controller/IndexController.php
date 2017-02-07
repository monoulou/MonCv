<?php

namespace MA\MonCvBundle\Controller;

use MA\MonCvBundle\Entity\Image;
use MA\MonCvBundle\Entity\Contact;
use MA\MonCvBundle\Entity\Formation;
use MA\MonCvBundle\Form\ContactType;
use MA\MonCvBundle\Entity\Experiences;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller {

    public function indexAction() {

        //Renvoi vers la page index.
        return $this->render('MAMonCvBundle:Index:index.html.twig');

    }

    public function experiencesAction() {
      //Acces au service Doctrine.
       $doctrine = $this->container->get('doctrine');
       $em = $doctrine->getManager();

       //Acces au Repository de l'entitée.
       $experiencesRepository = $em->getRepository('MAMonCvBundle:Experiences');

       //Recupération de toutes les données liéeq à l'entitée
       $experiencesList = $experiencesRepository->findAll();
       //dump($experiencesList);die();



        //Renvoi vers page experiences avec tableau contenant resultat de la requete.
        return $this->render('MAMonCvBundle:Index:experiences.html.twig', array
                  ('experiencesList'=> $experiencesList));

    }

    public function detailAction($idExperience) {
        //Accès au service Doctrine
        $doctrine = $this->container->get('doctrine');
        $em = $doctrine->getManager();

        //Acces au repository de l'entite
        $experienceRepository = $em->getRepository('MAMonCvBundle:Experiences');
        //$imageRepository = $em->getRepository('MAMonCvBundle:Image');

        //Recupération du resultat de la requete en fonction de l'argument âssé en paramètre.
        $detailExperience = $experienceRepository->findOneByid($idExperience);
        //$image = $imageRepository->findOneById($idExperience);
        //dump($detailExperience);Die();

        //Renvoi vers page detail avec tableau contenant le resultat.
        return $this->render('MAMonCvBundle:Index:detail.html.twig', array(
                              'detailExperience' => $detailExperience
                            ));
    }

    public function formationAction() {
      //Acces au service Doctrine
      $doctrine = $this->container->get('doctrine');
      $em = $doctrine->getManager();
      //Acces au repository de l'entitee
      $formationRepository = $em->getRepository('MAMonCvBundle:Formation');

      //Recuperartion de l'ensemble des données liees à l'entitée.
      $formationList = $formationRepository->findAll();
      //dump($formationList);die();
      return $this->render('MAMonCvBundle:Index:formation.html.twig', array(
                            'formationList' => $formationList
                            ));
    }

    public function contactAction(Request $request) {

      //Instanciation d'un nouvel objet contact
      $contact = new Contact();

      //Acces au service doctrine et à l'entityManager.
      $doctrine = $this->container->get('doctrine');
      $em = $doctrine->getManager();

      //Création du formulaire en ligne de commande et personnalisation.
      $form = $this->container->get('form.factory')->create(new ContactType(), $contact);

      //Vérification des données saisies et transmises via le formulaire.
      if($request->isMethod('POST')) {

        //Hydration du formulaire.
        $form->handleRequest($request);

            if($form->isValid()) {

              $data = $form->getData();

                //dump($data->getEmail());die();

              //Instanciation swift_Mailer
              $message = \Swift_Message::newInstance()
                ->setContentType('text/html')
                ->setSubject($data->getObjet())
                ->setFrom($data->getEmail())
                ->setTo($this->container->getParameter('mon_cv.email.contact_email'))
                ->setBody($data->getMessage());
                //dump($message);die();
              $this->get('mailer')->send($message);

              //Message flash si message bien envoyé.
              $this->addFlash('notice', 'Votre demande a bien été envoyé. merci!');

              //Persistance en bd.
              $em->persist($contact);
              $em->flush();


              //redirection vers page d'accueil apres envoi du formulaire.
              return $this->redirectToRoute('ma_mon_cv_homepage');

          }

      }

      //
      return $this->render('MAMonCvBundle:Index:contact.html.twig', array(
                            'form' => $form->createView(),
                            ));
    }
}
