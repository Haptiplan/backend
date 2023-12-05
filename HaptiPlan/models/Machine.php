<?php


class Machine
{
    private int $machineId;
    private String $description;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->machineId;
    }

    /**
     * Set the value of id
     */
    public function setId($id)
    {
        $this->machineId = $id;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function createMachine()
    {
        $conn = Database::connection();
        $stmt = $conn->prepare('INSERT INTO machine VALUES(null,?)');
        $stmt->execute([$this->description]);
    }

    public function updateMachine($request)
    {
        $conn = Database::connection();
        $stmt = $conn->prepare('UPDATE machine set description = ? WHERE machineId = ?');
        $stmt->execute([$request->getRawData('description'), $request->getPathParams()]);
    }

    public function getMachine($request)
    {
        $conn =  Database::connection();
        $stmt = $conn->prepare('SELECT * FROM machine WHERE machineId = ? ');
        $stmt->execute([$request->getPathParams()]);
        $machine = $stmt->fetch(PDO::FETCH_ASSOC);
        return $machine;
    }


    public function getAllMachine()
    {
        $conn =  Database::connection();
        $machines = $conn->query('SELECT * FROM machine')->fetchAll(PDO::FETCH_OBJ);
        return $machines;
    }

    public function deleteMachine($request)
    {
        $conn = Database::connection();
        $stmt = $conn->prepare('DELETE FROM machine WHERE machineId = ?');
        $stmt->execute([$request->getPathParams()]);
    }

    public function ifMachineExist($request)
    {
        
        $conn =  Database::connection();
        $stmt = $conn->prepare('SELECT * FROM machine WHERE machineId = ? ');
        $stmt->execute([$request->getPathParams()]);
        $machine = $stmt->fetch(PDO::FETCH_ASSOC);
       

        if ($machine) {
            return true;
        }
        return false; 
    }
}
