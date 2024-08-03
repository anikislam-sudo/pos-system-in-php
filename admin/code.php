<?php 
include("../config/function.php");
if(isset($_POST["saveAdmin"])){
    $name=validate($_POST["name"]);
    $email=validate($_POST["email"]);
    $password=validate($_POST["password"]);
    $phone=validate($_POST["phone"]);
    $is_ban=isset($_POST["is_ban"])==true?1:0;

    if($name!='' && $email!='' && $password!=''){
    $emailCheck=mysqli_query($conn,"SELECT * FROM admins where email='$email'");
   if($emailCheck){
    if(mysqli_num_rows($emailCheck)> 0){
      redirect("admin-create.php","Email already used by another user.");
   }
}
   $bcryptPassword=password_hash($password, PASSWORD_BCRYPT);
   
    $data=[
     'name'=>$name,
     'email'=>$email,
     'password'=>$bcryptPassword,
     'phone'=>$phone,
     'is_ban'=>$is_ban,
    ];
    $result=insertData("admins",$data);
    if($result){
        redirect("admin.php","Admin Created Successfully!");
    }
    else{
        redirect("admin-create.php","Something Went Wrong");
    }
}
else{
        redirect('admin-create.php','please fill required fields.');
    }


}

 

?>