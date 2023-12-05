<?php
class Raw extends Decision{
 
    private int $position;
    private int $decision_type;
    private int $product_type_id;

    public function __construct(int $position, int $decision_type, int $product_type_id){
        $this->position = $position;
        $this->decision_type = $decision_type;
        $this->product_type_id = $product_type_id;
    }
}