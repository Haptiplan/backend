<?php
class Machine{

    private int $id;
    private string $name;
    private string $kapazitaet;
    private int $preis;
    private int $laufzeit; 
    private int $periode;

    public function __construct(int $id, string $name, string $kapazitaet,int $preis)
    {
        $this->id = $id; 
        $this->name = $name;  
        $this->kapazitaet = $kapazitaet;  
        $this->preis= $preis;  
    }   

    public function getId() :int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
         $this->id = $id;
    }

    public function getName() :string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }  

    public function getKapazitaet() :string
    {
        return $this->kapazitaet;
    }

    public function setKapazitaet(string $kapazitaet)
    {
        $this->kapazitaet = $kapazitaet;
    }  

    public function getPreis() :int
    {
        return $this->preis;
    }

    public function setPreis(int $preis)
    {
         $this->preis = $preis;
    }

    public function getLaufzeit() :int
    {
        return $this->laufzeit;
    }

    public function setLaufzeit(int $laufzeit)
    {
         $this->laufzeit = $laufzeit;
    }

    public function getPeriode() :int
    {
        return $this->periode;
    }

    public function setPeriode(int $periode)
    {
         $this->periode = $periode;
    }

    public function __toString() :string
    {
        return "ID: " . $this->id . ", Name: " . $this->name;
    }
}
?>