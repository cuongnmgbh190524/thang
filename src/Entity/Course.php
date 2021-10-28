<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CourseRepository::class)
 */
class Course
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $display;

    /**
     * @ORM\ManyToMany(targetEntity=Student::class, inversedBy="courses")
     */
    private $view;

    public function __construct()
    {
        $this->view = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDisplay(): ?string
    {
        return $this->display;
    }

    public function setDisplay(string $display): self
    {
        $this->display = $display;

        return $this;
    }

    /**
     * @return Collection|Student[]
     */
    public function getView(): Collection
    {
        return $this->view;
    }

    public function addView(Student $view): self
    {
        if (!$this->view->contains($view)) {
            $this->view[] = $view;
        }

        return $this;
    }

    public function removeView(Student $view): self
    {
        $this->view->removeElement($view);

        return $this;
    }
}
