<?php

namespace WebGrocBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GrocList
 *
 * @ORM\Table(name="groc_list")
 * @ORM\Entity(repositoryClass="WebGrocBundle\Repository\GrocListRepository")
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
     * @ORM\Column(name="week_date", type="date")
     */
    private $weekDate;

    /**
     * @ORM\ManyToMany(targetEntity="GrocItem", cascade={"all"})
     * @ORM\JoinTable(
     *     joinColumns={@ORM\JoinColumn(name="list_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="item_id", referencedColumnName="id")}
     * )
     * @var Collection $items
     */
    protected $items;


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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    /**
     * Add item
     *
     * @param GrocItem $item
     *
     * @return GrocList
     */
    public function addItem(GrocItem $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Remove item
     *
     * @param GrocItem $item
     */
    public function removeItem(GrocItem $item)
    {
        $this->items->removeElement($item);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItems()
    {
        return $this->items;
    }
}
