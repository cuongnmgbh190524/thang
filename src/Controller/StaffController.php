<?php

namespace App\Controller;

use App\Entity\Staff;
use App\Form\StaffType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class StaffController extends AbstractController
{
    #[Route('/staff', name: 'staff_index')]
    public function staffIndexAction()
    {
        $staffs = $this->getDoctrine()->getRepository(Staff::class)->findAll();
        return $this->render('staff/index.html.twig', ['staffs' => $staffs]);
    }
    /**
     * @Route("/staff/detail/{id}", name="staff_detail")
     */
    public function staffDetailAction($id)
    {
        $staff = $this->getDoctrine()->getRepository(Staff::class)->find($id);
        if ($staff == null) {
            $this->addFlash('error', 'staff is not existed');
            return $this->redirectToRoute('staff_index');
        } else {
            return $this->render('staff/detail.html.twig', ['staff' => $staff]);
        }
    }
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/staff/delete/{id}", name="staff_delete")
     */
    public function staffDeleteAction($id)
    {
        $staff = $this->getDoctrine()->getRepository(Staff::class)->find($id);
        if ($staff == null) {
            $this->addFlash('error', 'staff is not existed');
            return $this->redirectToRoute('staff_index');
        } else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($staff);
            $manager->flush();
            $this->addFlash('success', 'Em xoá rồi nha oni-chan !!!');
            return $this->redirectToRoute('staff_index');
        }
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/staff/add", name="staff_add")
     */
    public function staffAddAction(Request $request)
    {
        $staff = new Staff();
        $form = $this->createForm(StaffType::class, $staff);
        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()) {


            $manager = $this->getDoctrine()->getManager();
            $manager->persist($staff);
            $manager->flush();

            $this->addFlash('Success', "anh thêm rồi nah babyyyyyyyyyy");
            return $this->redirectToRoute('staff_index');

        }

        return $this->render("staff/add.html.twig",["form" => $form->createView()]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/staff/edit/{id}", name="staff_edit")
     */
    public function staffEditAction(Request $request, $id)
    {
        $staff = $this->getDoctrine()->getRepository(Staff::class)->find($id);
        $form = $this->createForm(StaffType::class, $staff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($staff);
            $manager->flush();

            //hiển thị thông báo và chuyển hướng website
            $this->addFlash('success', "Edit staff successfully !");
            return $this->redirectToRoute("staff_index");
        }

        return $this->render(
            "staff/edit.html.twig",
            [
                "form" => $form->createView()
            ]
        );
    
    }
}
