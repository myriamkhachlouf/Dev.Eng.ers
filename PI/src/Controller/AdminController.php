<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\EditUserType;
use App\Form\RegistrationFormType;
use App\Repository\UsersRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;


/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/listU", name="users_list")
     */
    public function listu(UsersRepository $usersRepository): Response
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $users = $usersRepository->findAll();


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('admin/listU.html.twig', [
            'users' => $users,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);

}


    /**
     * Modifier un utilisateur
     * @Route("/utilisateurs/modifier/{id}",name="modifier_utilisateurs")
     * @param Users $user
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editUsers($id,Users $user, Request $request)
    {
        $user=$this->getDoctrine()->getRepository(Users::class)->find($id);
        $form = $this->createForm(EditUserType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash('message','utilisateur modifie avec succes');
            return $this->redirectToRoute("utilisateurs");
        }
        return $this->render('users/editUser.html.twig', [
            'userForm'=>$form->createView()
        ]);
    }

    /**
     * Liste des utilisateurs du site
     *
     * @Route ("/utilisateurs",name="utilisateurs")
     * @param UsersRepository $users
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function usersList( Request $request, PaginatorInterface $paginator){

        $donnees=$this->getDoctrine()->getRepository(Users::class)->findAll();
        $users= $paginator->paginate(
          $donnees,
            $request->query->getInt('page',1),
            4
        );
        return $this->render("admin/users.html.twig",['users'=>$users,
            ]);
    }



    }
