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
    public function getId() :int
    {
        return $this->id;
    }

    /**
     * Gibt den Namen des Unternehmens zurück.
     * 
     * @return string Der Name des Unternehmens.
     */
    public function getName() :string
    {
        return $this->name;
    }

    /**
     * @params int $id Die ID des Unternehmens.
     * 
     * Setzt die ID des Unternehmens.
     */
    public function setId(int $id)
    {
         $this->id = $id;
    }

    /**
     * @params string $name Der Name des Unternehmens.
     * 
     * Setzt den Namen des Unternehmens.
     */
    public function setName(string $name)
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
     * 
     * 
     * @param int $id Die Id der Maschine.
     * @param string $name Der Name der Maschine.
     * @param string $capacity Die Kapazität der Maschine.
     * @param int $price Der Preis der Maschine.
     * @return $machine Das erstelle Maschinen-Objekt.
     */
    public function addMachine(int $id, string $name, string $capacity,int $price)
    {
        $machine = new Machine($id, $name, $capacity, $price);
        $this->machines[] = $machine;
        return $machine; 
    }
    
    /**
     * Ein User wird dem Unternehmen hinzugefügt.
     * 
     * @param int $id Die ID des Users.
     * @param string $name Den Namen des Users.
     * 
     * @return $user Das erstelle User-Objekt.
     * 
     */
    public function addUser(int $id, string $name)
    {
        $user = new User($id, $name); 
        $this->users[] = $user;
        return $user;
    }
}
?>