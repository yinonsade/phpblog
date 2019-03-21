<?php

require_once 'db_config.php';

if (!function_exists('db_connect')) {

    /**
     *
     * Set up connection to mysql db.
     *
     * @return null
     *
     */
    function db_connect()
    {
        global $mysql_link;
        $mysql_link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
        mysqli_query($mysql_link, "SET NAMES utf8");
        // option 2:  mysqli_set_charset($mysql_link, 'utf8');
    }

}

if (!function_exists('db_check_connection')) {
    /**
     *
     * Check if php connect to mysql.
     *
     * @return null
     *
     */
    function db_check_connection()
    {
        global $mysql_link;
        if (is_null($mysql_link)) {
            db_connect();
        }
    }
}

if (!function_exists('db_insert')) {
    /**
     *
     * Execute insert query to mysql.
     *
     * @param $query (string) The insert query
     *
     * @return int number of affected rows after insert
     *
     */
    function db_insert($query, $last_id = false)
    {
        global $mysql_link;
        db_check_connection();
        $result = mysqli_query($mysql_link, $query);
        return $last_id ? mysqli_insert_id($mysql_link) : mysqli_affected_rows($mysql_link);

    }
}

if (!function_exists('db_delete')) {

    /**
     *
     * Execute delete query to mysql.
     *
     * @param $query (string) The delete query
     *
     * @return int number of affected rows after delete
     *
     */
    function db_delete($query)
    {
        global $mysql_link;
        db_check_connection();
        $result = mysqli_query($mysql_link, $query);
        return mysqli_affected_rows($mysql_link);
    }

}

if (!function_exists('db_update')) {

    /**
     *
     * Execute update query to mysql.
     *
     * @param $query (string) The update query
     *
     * @return int number of affected rows after update
     *
     */
    function db_update($query)
    {
        global $mysql_link;
        db_check_connection();
        $result = mysqli_query($mysql_link, $query);
        return mysqli_affected_rows($mysql_link);
    }

}

if (!function_exists('db_query_row')) {
    /**
     *
     * Get row from mysql by query.
     *
     * @param $query (string) The select query
     *
     * @return array|false Get row as an associative array
     *
     */
    function db_query_row($query)
    {
        global $mysql_link;
        db_check_connection();
        $result = mysqli_query($mysql_link, $query);

        if ($result && mysqli_num_rows($result) == 1) {

            return mysqli_fetch_assoc($result);

        } else {
            return false;
        }

    }
}

if (!function_exists('db_query_all')) {
    /**
     *
     * Get rows from mysql by query.
     *
     * @param $query (string) The select query
     *
     * @return array Get all rows as an associative array
     *
     */
    function db_query_all($query)
    {
        global $mysql_link;
        db_check_connection();
        $data = [];

        $result = mysqli_query($mysql_link, $query);

        if ($result && mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

        }

        return $data;

    }
}

if (!function_exists('old')) {
    /**
     *
     * Restore input value to a field.
     *
     * @param $fn (string) The field name
     *
     * @return string The old input value
     *
     */
    function old($fn)
    {
        return $_REQUEST[$fn] ?? '';
    }
}

if (!function_exists('csrf_token')) {
    /**
     *
     * Generate a csrf token.
     *
     * @return string The csrf token
     *
     */
    function csrf_token()
    {
        $token = sha1('$$$digg' . rand(1, 1000) . 'foo$$');
        $_SESSION['token'] = $token;
        return $token;
    }
}

if (!function_exists('display_output')) {

    /**
     *
     * Prepare the string to displayed.
     *
     * @param $str (string) The input string
     *
     * @return string The result output
     *
     */
    function display_output($str)
    {
        $str = htmlspecialchars($str);
        $str = str_replace("\n", '<br>', $str);
        if (preg_match("/[א-ת]/", $str)) {
            $str = '<span dir="rtl" class="float-right">' . $str . '</span><div class="clearfix"></div>';
        }
        return $str;
    }

}

if (!function_exists('start_session')) {

    /**
     *
     * My session start.
     *
     * @param [$name] (string) The session name
     *
     * @return null
     *
     */
    function start_session($name = null)
    {
        if (!is_null($name)) {
            session_name($name);
        }

        session_start();
        session_regenerate_id();

    }

}

if (!function_exists('verify_user')) {

    /**
     *
     * Verify user by id and ip and user agent.
     *
     *
     * @return boolean
     *
     */
    function verify_user()
    {

        $verify = false;

        if (isset($_SESSION['user_id'])) {

            if (isset($_SESSION['user_ip']) && $_SERVER['REMOTE_ADDR'] === $_SESSION['user_ip']) {

                if (isset($_SESSION['user_agent']) && $_SERVER['HTTP_USER_AGENT'] === $_SESSION['user_agent']) {
                    $verify = true;
                }

            }

        }

        return $verify;

    }

}

if (!function_exists('youtuber')) {
    /**
     *
     * Verify that valid youtube addresss.
     *
     *@param  url
     *
     * @return boolean
     *
     */
    function youtuber($check)
    {
        $youtube_pattern = "#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#";
        return preg_match_all($youtube_pattern, $check);
    }
}