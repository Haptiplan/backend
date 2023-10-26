<?php
/**
 * Die Klasse-User repräsentiert einen User und
 * verwaltet die ID und den Namen eines Users.
 */
class User{
    private int $id;
    private string $name;

    /**
     * Die Konstruktor Methode wird aufgerufen wenn ein Objekt erstellt wird.
     * 
     * @param int $id Die ID von dem User.
     * @param string $name Der Name dem User.
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }   

    /**
     * Die Methode gibt die Id des Users zurück.
     * 
     * @return int Id des User.
     */
    public function getId() :int
    {
        return $this->id;
    }
    
    /**
     * Setzt die ID des Users.
     *
     * @param int $id Die ID des Users.
     */
    public function setId(int $id)
    {
         $this->id = $id;
    }

    /**
     * Die Methode gibt den Namen des Users zurück
     * 
     * @return string Name des Users.
     */
    public function getName() :string
    {
        return $this->name;
    }

    /**
     * Setzt den Namen des Users.
     *
     * @param string $name Den Namen des Users.
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Die __toString Methode bestimmt wie die Klasse reagiert, wenn
     * die Klasse wie ein String behandelt wird.
     * 
     * @return string Der Name und die ID des Users.
     */
    public function __toString() : string
    {
        return "ID: " . $this->id . ", Name: " . $this->name;
    }
}
?>