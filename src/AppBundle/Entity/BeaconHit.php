<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 * @ORM\Table()
 *
 * @author Yohan Giarelli <yohan@un-zero-un.fr>
 */
class BeaconHit
{


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;


    /**
     * @Groups({"path"})
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $major;

    /**
     * @Groups({"path"})
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $minor;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateHit;

    public function __construct()
    {
        $this->dateHit = new \DateTime();
    }

    public function getMajor()
    {
        return $this->major;
    }

    public function getMinor()
    {
        return $this->minor;
    }

    public function getDateHit()
    {
        return $this->dateHit;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setMajor($major)
    {
        $this->major = $major;
    }

    public function setMinor($minor)
    {
        $this->minor = $minor;
    }

    public function setDateHit(\DateTime $dateHit)
    {
        $this->dateHit = $dateHit;
    }
}
