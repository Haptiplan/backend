<?php

class Credit extends Decision{

    private int $amount;
    private int $decision_type;
    private int $credit_type_id;

    public function __construct(int $amount, int $decision_type, int $credit_type_id){

        $this->amount = $amount;
        $this->decision_type = $decision_type;
        $this->credit_type_id = $credit_type_id;

    }
}