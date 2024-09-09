<?php

class Machinetype
{
    private int $machine_id;	
    private String $machine_name; 	
    private int $machine_capacity; 	
    private float $machine_price; 	
    private int $machine_duration; 	
    private int $machine_period;

    /**
     * Get the value of machine_id
     */ 
    public function getMachine_id()
    {
        return $this->machine_id;
    }

    /**
     * Set the value of machine_id
     *
     * @return  self
     */ 
    public function setMachine_id($machine_id)
    {
        $this->machine_id = $machine_id;

        return $this;
    }

    /**
     * Get the value of machine_name
     */ 
    public function getMachine_name()
    {
        return $this->machine_name;
    }

    /**
     * Set the value of machine_name
     *
     * @return  self
     */ 
    public function setMachine_name($machine_name)
    {
        $this->machine_name = $machine_name;

        return $this;
    }

    /**
     * Get the value of machine_capacity
     */ 
    public function getMachine_capacity()
    {
        return $this->machine_capacity;
    }

    /**
     * Set the value of machine_capacity
     *
     * @return  self
     */ 
    public function setMachine_capacity($machine_capacity)
    {
        $this->machine_capacity = $machine_capacity;


        return $this;
    }

    /**
     * Get the value of machine_price
     */ 
    public function getMachine_price()
    {
        return $this->machine_price;
    }

    /**
     * Set the value of machine_price
     *
     * @return  self
     */ 
    public function setMachine_price($machine_price)
    {
        $this->machine_price = $machine_price;

        return $this;
    }

    /**
     * Get the value of machine_duration
     */ 
    public function getMachine_duration()
    {
        return $this->machine_duration;
    }

    /**
     * Set the value of machine_duration
     *
     * @return  self
     */ 
    public function setMachine_duration($machine_duration)
    {
        $this->machine_duration = $machine_duration;

        return $this;
    }

    /**
     * Get the value of machine_period
     */ 
    public function getMachine_period()
    {
        return $this->machine_period;
    }

    /**
     * Set the value of machine_period
     *
     * @return  self
     */ 
    public function setMachine_period($machine_period)
    {
        $this->machine_period = $machine_period;

        return $this;
    }

    public function createMachine()
    {
        $conn = Database::connection();
        $stmt = $conn->prepare('INSERT INTO machinetype VALUES(null,?,?,?,?,?)');
        $stmt->execute([
            $this->getMachine_name(),
            $this->getMachine_capacity(),
            $this->getMachine_price(),
            $this->getMachine_duration(),
            $this->getMachine_period()
        ]);
    }

    public function updateMachine($request)
    {
        $conn = Database::connection();
        $stmt = $conn->prepare('UPDATE machinetype SET 
                                                    machine_name = ?,
                                                    machine_capacity = ?,
                                                    machine_price = ?,
                                                    machine_duration = ?,
                                                    machine_period = ? 
                                WHERE machine_id = ?');
        $stmt->execute([
            $request->getRawData('machine_name'),
            $request->getRawData('machine_capacity'),
            $request->getRawData('machine_price'),
            $request->getRawData('machine_duration'),
            $request->getRawData('machine_period'), 
            $request->getPathParams()
        ]);
    }

    public function getMachine($request)
    {
        $conn =  Database::connection();
        $stmt = $conn->prepare('SELECT * FROM machinetype WHERE machine_id = ? ');
        $stmt->execute([$request->getPathParams()]);
        $machine = $stmt->fetch(PDO::FETCH_ASSOC);
        return $machine;
    }


    public function getAllMachine()
    {
        $conn =  Database::connection();
        $machines = $conn->query('SELECT * FROM machinetype')->fetchAll(PDO::FETCH_OBJ);

        return $machines;
    }

    public function deleteMachine($request)
    {
        $conn = Database::connection();
        $stmt = $conn->prepare('DELETE FROM machinetype WHERE machine_id = ?');

        $stmt->execute([$request->getPathParams()]);
    }

    public function ifMachineExist($request)
    {
        
        $conn =  Database::connection();
        $stmt = $conn->prepare('SELECT * FROM machinetype WHERE machine_id = ? ');
        $stmt->execute([$request->getPathParams()]);
        $machine = $stmt->fetch(PDO::FETCH_ASSOC);
       
        if ($machine) {
            return true;
        }
        return false; 
    }
}
