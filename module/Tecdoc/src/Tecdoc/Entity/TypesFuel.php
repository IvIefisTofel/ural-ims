<?php

namespace Tecdoc\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypesFuel
 *
 * @ORM\Table(name="lit_types_fuel")
 * @ORM\Entity
 */
class TypesFuel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="typ_kv_fuel_des_id", type="integer", nullable=true)
     * @ORM\Id
     */
    private $desId;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_kv_fuel_des", type="text", nullable=true)
     */
    private $desText;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_mod_id", type="integer", nullable=true)
     */
    private $modId;

    /**
     * Get desId
     *
     * @return integer
     */
    public function getDesId()
    {
        return $this->desId;
    }

    /**
     * Get desText
     *
     * @return string
     */
    public function getDesText()
    {
        return $this->desText;
    }

    /**
     * Get modId
     *
     * @return integer
     */
    public function getModId()
    {
        return $this->modId;
    }
}
