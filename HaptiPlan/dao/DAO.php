<?php
interface Dao{
    public function insert($request);
    public function delete($request);
    public function update($request);
    public function get($request);
    public function getAll();
}