<?php

namespace App\Controller;

use App\Entity\Course;
use App\Form\CourseType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Type;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CourseController extends AbstractController
{
    #[Route('/course', name: 'course_index')]
    public function courseIndexAction()
    {
        $courses = $this->getDoctrine()->getRepository(Course::class)->findAll();
        return $this->render('course/index.html.twig', ['courses' => $courses]);
    }
    /**
     * @Route("/course/detail/{id}", name="course_detail")
     */
    public function courseDetailAction($id)
    {
        $course = $this->getDoctrine()->getRepository(Course::class)->find($id);
        if ($course == null) {
            $this->addFlash('error', 'course is not existed');
            return $this->redirectToRoute('course_index');
        } else {
            return $this->render('course/detail.html.twig', ['course' => $course]);
        }
    }
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/course/delete/{id}", name="course_delete")
     */
    public function courseDeleteAction($id)
    {
        $course = $this->getDoctrine()->getRepository(Course::class)->find($id);
        if ($course == null) {
            $this->addFlash('error', 'course is not existed');
            return $this->redirectToRoute('course_index');
        } else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($course);
            $manager->flush();
            $this->addFlash('success', 'Em xoá rồi nha oni-chan !!!');
            return $this->redirectToRoute('course_index');
        }
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/course/add", name="course_add")
     */
    public function courseAddAction(Request $request)
    {
        $course = new Course();
        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()) {


            $manager = $this->getDoctrine()->getManager();
            $manager->persist($course);
            $manager->flush();

            $this->addFlash('Success', "anh thêm rồi nah babyyyyyyyyyy");
            return $this->redirectToRoute('course_index');

        }

        return $this->render("course/add.html.twig",["form" => $form->createView()]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/course/edit/{id}", name="course_edit")
     */
    public function courseEditAction(Request $request, $id)
    {
        $course = $this->getDoctrine()->getRepository(course::class)->find($id);
        $form = $this->createForm(courseType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($course);
            $manager->flush();

            //hiển thị thông báo và chuyển hướng website
            $this->addFlash('success', "Edit course successfully !");
            return $this->redirectToRoute("course_index");
        }

        return $this->render(
            "course/edit.html.twig",
            [
                "form" => $form->createView()
            ]
        );
    
    }
}
