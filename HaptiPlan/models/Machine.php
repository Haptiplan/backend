<?php


class Machine
{
    private int $machineID;
    private String $bezeichnung;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->machineID;
    }

    /**
     * Set the value of id
     */
    public function setId($id)
    {
        $this->machineID = $id;

        return $this;
    }

    /**
     * Get the value of bezeichnung
     */
    public function getBezeichnung()
    {
        return $this->bezeichnung;
    }

    /**
     * Set the value of bezeichnung
     */
    public function setBezeichnung($bezeichnung)
    {
        $this->bezeichnung = $bezeichnung;
    }

    public function createMachine()
    {
        $conn = Database::connection();
        $stmt = $conn->prepare('INSERT INTO machine VALUES(null,?)');
        $stmt->execute([$this->bezeichnung]);
    }

    public function updateMachine($request)
    {
        $conn = Database::connection();
        $stmt = $conn->prepare('UPDATE machine set bezeichnung = ? WHERE machineID = ?');
        $stmt->execute([$request->input('bezeichnung'), $request->input('machineID')]);
    }

    public function getMachine($request)
    {
        $conn =  Database::connection();
        $stmt = $conn->prepare('SELECT * FROM machine WHERE machineID = ? ');
        $machine = $stmt->execute([$request->input('machineID')]);
        return $machine;
    }


    public function getALLMachine()
    {
        $conn =  Database::connection();
        $machines = $conn->query('SELECT * FROM machine')->fetchAll(PDO::FETCH_OBJ);
        return $machines;
    }

    public function deleteMachine($request)
    {
        $conn = Database::connection();
        $stmt = $conn->prepare('DELETE FROM machine WHERE machineID = ?');
        $stmt->execute([$request->input('machineID')]);
    }

    public function ifMachineExixste($request)
    {
        
        $conn =  Database::connection();
        $stmt = $conn->prepare('SELECT * FROM machine WHERE machineID = ? ');
        $stmt->execute([$request->input('machineID')]);
        $machine = $stmt->fetch(PDO::FETCH_ASSOC);
       
        if ($machine) {
            return true;
        }
        return false; 
    }
}
