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
        $credit_amount = $request->getRawData('credit_amount');
        $credit_id = $request->getPathParams();
        $sql_insert = 'INSERT INTO credit (credit_id,credit_amount) VALUES (?,?)';
        $this->db->execute($sql_insert, [$credit_id, $credit_amount]);

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
        $credit_amount = $request->getRawData('credit_amount');
        $credit_id = $request->getPathParams();
        $sql_update = 'UPDATE credit SET credit_amount = ? WHERE credit_id = ?';
        if ($this->ifExist($request)) {
            $this->db->execute($sql_update, [$credit_amount, $credit_id]);
        } else {
            //When Credit with ID dont exist
           $this->insert($request);
        }
        return Response::jsonResponse("Credit updated");
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
        $credit = $this->db->query($sql, [$request->getPathParams()]);

        $credit_exist = false;
        if ($credit != null) {
            $credit_exist = true;
        }
        return $credit_exist;
    }
}
