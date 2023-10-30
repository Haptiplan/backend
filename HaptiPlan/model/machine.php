<?php
/**
 * Die Klasse-Machine repräsentiert eine Maschine und
 * verwaltet seine Eigenschaften.
 */
class Machine{

    private int $id;
    private string $name;
    private string $capacity;
    private int $price;
    private int $duration; 
    private int $period;

    /**
     * Die Konstruktor Methode wird aufgerufen wenn ein Objekt erstellt wird.
     * 
     * @param int $id Die Id der Maschine.
     * @param string $name Den Namen der Maschine.
     * @param string $capacity Die Capacity der Maschine.
     * @param int $price Der Preis der Maschine.
     * 
     * @example
     * ```
     * $machine = new Machine(1, "Maschine A", "500", 1000);
     * ```
     */
    public function __construct(int $id, string $name, string $capacity,int $price)
    {
        $this->id = $id; 
        $this->name = $name;  
        $this->capacity = $capacity;  
        $this->price= $price;  
    }   

    /**
     * Die Methode gibt die Id der Maschine zurück.
     * 
     * @return int Id der Maschine.
     */
    public function getMachineId() :int
    {
        return $this->id;
    }

    /**
     * Setzt die ID der Maschine.
     *
     * @param int $id Die ID der Maschine.
     */
    public function setMachineId(int $id)
    {
         $this->id = $id;
    }

    /**
     * Die Methode gibt den Namen der Maschine zurück
     * 
     * @return string Name der Maschine.
     */
    public function getMachineName() :string
    {
        return $this->name;
    }

    /**
     * Setzt den Namen der Maschine.
     *
     * @param string $name Den Namen der Maschine.
     */
    public function setMachineName(string $name)
    {
        $this->name = $name;
    }  

    /**
     * Die Methode gibt die Capacity der Maschine zurück
     * 
     * @return string Capacity der Maschine.
     */
    public function getMachineCapacity() :string
    {
        return $this->capacity;
    }

    /**
     * Setzt die Capacity der Maschine.
     *
     * @param string $capacity Die Capacity der Maschine.
     */
    public function setMachineCapacity(string $capacity)
    {
        $this->capacity = $capacity;
    }  

    /**
     * Gibt den Preis der Maschine zurück.
     *
     * Diese Methode gibt den aktuellen Preis der Maschine zurück.
     *
     * @return int Der Preis der Maschine.
     */
    public function getMachinePrice() :int
    {
        return $this->price;
    }

    /**
     * Setzt den Preis der Maschine.
     *
     * Diese Methode setzt den Preis der Maschine auf den angegebenen Wert.
     *
     * @param int $price Der neue Preis der Maschine.
     * @return void
     */
    public function setMachinePrice(int $price)
    {
         $this->price = $price;
    }

    /**
     * Gibt die Dauer der Maschine zurück.
     *
     * Diese Methode gibt die aktuelle Dauer (Laufzeit) der Maschine zurück.
     *
     * @return int Die Dauer (Laufzeit) der Maschine.
     */
    public function getMachineDuration() :int
    {
        return $this->duration;
    }

    /**
     * Setzt die Dauer der Maschine.
     *
     * Diese Methode setzt die Dauer (Laufzeit) der Maschine auf den angegebenen Wert.
     *
     * @param int $duration Die neue Dauer (Laufzeit) der Maschine.
     * @return void
     */
    public function setMachineDuration(int $duration)
    {
         $this->duration = $duration;
    }

    /**
     * Gibt die Periode der Maschine zurück.
     *
     * Diese Methode gibt die aktuelle Periode der Maschine zurück.
     *
     * @return int Die Periode der Maschine.
     */
    public function getMachinePeriod() :int
    {
        return $this->period;
    }

    /**
     * Setzt die Periode der Maschine.
     *
     * Diese Methode setzt die Periode (Zyklus) der Maschine auf den angegebenen Wert.
     *
     * @param int $period Die neue Periode (Zyklus) der Maschine.
     * @return void
     */
    public function setMachinePeriod(int $period)
    {
         $this->period = $period;
    }

    /**
     * Die __toString Methode bestimmt wie die Klasse reagiert, wenn
     * die Klasse wie ein String behandelt wird.
     * 
     * @return string Der Name und die ID der Maschine.
     */
    public function __toString() :string
    {
        return "ID: " . $this->id . " Name: " . $this->name . "Kapazität: ".$this->capacity . "Preis: " . $this->price;
    }
}