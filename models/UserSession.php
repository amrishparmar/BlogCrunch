<?php

/**
 * Class UserSession
 */
class UserSession
{
    /**
     * UserSession constructor.
     */
    public function __construct()
    {
        session_start();
    }

    /**
     * Returns whether or not a user is logged in
     * @return bool
     */
    public function isLoggedIn()
    {
        if (isset($_SESSION['logged_in'])) {
            return $_SESSION['logged_in'];
        }

        return false;
    }

    /**
     * Returns whether or not an admin user is logged in
     * @return bool
     */
    public function isAdminLoggedIn() {
        if (!$this->isLoggedIn()) {
            return false;
        }

        if (isset($_SESSION['is_admin'])) {
            return $_SESSION['is_admin'];
        }

        return false;
    }

    /**
     * Logs a user in by setting the appropriate corresponding session vars
     * @param $user_id
     * @param $username
     * @param $is_admin
     */
    public function login($user_id, $username, $is_admin)
    {
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['is_admin'] = $is_admin;
    }

    /**
     * Logs a user out by unsetting session vars and destroying the session
     */
    public function logout()
    {
        $_SESSION['logged_in'] = false;
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['is_admin']);
        session_destroy();
    }
}