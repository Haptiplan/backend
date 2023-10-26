<?php

class User{
    private int $id;
    private string $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
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

    public function __toString() : string
    {
        return "ID: " . $this->id . ", Name: " . $this->name;
    }
}
?>