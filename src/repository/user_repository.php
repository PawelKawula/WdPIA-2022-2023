<?php

require_once 'repository.php';
require_once __DIR__.'/../models/user.php';
class UserRepository extends Repository {

    public function get_user(string $email): ?User {
        $arr = $this->database->query("SELECT * FROM users WHERE email=?", $email)->fetch_array();
        if (!$arr)
            return null;
        $user = new User($arr['email'], $arr['passwd']);
        $user_details_assoc = $this->database->query("SELECT * FROM users_details WHERE fk_users=?", $arr["id_user"])->fetch_array();
        if (!empty($user_details_assoc)) {
            $user->set_fname($user_details_assoc["fname"]);
            $user->set_lname($user_details_assoc["lname"]);
            $user->set_phone($user_details_assoc["phone"]);
        }
        return $user;
    }

    public function add_user(User $user): bool {
        $fname = strlen($user->get_fname()) ? $user->get_fname() : 'NULL';
        $lname = strlen($user->get_lname()) ? $user->get_lname() : 'NULL';
        $phone = strlen($user->get_phone()) ? $user->get_phone() : 'NULL';
        $email = $user->get_email();
        $passwd = $user->get_passwd();
        if (!boolval($this->database->query
            ("INSERT INTO users(email, passwd) VALUES(?, ?)",
                $email, $passwd)->affected_rows()
        )) {
            echo 'xd';
            return false;
        }
        if (!strcmp($fname,'NULL') or !strcmp($lname, 'NULL') or !strcmp($phone, 'NULL')) {
            return boolval($this->database->query(
                "INSERT INTO users_details(fk_users, fname, lname, phone) VALUES(?, ?, ?, ?)",
                $this->database->last_insert_ID(), $fname, $lname, $phone
            )->affected_rows());
        }
        return true;
    }
}
