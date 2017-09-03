<?php
/**
 * A collection of helpful functions
 */

/**
 * Get the id corresponding to a username and then log the user in
 * @param UserSession $user_session
 * @param UserTable $user_table
 * @param string $username
 * @param bool $admin
 */
function getIdAndLogIn(&$user_session, &$user_table, $username, $admin)
{
    try {
        $user_id = $user_table->getUserId($username);
        $user_session->login($user_id, $username, $admin);
    }
    catch (Exception $e) {
        trigger_error($e->getMessage());
    }
}