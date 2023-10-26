<?php

class Company{
    private int $id;
    private string $name;
    private array $machines;
    private array $users;
    
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->users = array();  
        $this->machines = array();
    }   
    
    public function getId() :int
    {
        return $this->id;
    }

    public function getName() :string
    {
        return $this->name;
    }

    public function setId(int $id)
    {
         $this->id = $id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function __toString() :string
    {
        return "ID: " . $this->id . ", Name: " . $this->name;
    }
           
    public function addMachine(int $id, string $name, string $kapazitaet,int $preis)
    {
        $machine = new Machine($id, $name, $kapazitaet, $preis);
        $this->machines[] = $machine;
        return $machine; 
    }
    
    public function addUser(int $id, string $name)
    {
        $user = new User($id, $name); 
        $this->users[] = $user;
        return $user;
    }
}
?>