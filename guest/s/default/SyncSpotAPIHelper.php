<?php
namespace SyncSpot;

include 'config.php'; // $config
include 'db.php'; // $mysqli

if (!isset($_SESSION)) {
    session_start();
}

/**
 *
 */
class SyncSpotAPIHelper
{
    private $mysqli_connection;

    public function __construct()
    {
        global $config;
        global $mysqli;
        $this->mysqli_connection = $mysqli;
    }

    private function user_register()
    {
    }

    private function getUserByLoginAndPassword($login, $password_hash)
    {
      $user = array();
      $email = filter_var($email, FILTER_SANITIZE_EMAIL);
      $query = $this->mysqli_connection->prepare("SELECT id, name, surname, email, phone, identity_number FROM user WHERE (email = ? OR phone = ? OR username = ?) AND password_hash = ?");
      $query->bind_param("ssss", $login, $login, $login, $password_hash);
      $query->execute();
      $result = $query->get_result();
      if ($result->num_rows === 1) {
          while ($row = $result->fetch_assoc()) {
            $user = $row;
          }
      }
      return $user;
    }
}
