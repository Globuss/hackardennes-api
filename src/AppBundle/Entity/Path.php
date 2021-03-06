<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 * @ORM\Table()
 *
 * @author Yohan Giarelli <yohan@un-zero-un.fr>
 */
class Path
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $id;

    /**
     * @Groups({"path"})
     * @ORM\OneToMany(targetEntity="Point", mappedBy="path")
     *
     * @var ArrayCollection<Point>
     */
    private $points;

    /**
     * @Groups({"path"})
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $name;

    /**
     * @Groups({"path"})
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string
     */
    private $city;

    /**
     * @Groups({"path"})
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string
     */
    private $theme;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection<Point>
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param ArrayCollection<Point> $points
     */
    public function setPoints($points)
    {
        $this->points = $points;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param string $theme
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
    }
    
    

}
