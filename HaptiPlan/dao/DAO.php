<?php
interface DAO{
    public function insertMachine ($request);
    public function deleteMachine ($request);
    public function updateMachine ($request);
    public function getMachine($request);
    public function getAllMachine();
}