<?php

/**
 * Class Table
 */
class Table
{
    /**
     * @var PDO
     */
    protected $db;

    /**
     * BlogEntryTable constructor.
     * @param PDO $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }
    
    /**
     * Prepares and executes the statement for retrieving entries from the database
     * @param string $sql
     * @param null|array $data
     * @return PDOStatement
     */
    protected function makeStatement($sql, $data = NULL)
    {
        // prepare the statement
        $statement = $this->db->prepare($sql);

        // execute the statement or trigger an error if something went wrong
        try {
            $statement->execute($data);
        }
        catch (Exception $e) {
            trigger_error("You tried to run this SQL query: $sql, Exception: ".$e->getMessage());
        }

        return $statement;
    }
}