<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;
use App\Form\FileFormType;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard',methods: ['POST','GET'])]
    public function index(Request $request,ManagerRegistry $doctrine):Response
    {
        $id = $this->getUser()->getId();
        //  echo ($id );
        $preEmail = $this->getUser()->getEmail();
        // echo ($preEmail );
        $preName = $this->getUser()->getName();
        // echo ($preName );
        $preBio = $this->getUser()->getBio();
        // echo ($preBio );
        $preLocation = $this->getUser()->getLocation();
        // echo($preLocation );
        $preDob = $this->getUser()->getDob();
        // echo ($preDob );
        $preHeader_pic =  $this->getUser()->getHeaderPic();
        // echo ($preHeader_pic );
        $preProfile =  $this->getUser()->getProfile();
        $preCreate =  $this->getUser()->getCreateAt();
        // echo $preCreate;
        // echo $preEmail;
        $data = ['header'=>$preHeader_pic,
                'create'=>  $preCreate     
        ];
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        // print_r($request);
        // $users = new User();
// ===========================================
// ===========================================
$entityManager = $doctrine->getManager();
$user =$entityManager->getRepository(User::class)->find($id);
if ($request->isMethod('POST')) {
//     // Handle form submission here
//============================================
//            Header Pic
//============================================
        // $form = $this->createForm(FileFormType::class);
        // $form->handleRequest($request);
        // $file = $form->get('header_pic')->getData();
        // echo $file;
        // die;
    $header_pic = $request->files->get('header_pic');
    if($header_pic){ 
        $header_pic->move($this->getParameter('image_dir'), $header_pic->getClientOriginalName());
    }

    // if($header_pic){
    //     $header_pic1 = uniqid().'.'.$header_pic->guessExtension();
    //     $header_pic1->move($this->$this->getParameter('image_dir'),$header_pic1);
    // }

//===============Profile Pic===================

    $profile = $request->files->get('profile');
    if($profile){
        $profile->move($this->getParameter('image_dir'), $profile->getClientOriginalName());
    }
//=============================================
//=============================================

    $name = $request->request->get('name') ? $request->request->get('name') : $preName;
    $bio = $request->request->get('bio') ? $request->request->get('bio') : $preBio;
    $email = $request->request->get('email') ? $request->request->get('email') : $preEmail;
    $location = $request->request->get('location') ? $request->request->get('location') : $preLocation;
    $dob = $request->request->get('dob') ? $request->request->get('dob') : $preDob;
    $entityManager = $doctrine->getManager();
      $user =$entityManager->getRepository(User::class)->find($id);

      if($header_pic){$user->setHeaderPic($header_pic->getClientOriginalName());}
      if($profile){$user->setProfile( $profile->getClientOriginalName());}
      $user->setName($name);
      $user->setBio($bio);
      $user->setEmail($email);
      $user->setLocation($location);
      $user->setDob($dob);
     $entityManager->persist($user);
     $entityManager->flush();
// ===========================================
// ===========================================
        
        // return $this->render('dashboard/index.html.twig', ['controller_name' => 'DashboardController']);
    }
    return $this->render('dashboard/index.html.twig', ['controller_name' => 'DashboardController','userData' => $user,'data'=>$data]);
}
}