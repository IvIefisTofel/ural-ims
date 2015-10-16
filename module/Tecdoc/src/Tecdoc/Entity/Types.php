<?php

namespace Tecdoc\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Types
 *
 * @ORM\Table(name="lit_types")
 * @ORM\Entity
 */
class Types
{
    /**
     * @var integer
     *
     * @ORM\Column(name="typ_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $typId;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_mod_id", type="integer", nullable=true)
     */
    private $modId;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_mmt_cds", type="text", nullable=true)
     */
    private $mmtCds;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_cds", type="text", nullable=true)
     */
    private $cds;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_pcon_start", type="integer", nullable=true)
     */
    private $pconStart;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_pcon_end", type="integer", nullable=true)
     */
    private $pconEnd;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_kw_from", type="integer", nullable=true)
     */
    private $kwFrom;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_hp_from", type="integer", nullable=true)
     */
    private $hpFrom;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_ccm", type="integer", nullable=true)
     */
    private $ccm;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_kv_body_des", type="text", nullable=true)
     */
    private $bodyDes;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_kv_fuel_des", type="text", nullable=true)
     */
    private $fuelDes;

    /**
     * @var integer
     *
     * @ORM\Column(name="fuel_id", type="integer", nullable=true)
     */
    private $fuelId;

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
     * Get modId
     *
     * @return integer
     */
    public function getModId()
    {
        return $this->modId;
    }

    /**
     * Get mmtCds
     *
     * @return string
     */
    public function getMmtCds()
    {
        return $this->mmtCds;
    }

    /**
     * Get cds
     *
     * @return string
     */
    public function getCds()
    {
        return $this->cds;
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

    /**
     * Get kwFrom
     *
     * @return integer
     */
    public function getKwFrom()
    {
        return $this->kwFrom;
    }

    /**
     * Get hpFrom
     *
     * @return integer
     */
    public function getHpFrom()
    {
        return $this->hpFrom;
    }

    /**
     * Get ccm
     *
     * @return integer
     */
    public function getCcm()
    {
        return $this->ccm;
    }

    /**
     * Get bodyDes
     *
     * @return string
     */
    public function getBodyDes()
    {
        return $this->bodyDes;
    }

    /**
     * Get fuelDes
     *
     * @return string
     */
    public function getFuelDes()
    {
        return $this->fuelDes;
    }

    /**
     * Get fuelId
     *
     * @return integer
     */
    public function getFuelId()
    {
        return $this->fuelId;
    }
}
