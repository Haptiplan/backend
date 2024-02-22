<?php
class User{
    private String $user_name;
    private String $user_passwort;
    private int $user_id;
    private int $user_role;
    public function __construct(String $user_name, String $user_passwort, int $user_id, int $user_role) 
    {
        $this->user_name = $user_name;
        $this->user_passwort = $user_passwort;
        $this->user_id = $user_id;
    }
        /**
     * Get the name of the user.
     *
     * @return String The name of the user.
     */
    public function getName(): String
    {
        return $this->user_name;
    }

    /**
     * Get the password of the user.
     *
     * @return String The password of the user.
     */
    public function getPassword(): String
    {
        return $this->user_passwort;
    }

    /**
     * Get the user identifier.
     *
     * @return int The user identifier.
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * Get the user role (admin = 0, gamemaster = 1, player = 2).
     *
     * @return int The user role.
     */
    public function getUserRole(): int
    {
        return $this->user_role;
    }
}