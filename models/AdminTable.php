<?php
include_once "UserTable.php";

/**
 * Class AdminTable
 */
class AdminTable extends UserTable
{
    /**
     * Adds a user to the database WITH admin privileges
     * @param $username
     * @param string $email
     * @param string $password
     * @param bool $admin
     * @return bool
     */
    public function addUser($username, $email, $password, $admin = true)
    {
        // force admin true in case someones passes invalid value
        // workaround for strict php warning due to difference in number of function params
        $admin = true;
        
        return parent::addUser($username, $email, $password, $admin);
    }

    /**
     * Checks if a set of credentials are valid and that the user is also an admin
     * @param string $username
     * @param string $password
     * @return bool
     * @throws Exception
     */
    public function checkCredentials($username, $password)
    {
        try {
            // get the result of the parent query for checking credentials
            $statement = parent::checkCredentials($username, $password);

            $entry = $statement->fetchObject();

            // if the user is an admin then return true (success)
            if ($entry->admin) {
                return true;
            }
            else {
                throw new Exception("User not an admin");
            }
        }
        catch (Exception $e) {
            throw new Exception("Login failed.");
        }
    }
}