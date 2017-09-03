<?php
include_once "UserTable.php";

/**
 * Class StandardUserTable
 */
class StandardUserTable extends UserTable
{
    /**
     * Adds a user to the database WITHOUT admin privileges
     * @param string $username
     * @param string $email
     * @param string $password
     * @param bool $admin
     * @return bool
     */
    public function addUser($username, $email, $password, $admin = false)
    {
        // force admin false in case someones passes invalid value
        // workaround for strict php warning due to difference in number of function params
        $admin = false;

        return parent::addUser($username, $email, $password, $admin);
    }

    /**
     * @inheritdoc
     */
    public function checkCredentials($username, $password)
    {
        return parent::checkCredentials($username, $password);
    }
}