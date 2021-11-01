<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'student_index')]
    public function studentIndexAction()
    {
        $year= date("Y-m-d ");
        $a = explode("-",$year);
        $b = $a[0];
        $students = $this->getDoctrine()->getRepository(Student::class)->findAll();
        return $this->render('student/index.html.twig', ['students' => $students,'year'=> $b]);
    }
    /**
     * @Route("/student/detail/{id}", name="student_detail")
     */
    public function studentDetailAction($id)
    {
        $year= date("Y-m-d ");
        $a = explode("-",$year);
        $b = $a[0];
         
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        if ($student == null) {
            $this->addFlash('error', 'student is not existed');
            return $this->redirectToRoute('student_index');
        } else {
            return $this->render('student/detail.html.twig', ['student' => $student,'year'=> $b ]);
        }
    }
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/student/delete/{id}", name="student_delete")
     */
    public function studentDeleteAction($id)
    {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        if ($student == null) {
            $this->addFlash('error', 'student is not existed');
            return $this->redirectToRoute('student_index');
        } else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($student);
            $manager->flush();
            $this->addFlash('success', 'Em xoá rồi nha oni-chan !!!');
            return $this->redirectToRoute('student_index');
        }
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/student/add", name="student_add")
     */
    public function studentAddAction(Request $request)
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()) {


            $manager = $this->getDoctrine()->getManager();
            $manager->persist($student);
            $manager->flush();

            $this->addFlash('Success', "anh thêm rồi nah babyyyyyyyyyy");
            return $this->redirectToRoute('student_index');

        }

        return $this->render("student/add.html.twig",["form" => $form->createView()]);
    }

    /**
     * @IsGranted("ROLE_STUDENT")
     * @Route("/student/edit/{id}", name="student_edit")
     */
    public function studentEditAction(Request $request, $id)
    {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($student);
            $manager->flush();

            //hiển thị thông báo và chuyển hướng website
            $this->addFlash('success', "Edit student successfully !");
            return $this->redirectToRoute("student_index");
        }

        return $this->render(
            "student/edit.html.twig",
            [
                "form" => $form->createView()
            ]
        );
    
    }
}
