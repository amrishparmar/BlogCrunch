<?php
include_once "Table.php";

/**
 * Class BlogEntryTable
 */
class BlogEntryTable extends Table
{
    /**
     * Saves an entry into the database with the given title and body text
     * @param string $title
     * @param string $entry
     * @return int
     */
    public function saveEntry($title, $entry, $author_id, $image_url)
    {
        // want to preserve new lines so convert new lines to <br>
        $entry = nl2br($entry);

        // the sql statement to insert the entry into the database
        $sql = "INSERT INTO blog_entry (entry_title, entry_text, entry_date, author_id, image_url)
                VALUES (?, ?, ?, ?, ?)";

        // take the title, body text and the current date/time and put into an array
        $data = array($title, $entry, date("Y-m-d H:i:s"), $author_id, $image_url);

        // execute the statement
        $this->makeStatement($sql, $data);
    }

    /**
     * Returns a list of all the blog entries in the database including the first 150 chars of the body text
     * @return PDOStatement
     */
    public function getAllEntries()
    {
        // the sql statement to get all of the entries from the database
        $sql = "SELECT blog_entry.id, blog_entry.entry_title, SUBSTRING(blog_entry.entry_text, 1, 150) AS intro, blog_entry.entry_date, blog_entry.image_url, users.username
                FROM blog_entry
                JOIN users
                ON blog_entry.author_id=users.user_id
                ORDER BY blog_entry.entry_date DESC";

        // execute the statement and get the result
        $retrieval_statement = $this->makeStatement($sql);

        // return the populated list of entries
        return $retrieval_statement;
    }

    /**
     * Returns a list of all blog entries by a particular person
     * @param string $username
     * @return PDOStatement
     */
    public function getNamedEntries($username)
    {
        // the sql statement to get all of the relevant entries from the database
        $sql = "SELECT blog_entry.id, blog_entry.entry_title, SUBSTRING(blog_entry.entry_text, 1, 150) AS intro, blog_entry.entry_date, blog_entry.image_url, users.username
                FROM blog_entry
                JOIN users
                ON blog_entry.author_id=users.user_id
                WHERE users.username = ?
                ORDER BY blog_entry.entry_date DESC";

        $data = array($username);

        // execute the statement and get the result
        $retrieval_statement = $this->makeStatement($sql, $data);

        // return the populated list of entries
        return $retrieval_statement;
    }

    /**
     * Returns a list of all blog entries matching the search terms
     * @param string $search_terms
     * @return PDOStatement
     */
    public function getSearchEntries($search_terms)
    {
        // ensure that the search terms are not empty or consist only of whitespace
        if (!empty($search_terms) and !ctype_space($search_terms)) {
            // create an array with all of the search tokens
            $search_words = explode(' ', $search_terms);

            // remove any words from the array that are empty
            foreach ($search_words as $word) {
                if (!empty($word)) {
                    // add % on each side of work so that we can use like keyword properly
                    $final_search_words[] = "%$word%";
                }
            }

            // create the array of strings with the SQL where statements
            foreach ($final_search_words as $word) {
                $where_list[] = "blog_entry.entry_title LIKE ?";
            }

            // put the list back together into one string separated by OR
            $where_clause = "WHERE " . implode(' OR ', $where_list);

            // the sql statement to get all of the relevant entries from the database
            $sql = "SELECT blog_entry.id, blog_entry.entry_title, SUBSTRING(blog_entry.entry_text, 1, 150) AS intro, blog_entry.entry_date, blog_entry.image_url, users.username
                FROM blog_entry
                JOIN users
                ON blog_entry.author_id=users.user_id $where_clause 
                ORDER BY blog_entry.entry_date DESC";

            // execute the sql statement and store the result
            $retrieval_statement = $this->makeStatement($sql, $final_search_words);

            return $retrieval_statement;
        }
        // else simply return all entries if the user didn't submit a valid term
        else {
            return $this->getAllEntries();
        }
    }

    /**
     * Returns the entry corresponding to the entry_id
     * @param int $entry_id
     * @return PDOStatement
     */
    public function getEntry($entry_id)
    {
        // the sql statement to get the entry from the database
        $sql = "SELECT blog_entry.id, blog_entry.entry_title, blog_entry.entry_text, blog_entry.entry_date, blog_entry.image_url, users.username
                FROM blog_entry
                JOIN users
                ON blog_entry.author_id=users.user_id
                WHERE id = ?";

        $data = array($entry_id);

        // execute the statement and get the result
        $retrieval_statement = $this->makeStatement($sql, $data);

        // get the entry from the result set
        $entry = $retrieval_statement->fetchObject();

        // return the entry
        return $entry;
    }

    /**
     * Deletes the entry corresponding to the entry_id
     * @param int $entry_id
     */
    public function deleteEntry($entry_id)
    {
        // the sql statement to delete the entry from the database
        $sql = "DELETE FROM blog_entry
                WHERE id = ?";

        $data = array($entry_id);

        // execute the statement
        $this->makeStatement($sql, $data);
    }

    /**
     * Updates an entry
     * @param int $entry_id
     * @param string $entry_title
     * @param string $entry_text
     * @param string $img_url
     * @return PDOStatement
     */
    public function updateEntry($entry_id, $entry_title, $entry_text, $img_url = "")
    {
        if ($img_url == "") {
            // the sql statement to update the entry in the database
            $sql = "UPDATE blog_entry
                    SET entry_title = ?, entry_text = ?
                    WHERE id = ?";

            $data = array($entry_title, $entry_text, $entry_id);
        }
        else {
            // the sql statement to update the entry in the database
            $sql = "UPDATE blog_entry
                    SET entry_title = ?, entry_text = ?, image_url = ?
                    WHERE id = ?";

            $data = array($entry_title, $entry_text, $img_url, $entry_id);
        }
        // execute the statement
        $this->makeStatement($sql, $data);
    }
}