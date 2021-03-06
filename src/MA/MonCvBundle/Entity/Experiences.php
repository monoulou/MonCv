<?php

namespace MA\MonCvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Experiences
 *
 * @ORM\Table(name="experiences")
 * @ORM\Entity(repositoryClass="MA\MonCvBundle\Repository\ExperiencesRepository")
 */
class Experiences
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="date_experiences", type="string", length=255)
     */
    private $dateExperiences;

    /**
     * @var string
     *
     * @ORM\Column(name="societe", type="string", length=255)
     */
    private $societe;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=255)
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;




    /**
    *@ORM\OneToOne(targetEntity="MA\MonCvBundle\Entity\Image", cascade={"persist"})
    */

    private $image;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateExperiences
     *
     * @param string $dateExperiences
     * @return Experiences
     */
    public function setDateExperiences($dateExperiences)
    {
        $this->dateExperiences = $dateExperiences;

        return $this;
    }

    /**
     * Get dateExperiences
     *
     * @return string
     */
    public function getDateExperiences()
    {
        return $this->dateExperiences;
    }

    /**
     * Set societe
     *
     * @param string $societe
     * @return Experiences
     */
    public function setSociete($societe)
    {
        $this->societe = $societe;

        return $this;
    }

    /**
     * Get societe
     *
     * @return string
     */
    public function getSociete()
    {
        return $this->societe;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Experiences
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set image
     *
     * @param \MA\MonCvBundle\Entity\Image $image
     * @return Experiences
     */
    public function setImage(\MA\MonCvBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \MA\MonCvBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     * @return Experiences
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string 
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     * @return Experiences
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string 
     */
    public function getLieu()
    {
        return $this->lieu;
    }
}
