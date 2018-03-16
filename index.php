<?php
    
    // Errors and requires
    error_reporting( E_ALL );
    ini_set('display_errors', '1');
    require('config.php');
    require('EngagingNetworksToken.php');

    // Use EngagingNetworksToken class
    $tokenInfo = new EngagingNetworksToken();
    $tokenInfo->getToken();
    
    // Prepare the output
    $output = array();
    $output['token'] = $tokenInfo->token;
    $output['source'] = $tokenInfo->tokenSource;
    
    // Output the token and the token source as a json
    $jsonResponse = json_encode( $output, JSON_PRETTY_PRINT );
    header('Content-Type: application/json');
    header("Access-Control-Allow-Origin: " . ALLOW_ORIGIN_HEADER );
    echo ( $jsonResponse );
    
?>