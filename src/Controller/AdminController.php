<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\AdminType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin_index')]
    public function adminIndexAction()
    {
        $admins = $this->getDoctrine()->getRepository(Admin::class)->findAll();
        return $this->render('admin/index.html.twig', ['admins' => $admins]);
    }
    /**
     * @Route("/admin/detail/{id}", name="admin_detail")
     */
    public function adminDetailAction($id)
    {
        $admin = $this->getDoctrine()->getRepository(Admin::class)->find($id);
        if ($admin == null) {
            $this->addFlash('error', 'admin is not existed');
            return $this->redirectToRoute('admin_index');
        } else {
            return $this->render('admin/detail.html.twig', ['admin' => $admin]);
        }
    }
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin/delete/{id}", name="admin_delete")
     */
    public function adminDeleteAction($id)
    {
        $admin = $this->getDoctrine()->getRepository(Admin::class)->find($id);
        if ($admin == null) {
            $this->addFlash('error', 'admin is not existed');
            return $this->redirectToRoute('admin_index');
        } else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($admin);
            $manager->flush();
            $this->addFlash('success', 'Em xoá rồi nha oni-chan !!!');
            return $this->redirectToRoute('admin_index');
        }
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin/add", name="admin_add")
     */
    public function adminAddAction(Request $request)
    {
        $admin = new Admin();
        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()) {
            $image = $admin->getAvatar();
            $imgName = uniqid(); //unique id
            $imgExtension = $image->guessExtension();
            $imageName = $imgName . "." . $imgExtension;
            try {
                $image->move(
                    $this->getParameter('admin_avatar'), $imageName
                );  
              } catch (FileException $e) {
                  //throwException($e);
              }
            $admin->setAvatar($imageName);


            $manager = $this->getDoctrine()->getManager();
            $manager->persist($admin);
            $manager->flush();

            $this->addFlash('Success', "anh thêm rồi nah babyyyyyyyyyy");
            return $this->redirectToRoute('admin_index');

        }

        return $this->render("admin/add.html.twig",["form" => $form->createView()]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin/edit/{id}", name="admin_edit")
     */
    public function adminEditAction(Request $request, $id)
    {
        $admin = $this->getDoctrine()->getRepository(Admin::class)->find($id);
        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['avatar']->getData();
            if ($file != null) {  
                $image = $admin->getAvatar();
                $imgName = uniqid(); //unique id
                $imgExtension = $image->guessExtension();
                $imageName = $imgName . "." . $imgExtension;
                try {
                    $image->move(
                        $this->getParameter('admin_avatar'), $imageName
                    );  
                } catch (FileException $e) {
                    //throwException($e);
                }
                //B8: lưu tên ảnh vào database
                $admin->setAvatar($imageName);
            }      

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($admin);
            $manager->flush();

            //hiển thị thông báo và chuyển hướng website
            $this->addFlash('success', "Edit admin successfully !");
            return $this->redirectToRoute("admin_index");
        }

        return $this->render(
            "admin/edit.html.twig",
            [
                "form" => $form->createView()
            ]
        );
    
    }
}
//{oo}1
