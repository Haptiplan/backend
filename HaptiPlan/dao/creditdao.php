<?php
require_once 'dao.php';
class CreditDao implements Dao
{
    private $db;
    public function __construct()
    {
        $this->db = DATABASE::getInstance();
    }

    public function insert($request)
    {
        $sql = 'INSERT INTO credit VALUES(null,?)';
        $this->db->execute($sql, [
            $request->getRawData('credit_amount')
        ]);
                return Response::jsonResponse("Credit is created", 201);

    }
    public function delete($request)
    {
        $sql = 'DELETE FROM credit WHERE credit_id = (?)';
        $this->db->execute($sql, [$request->getPathParams()]);
        return Response::jsonResponse("credit deleted");

    }
    public function update($request)
    {
        $sql = 'UPDATE credit SET 
            credit_amount = ?,
        WHERE credit_id = ?';
        $this->db->execute($sql, [
            $request->getRawData('credit_amount')
        ]);
    }
    public function get($request)
    {
        $sql = 'SELECT credit_id, credit_amount FROM credit WHERE credit_id = (?)';
        return $this->db->execute($sql, [$request->getPathParams()]);
    }
    public function getAll()
    {
        $sql = 'SELECT * FROM credit';
        $credits = $this->db->query($sql);
        
        return Response::jsonResponse($credits);
    }
    
    public function ifExist($request)
    {
        $sql = 'SELECT * FROM credit WHERE credit_id = ? ';
        $credit = $this->db->execute($sql, [$request->getPathParams()]);
        $credit_exist = false;
        if ($credit) {
            $credit_exist = true;
        }
        return $credit_exist; 
    }
}
