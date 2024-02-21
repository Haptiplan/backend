<?php
require_once("dao.php");
class EmployeeDao implements Dao
{
    private $db;
    public function __construct()
    {
        $this->db = DATABASE::getInstance();
    }

    public function insert($request)
    {
        $sql = 'INSERT INTO employeetype VALUES(null,?,?)';
        $this->db->execute($sql, [
            $request->getRawData('employee_name'),
            $request->getRawData('employee_salary')
        ]);

        return Response::jsonResponse("Employee is created", 201);
    }
    public function delete($request)
    {
        $sql = 'DELETE FROM employeetype WHERE employee_id = (?)';
        $this->db->execute($sql, [$request->getPathParams()]);

        return Response::jsonResponse("Employee deleted");
    }
    public function update($request)
    {
        $sql = 'UPDATE employeetype SET employee_salary = ? WHERE employee_id = ?';

        $this->db->execute($sql, [$request->getRawData('employee_salary')]);
    }
    public function get($request)
    {
        $sql = 'SELECT employee_id, employee_name, employee_salary FROM employeetype WHERE employee_id = (?)';
        
        return $this->db->execute($sql, [$request->getPathParams()]);
    }
    public function getAll()
    {
        $sql = 'SELECT * FROM employeetype';
        $employees = $this->db->query($sql);

        return Response::jsonResponse($employees);
    }
}