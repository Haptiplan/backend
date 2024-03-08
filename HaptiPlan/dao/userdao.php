<?php
require_once 'dao.php';
class UserDao implements Dao
{
    private $db;
    public function __construct()
    {
        $this->db = DATABASE::getInstance();
    }
    public function insert($request)
    {
        $sql = 'INSERT INTO users (user_name, user_password, user_role) VALUES (?, ?, ?)';
        $this->db->execute($sql, [
            $request->getRawData('user_name'),
            $request->getRawData('user_password'),
            $request->getRawData('user_role')
        ]);
        
        return Response::jsonResponse("User is created", 201);
    }

    public function delete($request)
    {
        $sql = 'DELETE FROM users WHERE user_id = (?)';
        $this->db->execute($sql, [$request->getPathParams()]);
        return Response::jsonResponse("User deleted");

    }
    public function update($request)
    {
        $sql = 'UPDATE users SET 
            (user_name = ?,
            user_password = ?)
        WHERE user_id = (?)';
        $this->db->execute($sql, [
            $request->getRawData('user_name'),
            $request->getRawData('user_password')
        ]);
    }
    public function get($request)
    {
        $sql = 'SELECT user_name, user_password, user_role FROM users WHERE user_id = (?)';
        return $this->db->execute($sql, [$request->getPathParams()]);
    }
    public function getAll()
    {
        $sql = 'SELECT * FROM users';
        $users = $this->db->query($sql);

        return Response::jsonResponse($users);
    }

    public function ifExist($request)
    {
        $sql = 'SELECT * FROM users WHERE user_id = ? ';
        $user = $this->db->execute($sql, [$request->getPathParams()]);
        $user_exist = false;
        if ($user) {
            $user_exist = true;
        }
        return $user_exist;
    }
}
