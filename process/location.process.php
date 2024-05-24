<?php
  header('Content-Type: application/json');
  // header('Access-Control-Allow-Origin: http://localhost');

  require_once("../class/db.class.php");
  require_once("../class/locationDAO.php");

  $method = htmlspecialchars( $_REQUEST['method'], ENT_QUOTES );

  switch ( $method ) {
    case 'getCountries':
      # code...
      $locationDAO = new locationDAO();
      $response = $locationDAO -> getCountries();
      
      if ( $response )
        $data = array();

        for ($i = 0 ; $row = $response -> fetch_object(); $i++) {
          $data[$i] = $row;
        }

        echo json_encode( $data );

    break;
   
    case 'getStates':
      # code...
      $country = filter_input(INPUT_GET, "country", FILTER_VALIDATE_INT);

      $locationDAO = new locationDAO();
      $response = $locationDAO -> getStates( $country );
      
      if ( $response )
        $data = array();

        for ($i = 0 ; $row = $response -> fetch_object(); $i++) {
          $data[$i] = $row;
        }

        echo json_encode( $data );

      break;

    case 'getCities':
      # code...
      $state = filter_input(INPUT_GET, "state", FILTER_VALIDATE_INT);

      $locationDAO = new locationDAO();
      $response = $locationDAO -> getCities( $state );
      
      if ( $response )
        $data = array();

        for ($i = 0 ; $row = $response -> fetch_object(); $i++) {
          $data[$i] = $row;
        }

        echo json_encode( $data );

      break;
  }
?>