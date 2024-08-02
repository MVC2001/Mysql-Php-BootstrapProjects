
if(isset($_POST[""])){
    $name =$_POST["name"];
     $email =$_POST["email"];
      $password =md5($_POST["password"]);
  
    $insert_role ="INSERT INTO users  (name,email,password)
      VALUES('$name','$email','$password');";

  if (mysqli_query($conn, $insert_role)) {

    echo "You have successfull registered";
   
  } else{
    echo "Wrong! registration";
  }
}
