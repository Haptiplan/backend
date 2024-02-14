<?php

class Employeetype
{
    private int $employee_id;
    private int $employee_salary;

    /**
     * Get the value of employee_id
     */ 
    public function getEmployee_id()
    {
        return $this->employee_id;
    }

    /**
     * Set the value of employee_id
     *
     * @return  self
     */ 
    public function setEmployee_id($employee_id)
    {
        $this->employee_id = $employee_id;

        return $this;
    }
    /**
     * Get the value of employee_salary
     */ 
    public function getEmployee_salary()
    {
        return $this->employee_salary;
    }

    /**
     * Set the value of employee_salary
     *
     * @return  self
     */ 
    public function setEmployee_salary($employee_salary)
    {
        $this->employee_salary = $employee_salary;

        return $this;
    }

}