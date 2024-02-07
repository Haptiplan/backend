<?php
include("dao.php");
class MachineDao implements Dao
{
    private static $_instance;
    private $db;
    public function __construct()
    {
        $this->db = DATABASE::getInstance();
    }

    public function insert($request)
    {
        $sql = ('INSERT INTO machinetype VALUES(null,?,?,?,?,?)');
        $this->db->execute($sql, [
            $request->getRawData('machine_name'),
            $request->getRawData('machine_capacity'),
            $request->getRawData('machine_price'),
            $request->getRawData('machine_duration'),
            $request->getRawData('machine_period')
        ]);
    }
    public function delete($request)
    {
        $sql = 'DELETE FROM machinetype WHERE machine_id = (?)';
        $this->db->execute($sql, [$request->getPathParams()]);
    }
    public function update($request)
    {
        $sql = 'UPDATE machinetype SET 
            machine_name = ?,
            machine_capacity = ?,
            machine_price = ?,
            machine_duration = ?,
            machine_period = ? 
        WHERE machine_id = ?';
        $this->db->execute($sql, [
            $request->getRawData('machine_name'),
            $request->getRawData('machine_capacity'),
            $request->getRawData('machine_price'),
            $request->getRawData('machine_duration'),
            $request->getRawData('machine_period')
            //$request->getPathParams()
        ]);
    }
    public function get($request)
    {
        $sql = 'SELECT machine_id, machine_name FROM machinetype WHERE machine_id = (?)';
        return $this->db->execute($sql, [$request->getPathParams()]);
    }
    public function getAll()
    {
        $sql = ("SELECT * FROM machinetype");
        $machines = $this->db->query($sql);
        
        return $machines;
    }
    
    public function ifMachineExist($request)
    {
        $sql = ('SELECT * FROM machinetype WHERE machine_id = ? ');
        $machine = $this->db->execute($sql, [$request->getPathParams()]);
        $machine_exist = false;
        if ($machine) {
            $machine_exist = true;
        }
        return $machine_exist; 
    }
}
