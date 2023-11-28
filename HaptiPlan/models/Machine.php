<?php
class Machine extends Decision{

    private int $position;
    private int $decision_type;
    private int $machine_type_id;

    public function __construct(int $position,int $decision_type,int $machine_type_id){
        $this->position = $position;
        $this->decision_type = $decision_type;
        $this->machine_type_id = $machine_type_id;
    }
}