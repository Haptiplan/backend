<?php
class Decision{
    private int $decision_id;
    private DateTime $timestamp;
    private int $company_id;
    private int $user_id;
    private int $period_id;

    public function __construct(int $decision_id, DateTime $timestamp, int $company_id, int $user_id, int $period_id){
        $this->decision_id = $decision_id;
        $this->timestamp = $timestamp;
        $this->company_id = $company_id;
        $this->user_id = $user_id;
        $this->period_id = $period_id;
    }
}