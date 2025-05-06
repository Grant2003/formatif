<?php

namespace App\Controller;

use App\Entity\{Vehicule, Intervention, Repartition};
use App\Form\{VehiculeTypeForm, InterventionTypeForm,RepartitionTypeForm};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Response, Request};
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;


final class SPIController extends AbstractController
{
    #[Route('/', name: 'menu')]
    public function index(): Response
    {
        return $this->render('menu.html.twig');
    }

    #[Route('/creationVehicule', name: 'creationVehicule')]
    public function creationVehicule(ManagerRegistry $doctrine, Request $req ): Response
    {
        $vehicule = new Vehicule();

        $formVeh = $this->createForm(VehiculeTypeForm::class, $vehicule);
   
        $formVeh->handleRequest($req);
        if ($formVeh->isSubmitted()   )
        {
            //2- Nous somme bien en mode soumission
            // on valide les info du post
            if ($formVeh->isValid())
            {
                //3- Le fom soumis est valide on sauvegarde $entreCandidat en BD
                $em  = $doctrine->getManager();
                $em->persist($vehicule);
                $em->flush();

                $this->addFlash('succes', 'Vehicule creer');

                return $this->redirectToRoute('menu');
            }
            else
            {
                $this->addFlash('erreur', 'Info invalide');
            }
        }
        return $this->render('vehiculeCreation.html.twig', ['formulaire' => $formVeh] );


    }

    #[Route('/creationIntervention', name: 'creationIntervention')]
    public function creationIntervention(ManagerRegistry $doctrine, Request $req): Response
    {

        $intervention = new Intervention();

        $formInt = $this->createForm(InterventionTypeForm::class, $intervention);
   
        $formInt->handleRequest($req);
        if ($formInt->isSubmitted()   )
        {
            //2- Nous somme bien en mode soumission
            // on valide les info du post
            if ($formInt->isValid())
            {
                //3- Le fom soumis est valide on sauvegarde $entreCandidat en BD
                $em  = $doctrine->getManager();
                $em->persist($intervention);
                $em->flush();

                $this->addFlash('succes', 'Intervention creer');

                return $this->redirectToRoute('menu');
            }
            else
            {
                $this->addFlash('erreur', 'Info invalide');
            }
        }
        return $this->render('interventionCreation.html.twig', ['formulaire' => $formInt] );
    }

    #[Route('/repartition', name: 'repartition')]
    public function repartition(ManagerRegistry $doctrine, Request $req): Response
    {

        $rep = new Repartition();

        $formRep = $this->createForm(RepartitionTypeForm::class, $rep);
   
        $formRep->handleRequest($req);
        if ($formRep->isSubmitted()   )
        {
            //2- Nous somme bien en mode soumission
            // on valide les info du post
            if ($formRep->isValid())
            {
                //3- Le fom soumis est valide on sauvegarde $entreCandidat en BD
                $em  = $doctrine->getManager();
                $em->persist($rep);
                $em->flush();

                $this->addFlash('succes', 'Repartition creer');

                return $this->redirectToRoute('menu');
            }
            else
            {
                $this->addFlash('erreur', 'Info invalide');
            }
        }
        return $this->render('repartition.html.twig', ['formulaire' => $formRep] );
    }

    #[Route('/vehicules', name: 'vehicules')]
    public function vehicules(ManagerRegistry $doctrine): Response
    {
        $vehicules = $doctrine->getManager()->getRepository(Vehicule::class)->findAll();

        return $this->render('vehicules.html.twig', ['vehicules' => $vehicules]);
    }

    #[Route('/interventions', name: 'interventions')]
    public function interventions(ManagerRegistry $doctrine): Response
    {
        $interventions = $doctrine->getManager()->getRepository(Intervention::class)->findAll();
        return $this->render('interventions.html.twig', ['interventions' => $interventions]);
    }



}
