<?php

class Machinetype1
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
}
