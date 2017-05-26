<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GrocList
 *
 * @ORM\Table(name="groc_list")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GrocListRepository")
 */
class GrocList
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
     * @var \DateTime
     *
     * @ORM\Column(name="weekDate", type="date")
     */
    private $weekDate;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set weekDate
     *
     * @param \DateTime $weekDate
     *
     * @return GrocList
     */
    public function setWeekDate($weekDate)
    {
        $this->weekDate = $weekDate;

        return $this;
    }

    /**
     * Get weekDate
     *
     * @return \DateTime
     */
    public function getWeekDate()
    {
        return $this->weekDate;
    }
}

