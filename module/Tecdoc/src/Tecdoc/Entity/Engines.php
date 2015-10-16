<?php

namespace Tecdoc\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Engines
 *
 * @ORM\Table(name="lit_types_engine")
 * @ORM\Entity
 */
class Engines
{
    /**
     * @var integer
     *
     * @ORM\Column(name="typ_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $typId;

    /**
     * @var string
     *
     * @ORM\Column(name="eng_code", type="string", length=180, precision=0, scale=0, nullable=true, unique=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="eng_description", type="string", length=90, precision=0, scale=0, nullable=true, unique=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="eng_pcon_start", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $pconStart;

    /**
     * @var integer
     *
     * @ORM\Column(name="eng_pcon_end", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $pconEnd;


    /**
     * Get typId
     *
     * @return integer
     */
    public function getTypId()
    {
        return $this->typId;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
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
     * Get pconStart
     *
     * @return integer
     */
    public function getPconStart()
    {
        if ($this->pconStart !== null)
            return substr($this->pconStart,4).".".substr($this->pconStart,0,4);
        else
            return null;
    }

    /**
     * Get pconEnd
     *
     * @return integer
     */
    public function getPconEnd()
    {
        if ($this->pconEnd !== null)
            return substr($this->pconEnd,4).".".substr($this->pconEnd,0,4);
        else
            return null;
    }
}