<?php
class Building extends Decision{

    private int $position;
    private int $decision_type;
    private int $building_type_id;

    public function __construct(int $position, int $decision_type,int $building_type_id){ 
        $this->position = $position;
        $this->decision_type = $decision_type;
        $this->building_type_id = $building_type_id;
    }
}