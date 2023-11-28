<?php
class Employeeproduction extends Decision{
    private int $decision_type;
    private int $employee_id;

    public function __construct(int $decision_type, int $employee_id){

        $this->decision_type = $decision_type;
        $this->employee_id = $employee_id;
    }
}