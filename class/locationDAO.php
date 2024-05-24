<?php
class locationDAO extends db {

  function __construct() {
    parent::__construct();
  }

  public function getCountryById(int $_id) {
    $sql = "SELECT * FROM country WHERE _id = $_id";
    $query = $this -> query($sql);

    if ( mysqli_num_rows( $query ) > 0 ) return $query;

    return false;
  }

  public function getStateById(int $_id) {
    $sql = "SELECT * FROM state WHERE _id = $_id";
    $query = $this -> query($sql);

    if ( mysqli_num_rows( $query ) > 0 ) return $query;

    return false;
  }

  public function getCountries(): bool | mysqli_result {
    $sql = "SELECT * FROM country WHERE status = 1 ORDER BY _id DESC";
    $query = $this -> query($sql);

    if ( mysqli_num_rows( $query ) > 0 ) return $query;

    return false;
  }

  public function getStates( int $country ): bool | mysqli_result {
    $sql = "SELECT * FROM state WHERE country = $country ORDER BY _id DESC";
    $query = $this -> query($sql);

    if ( mysqli_num_rows( $query ) > 0 ) return $query;

    return false;
  }

  public function getCities( int $state ): bool | mysqli_result {
    $sql = "SELECT * FROM city WHERE state = $state ORDER BY _id DESC";
    $query = $this -> query($sql);

    if ( mysqli_num_rows( $query ) > 0 ) return $query;

    return $this -> getStateById( $state );
  }
}