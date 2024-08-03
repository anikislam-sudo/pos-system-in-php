<?php 
 session_start();

 require('dbcon.php');
 //input field validation
 function validate($inputData){
 global $conn;
 $validatedData = mysqli_real_escape_string($conn, $inputData);
 return trim($validatedData);

 }
//redirect from 1 page to another page with the message(status)
 function redirect($url,$status){
  $_SESSION['status'] = $status;
  header('Location: '.$url);
  exit(0);
 }

 //display any message or status after any process
 function alert(){
    if(isset($_SESSION['status'])){
    echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <h6>'.$_SESSION['status'].' </h6>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    unset($_SESSION['status']);

 }
 }

 //insert record using  this function

 function insertData($tableName,$data){  
  global $conn;
  $table=validate($tableName);
  $columns= array_keys($data);
  $values=array_values($data);

  $finalColumns=implode(',',$columns);
  $finalValues= "'".implode("','",$values)."'";

  $query="INSERT INTO $table($finalColumns)VALUES($finalValues)";
  $result=mysqli_query($conn,$query);
  return $result;	

   }

   //update data using this function

   function updateData($tableName,$data,$id){
    global $conn;
    $table=validate($tableName);
    $id=validate($id);
    $updateDataString="";

    foreach($data as $key=>$value){
        $updateDataString.=$key."=".$value."";
    }
    $finalupdateData=substr(trim($updateDataString),0,-1);

    $query="UPDATE $table SET $finalupdateData WHERE id='$id'";
    $result=mysqli_query($conn,$query);
    return $result;

   }

   //get all data using this funtion

   function getAllData($tableName,$status=null){

    global $conn;
    $table=validate($tableName);
    $status=validate($status);

    if($status == "status"){
        $query= "SELECT * from $table WHERE status='0'";
    }
    else{
        $query= "SELECT * from $table "; 
    }
  $result=mysqli_query($conn,$query);
  return $result;
   }

   //single id get using this function

   function getById( $tableName,$id){
    global $conn;
    $table=validate($tableName);
    $id=validate($id);
    $query= "SELECT * from $table where id='$id' limit 1";
    $result=mysqli_query($conn,$query);

    if(mysqli_num_rows($result)== 1){
        $row=mysqli_fetch_assoc($result);
        $response=[
            'status'=>200,
            'data'=>$row,
            'message'=>"Record found"
        ];
        return $response;
   }
   else {
    $response=[
        'status'=> 404,
        'message'=>"Not Found"
    ];
    return $response;
   } 
  return mysqli_query($conn,$query);
   
   }

   //delete data from database using this function

   function deleteId( $tableName,$id){
   global $conn;
   $table=validate($tableName);
   $id=validate($id);
   $query= "DELETE * from $table where id='$id' limit 1";
   $result=mysqli_query($conn,$query);
   return $result;
   }
?>