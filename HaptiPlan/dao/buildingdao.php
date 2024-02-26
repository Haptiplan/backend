<?php
require_once 'dao.php';
class BuildingDao implements Dao
{
    private $db;
    public function __construct()
    {
        $this->db = DATABASE::getInstance();
    }
    public function insert($request)
    {
        $sql = 'INSERT INTO building (building_name,building_price, building_type_id) VALUES (?,?,?)';
        $this->db->execute($sql, [
        $request->getRawData('building_name'),
        $request->getRawData('building_price'),
        $request->getRawData('building_type_id')
    ]);
        
        return Response::jsonResponse("building is created", 201);
    }

    public function delete($request)
    {
        $sql = 'DELETE FROM building WHERE building_id = (?)';
        $this->db->execute($sql, [$request->getPathParams()]);
        return Response::jsonResponse("building deleted");

    }
    public function update($request)
    {
        $building_price = $request->getRawData('building_price');
        $building_id = $request->getPathParams();
        $sql = 'UPDATE building SET building_price = ? WHERE building_id = ?';
        $this->db->execute($sql, [$building_price,$building_id]);
        return Response::jsonResponse("Building updated");
    }
    public function get($request)
    {
        $sql = 'SELECT building_id, building_name, building_price FROM building WHERE building_id = (?)';
        return $this->db->execute($sql, [$request->getPathParams()]);
    }
    public function getAll()
    {
        $sql = 'SELECT * FROM building';
        $building = $this->db->query($sql);

        return Response::jsonResponse($building);
    }

    public function ifExist($request)
    {
        $sql = 'SELECT * FROM building WHERE building_id = ? ';
        $building = $this->db->execute($sql, [$request->getPathParams()]);
        $building_exist = false;
        if ($building) {
            $building_exist = true;
        }
        return $building_exist;
    }
}
