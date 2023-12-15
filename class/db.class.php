<?php

  class db extends mysqli {
    private $host;
    private $username;
    private $passwd;
    private $dbname;

    function __construct($host='localhost', $username='u172854659_oei_user', $passwd='Oei2023*', $dbname='u172854659_oei') {
      $this->host = $host;
      $this->username = $username;
      $this->passwd = $passwd;
      $this->dbname = $dbname;
      parent::__construct($host, $username, $passwd, $dbname);
    }

    function getHost() {
      return $this->host;
    }

    function getUsername() {
      return $this->username;
    }

    function getPasswd() {
      return $this->passwd;
    }

    function getDbname() {
      return $this->dbname;
    }

    function setHost($host) {
      $this->host = $host;
    }

    function setUsername($username) {
      $this->username = $username;
    }

    function setPasswd($passwd) {
      $this->passwd = $passwd;
    }

    function setDbname($dbname) {
      $this->dbname = $dbname;
    }
  }
?>