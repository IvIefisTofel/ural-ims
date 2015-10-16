<?php

namespace Tecdoc\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypesFullInfo
 *
 * @ORM\Table(name="lit_types_full_info")
 * @ORM\Entity
 */
class TypesFullInfo
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
     * @ORM\Column(name="typ_cds", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $cds;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_mmt_cds", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $mmtCds;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_mod_id", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $modId;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_sort", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $sort;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_pcon_start", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $pconStart;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_pcon_end", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $pconEnd;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_kw_from", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $kwFrom;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_kw_upto", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $kwUpto;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_hp_from", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $hpFrom;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_hp_upto", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $hpUpto;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_ccm", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $ccm;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_cylinders", type="smallint", precision=0, scale=0, nullable=true, unique=false)
     */
    private $cylinders;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_doors", type="smallint", precision=0, scale=0, nullable=true, unique=false)
     */
    private $doors;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_tank", type="smallint", precision=0, scale=0, nullable=true, unique=false)
     */
    private $tank;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_kv_voltage_des", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $kvVoltageDes;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_kv_abs_des", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $kvAbsDes;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_kv_asr_des", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $kvAsrDes;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_kv_engine_des", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $kvEngineDes;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_kv_brake_type_des", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $kvBrakeTypeDes;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_kv_brake_syst_des", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $kvBrakeSystDes;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_kv_fuel_des", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $kvFuelDes;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_kv_catalyst_des", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $kvCatalystDes;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_kv_body_des", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $kvBodyDes;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_kv_steering_des_id", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $kvSteeringDesId;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_kv_steering_side_des_id", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $kvSteeringSideDesId;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_max_weight", type="decimal", precision=5, scale=2, nullable=true, unique=false)
     */
    private $maxWeight;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_kv_model_des", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $kvModelDes;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_kv_axle_des", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $kvAxleDes;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_ccm_tax", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $ccmTax;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_litres", type="decimal", precision=6, scale=3, nullable=true, unique=false)
     */
    private $litres;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_kv_drive_des", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $kvDriveDes;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_kv_trans_des", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $kvTransDes;

    /**
     * @var string
     *
     * @ORM\Column(name="typ_kv_fuel_supply_des", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $kvFuelSupplyDes;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_valves", type="smallint", precision=0, scale=0, nullable=true, unique=false)
     */
    private $valves;

    /**
     * @var integer
     *
     * @ORM\Column(name="typ_rt_exists", type="smallint", precision=0, scale=0, nullable=true, unique=false)
     */
    private $rtExists;


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
     * Get cds
     *
     * @return string
     */
    public function getCds()
    {
        return $this->cds;
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
     * Get modId
     *
     * @return integer
     */
    public function getModId()
    {
        return $this->modId;
    }

    /**
     * Get sort
     *
     * @return integer
     */
    public function getSort()
    {
        return $this->sort;
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
     * Get kwUpto
     *
     * @return integer
     */
    public function getKwUpto()
    {
        return $this->kwUpto;
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
     * Get hpUpto
     *
     * @return integer
     */
    public function getHpUpto()
    {
        return $this->hpUpto;
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
     * Get cylinders
     *
     * @return integer
     */
    public function getCylinders()
    {
        return $this->cylinders;
    }

    /**
     * Get doors
     *
     * @return integer
     */
    public function getDoors()
    {
        return $this->doors;
    }

    /**
     * Get tank
     *
     * @return integer
     */
    public function getTank()
    {
        return $this->tank;
    }

    /**
     * Get kvVoltageDes
     *
     * @return string
     */
    public function getKvVoltageDes()
    {
        return $this->kvVoltageDes;
    }

    /**
     * Get kvAbsDes
     *
     * @return string
     */
    public function getKvAbsDes()
    {
        return $this->kvAbsDes;
    }

    /**
     * Get kvAsrDes
     *
     * @return string
     */
    public function getKvAsrDes()
    {
        return $this->kvAsrDes;
    }

    /**
     * Get kvEngineDes
     *
     * @return string
     */
    public function getKvEngineDes()
    {
        return $this->kvEngineDes;
    }

    /**
     * Get kvBrakeTypeDes
     *
     * @return string
     */
    public function getKvBrakeTypeDes()
    {
        return $this->kvBrakeTypeDes;
    }

    /**
     * Get kvBrakeSystDes
     *
     * @return string
     */
    public function getKvBrakeSystDes()
    {
        return $this->kvBrakeSystDes;
    }

    /**
     * Get kvFuelDes
     *
     * @return string
     */
    public function getKvFuelDes()
    {
        return $this->kvFuelDes;
    }

    /**
     * Get kvCatalystDes
     *
     * @return string
     */
    public function getKvCatalystDes()
    {
        return $this->kvCatalystDes;
    }

    /**
     * Get kvBodyDes
     *
     * @return string
     */
    public function getKvBodyDes()
    {
        return $this->kvBodyDes;
    }

    /**
     * Get kvSteeringDesId
     *
     * @return integer
     */
    public function getKvSteeringDesId()
    {
        return $this->kvSteeringDesId;
    }

    /**
     * Get kvSteeringSideDesId
     *
     * @return integer
     */
    public function getKvSteeringSideDesId()
    {
        return $this->kvSteeringSideDesId;
    }

    /**
     * Get maxWeight
     *
     * @return string
     */
    public function getMaxWeight()
    {
        return $this->maxWeight;
    }

    /**
     * Get kvModelDes
     *
     * @return string
     */
    public function getKvModelDes()
    {
        return $this->kvModelDes;
    }

    /**
     * Get kvAxleDes
     *
     * @return string
     */
    public function getKvAxleDes()
    {
        return $this->kvAxleDes;
    }

    /**
     * Get ccmTax
     *
     * @return integer
     */
    public function getCcmTax()
    {
        return $this->ccmTax;
    }

    /**
     * Get litres
     *
     * @return string
     */
    public function getLitres()
    {
        return $this->litres;
    }

    /**
     * Get kvDriveDes
     *
     * @return string
     */
    public function getKvDriveDes()
    {
        return $this->kvDriveDes;
    }

    /**
     * Get kvTransDes
     *
     * @return string
     */
    public function getKvTransDes()
    {
        return $this->kvTransDes;
    }

    /**
     * Get kvFuelSupplyDes
     *
     * @return string
     */
    public function getKvFuelSupplyDes()
    {
        return $this->kvFuelSupplyDes;
    }

    /**
     * Get valves
     *
     * @return integer
     */
    public function getValves()
    {
        return $this->valves;
    }

    /**
     * Get rtExists
     *
     * @return integer
     */
    public function getRtExists()
    {
        return $this->rtExists;
    }
}
