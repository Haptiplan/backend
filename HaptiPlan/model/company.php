<?php

/**
 * Die Company-Klasse repräsentiert ein Unternehmen und 
 * verwaltet Maschinen und Benutzer.
 */
class Company{
    private int $id;
    private string $name;
    private array $machines;
    private array $users;
    
    /**
     * @param int $id Die ID von der Comapny.
     * @param string $name Der Name der Maschine.
     * 
     * Außerdem wird hier ein User Array und ein Machine Array erstellt,
     * wenn man ein Objekt der Klasse Company erstellt.
     */
    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->users = array();  
        $this->machines = array();
    }   

    /**
     * Gibt die Id des Unternehmens zurück.
     * 
     * @return int Die ID des Unternehmens.
     */   
    public function getCompanyId() :int
    {
        return $this->id;
    }

     /**
     * Setzt die ID des Unternehmens.
     * 
     * @param int $id Die ID des Unternehmens.
     */
    public function setCompanyId(int $id)
    {
        $this->id = $id;
    }

    /**
     * Gibt den Namen des Unternehmens zurück.
     * 
     * @return string Der Name des Unternehmens.
     */
    public function getCompanyName() :string
    {
        return $this->name;
    }

    /**
     * Setzt den Namen des Unternehmens.
     * 
     * @param string $name Der Name des Unternehmens.
     */
    public function setCompanyName(string $name) :never
    {
        $this->name = $name;
    }

    /**
     * Die __toString Methode entscheidet wie die Klasse reagiert, wenn
     * die Klasse wie ein String behandelt wird.
     * 
     * @return string Der Name und die ID des Unternehmens.
     */
    public function __toString() :string
    {
        return "ID: " . $this->id . ", Name: " . $this->name;
    }
           
    /**
     * Eine Maschine wird dem Unternehmen hinzugefügt.
     * 
     * @param int $id Die Id der Maschine.
     * @param string $name Der Name der Maschine.
     * @param string $capacity Die Capacity der Maschine.
     * @param int $price Der Preis der Maschine.
     * @return $machine Das erstelle Maschinen-Objekt.
     */
    public function addMachine(int $id, string $name, string $capacity, int $price)
    {
        $machine = new Machine($id, $name, $capacity, $price);
        $this->machines[$id] = $machine;
        return $machine; 
    }

    /**
     * Entfernt eine Maschine anhand der ID
     * 
     * @param int $id Die Id der Maschine.
     */
    public function removeMachine(int $id)
    {
        unset($this->machines[$id]);
    }

    /**
     * Gibt alle Maschinen des Unternehmens an.
     * 
     * @return $allMachines Alle Maschinen im Unternehmen
     */
    public function getMachines() : array
    { 
        return $this->machines;
    }
   
    public function setMachines(array $machine) 
    { 
        $this->machines[] = $machine;
    }
    /**
     * Ein User wird dem Unternehmen hinzugefügt.
     * 
     * @param int $id Die ID des Users.
     * @param string $name Den Namen des Users.
     * @return $user Das erstelle User-Objekt.
     */
    public function addUser(int $id, string $name)
    {
        $user = new User($id, $name); 
        $this->users[] = $user;
        return $user;
    }

     /**
     * Gibt alle User des Unternehmen an.
     * 
     * @return $user Alle Users im Unternehmen
     */
    public function getUsers() : array
    { 
      return $this->users;
    }
}
