<?php
include_once "Table.php";

/**
 * Class CommentsTable
 */
class CommentsTable extends Table
{
    /**
     * Saves a comment to the database
     * @param int $post_id
     * @param int $user_id
     * @param string $content
     */
    public function saveComment($post_id, $user_id, $content)
    {
        // add lines breaks to preserve any new lines
        $content = nl2br($content);

        // the sql statement to insert the comment into database
        $sql = "INSERT INTO comments (post_id, user_id, comment, date_posted)
                VALUES (?, ?, ?, ?)";

        $data = array($post_id, $user_id, $content, date("Y-m-d h:i:s"));

        // execute the statement
        $this->makeStatement($sql, $data);
    }

    /**
     * Gets a list of all comments on a given blog post
     * @param int $post_id
     * @return PDOStatement
     */
    public function getAllComments($post_id)
    {
        // the sql statement to get all of the comments from the database with the current post id (requires table join to get username
        $sql = "SELECT comments.user_id AS user_id, comments.comment AS comment, comments.date_posted AS date_posted, users.username AS username
                FROM comments
                JOIN users
                ON comments.user_id = users.user_id
                WHERE comments.post_id = ?";

        $data = array($post_id);

        // execute the statement and get the result
        $retrieval_statement = $this->makeStatement($sql, $data);

        // return the populated list of comments
        return $retrieval_statement;
    }
}