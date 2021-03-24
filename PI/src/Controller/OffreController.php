<?php

namespace App\Controller;
use App\Repository\EntrepriseRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity\Offre;
use App\Entity\Entreprise;
use App\Form\OffreType;
use App\Repository\OffreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\FileType;

/**
 * @Route("/offre")
 */
class OffreController extends Controller
{
    /**
     * @Route("/", name="offre_index", methods={"GET","POST"})
     * @param OffreRepository $offreRepository
     * @param EntrepriseRepository $EnreRepository
     * @param Request $request
     * @return Response
     */
    public function index(OffreRepository $offreRepository, Request $request,EntrepriseRepository $EnreRepository): Response
    {   $entreprise = $EnreRepository->findAll();
        $offre = $offreRepository->findAll();
        if($request->isMethod("POST"))
        {
            $value=$request->get('Recherche');
            $offre = $this->getDoctrine()->getRepository(Offre::class)->Recherche($value);

            return $this->render('offre/recherche.html.twig', [
                'offres' => $offre,
                'entreprises' =>$entreprise,
            ]);

        }
        $alloffres =$offreRepository->findAll();
        $offre = $this->get('knp_paginator')->paginate(
        // Doctrine Query, not results
            $alloffres,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            4
        );
        return $this->render('offre/index.html.twig', [
            'offres' => $offre,
            'entreprises' =>$entreprise,

        ]);
    }
    /**
     * @Route("/aman", name="aman", methods={"GET","POST"})
     * @param OffreRepository $offreRepository
     * @param EntrepriseRepository $EnreRepository
     * @param Request $request
     * @return Response
     */
    public function tri (OffreRepository $offreRepository, Request $request,EntrepriseRepository $EnreRepository): Response
    {   $entreprise = $EnreRepository->findAll();
            $alloffres =$offreRepository->listOrderByEntreprise();
        if($request->isMethod("POST"))
        {
            $value=$request->get('Recherche');
            $offre = $this->getDoctrine()->getRepository(Offre::class)->Recherche($value);

            return $this->render('offre/recherche.html.twig', [
                'offres' => $offre,
                'entreprises' =>$entreprise,
            ]);

        }
            $offre = $this->get('knp_paginator')->paginate(
            // Doctrine Query, not results
                $alloffres,
                // Define the page parameter
                $request->query->getInt('page', 1),
                // Items per page
                4
            );
            return $this->render('offre/index.html.twig', [
                'offres' => $offre,
                'entreprises' =>$entreprise,
            ]);
    }

    /**
     * @Route("/new", name="offre_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $offre = new Offre();
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $offre->setImage($fileName);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offre);
            $entityManager->flush();
            return $this->redirectToRoute('offre_index');
        }

        return $this->render('offre/new.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="offre_show", methods={"GET"})
     */
    public function show(Offre $offre): Response
    {
        return $this->render('offre/show.html.twig', [
            'offre' => $offre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="offre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Offre $offre): Response
    {
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $offre->setImage($fileName);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offre);
            $entityManager->flush();
            return $this->redirectToRoute('offre_index');
        }

        return $this->render('offre/edit.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="offre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Offre $offre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($offre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('offre_index');
    }

    /**
     * @Route("/stat", name="stat")
     * @param Request $request
     * @param OffreRepository $offreRepository
     * @param EntrepriseRepository $EnreRepository
     * @return Response
     */
    
    public function list1(Request $request,OffreRepository $offreRepository,EntrepriseRepository $EnreRepository)
    {
        $count=[];
        $nom=[];
        $entreprise = $EnreRepository->findAll();
        $offre = $offreRepository->findAll();
        foreach($entreprise as $end)
        {
            $i=0;
            foreach($offre as $exp)
            {
                if($exp->getEntreprise()==$end){
                    $i=$i+1;

                }

            }

                $count[]=$i;

        }
        foreach($entreprise as $end) {
            $nom[]=$end->getNom();
        }

        return   $this->render('rtl.html.twig', ['offre' => $offre,'nom'=>json_encode($nom),'count'=>json_encode($count)]);




    }
}
