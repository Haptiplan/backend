<?php
require_once 'dao.php';
class MachineDao implements Dao
{
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
                return Response::jsonResponse("Machine is created", 201);

    }
    public function delete($request)
    {
        $sql = 'DELETE FROM machinetype WHERE machine_id = (?)';
        $this->db->execute($sql, [$request->getPathParams()]);
        return Response::jsonResponse("Machine deleted");

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
        
        return Response::jsonResponse($machines);
    }
    
    public function ifExist($request)
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
