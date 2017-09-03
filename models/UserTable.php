<?php
include_once "Table.php";

/**
 * Class UserTable
 */
class UserTable extends Table
{
    /**
     * Checks if an email address is already in the database, throws an exception if so
     * @param $username
     * @param string $email
     * @throws Exception
     */
    protected function checkUsernameAndEmail($username, $email)
    {
        $sql = "SELECT username, email
                FROM users
                WHERE username = ? OR email = ?";

        $data = array($username, $email);

        // execute the sql statement and store the result set
        $user_table_retrieval = $this->makeStatement($sql, $data);

        // if the query generated a successful result, then we already have the email in the database
        if ($user_table_retrieval->rowCount() >= 1) {
            throw new Exception("Error: e-mail/username already in use");
        }
    }

    /**
     * Adds a new user to the database
     * @param string $username
     * @param string $email
     * @param string $password
     * @param bool $admin
     * @return bool
     */
    protected function addUser($username, $email, $password, $admin)
    {
        try {
            // check if the e-mail is valid, will throw exception if is not
            $this->checkUsernameAndEmail($username, $email);

            // prepare the sql statement for entering the new user into the database
            $sql = "INSERT INTO users (username, email, password, admin)
                    VALUES (?, ?, ?, ?)";

            // use SHA256 to hash the password
            $password = hash("sha256", $password);

            $data = array($username, $email, $password, $admin);

            // execute the sql statement
            $this->makeStatement($sql, $data);

            return true;
        }
        catch (Exception $e) {
            return false;
        }
    }

    /**
     * Checks if a set of username and password credentials are valid
     * @param string $username
     * @param string $password
     * @return bool
     * @throws Exception
     */
    protected function checkCredentials($username, $password)
    {
        // the sql statement to check for a user with the corresponding credentials
        // we select admin so that the inheriting AdminTable class can check it
        $sql = "SELECT admin 
                FROM users 
                WHERE (username = ? OR email = ?) AND password = ?";

        // hash the input password since that's how it is stored
        $password = hash("sha256", $password);

        $data = array($username, $username, $password);

        // execute the sql statement
        $statement = $this->makeStatement($sql, $data);

        // if the statement generated a result, then it is a valid credential
        if ($statement->rowCount() === 1) {
            return $statement;
        }
        // otherwise throw an exception
        else {
            throw new Exception("Login failed");
        }
    }

    /**
     * Returns the id corresponding to a username
     * @param string $username
     * @return int
     * @throws Exception
     */
    public function getUserId($username)
    {
        // the sql statement to get the user id
        $sql = "SELECT user_id
                FROM users
                WHERE (username = ? OR email = ?)";

        $data = array($username, $username);

        // execute the query and get the result
        $statement = $this->makeStatement($sql, $data);

        // the row count should be 1 if the user is found
        if ($statement->rowCount() === 1) {
            // return the id
            return $statement->fetchObject()->user_id;
        }
        else {
            throw new Exception("Invalid username");
        }
    }
}