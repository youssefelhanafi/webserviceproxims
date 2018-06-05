<?php 
 
require_once '../includes/DbLocaOperations.php';
 
$response = array(); 
 
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(
        isset($_POST['latidude']) and
            isset($_POST['longtitude']) )
        {
        //operate the data further 
        	//$response['error'] = true;
        	//$response['message'] = "GOOOD JOB : ".$_POST['latidude'].",".$_POST['longtitude']." : Your localisation";
        	
        $db = new DbLocaOperations();
        $result = $db->insertLocalisation($_POST['latidude'],$_POST['longtitude']);
 		/*
        $db = new DbOperations(); 
 
        $result = $db->createUser(   $_POST['username'],
                                    $_POST['password'],
                                    $_POST['email'],
                                    $_POST['firstname'],
                                    $_POST['lastname'],
                                    $_POST['address'],
                                    $_POST['birthdate'],
                                    $_POST['phone']
                                );
            */                    
        if($result == 1){
            $response['error'] = false; 
            $response['message'] = "User registered successfully";
        }elseif($result == 2){
            $response['error'] = true; 
            $response['message'] = "Some error occurred please try again";          
        }elseif($result == 0){
            $response['error'] = true; 
            $response['message'] = "It seems you are already registered, please choose a different email and username";                     
        }
 		
    }else{
        $response['error'] = true; 
        $response['message'] = "Required fields are missing";
    }
}else{
    $response['error'] = true; 
    $response['message'] = "Invalid Request";
}
 
echo json_encode($response);