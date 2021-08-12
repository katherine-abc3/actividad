<?php
require_once('Connect.php');

class User {

  protected $connect;
  private $id;
  public $email;
  protected $password;

  public function __construct()
  {
  session_start(); 
  }
  public function registrar($email,$password)
    {
        $conn = new Connect();
        $connect = $conn->init();
        $query = $connect->prepare("SELECT * FROM user WHERE email = :email AND password = :password");
        $query->bindParam(":email", $email);
        $query->bindParam(":password", $password);
        $query->execute();
        $usuario = $query->fetch(PDO::FETCH_ASSOC);
        if ($usuario) {
            $_SESSION['email'] = $usuario["email"];
   header("location:http://localhost/clases_php/actividad/inicio.php");
        } else {
            $msg = "Email o contraseña ingresados no validos";
            $aPahtOrigin = explode('?', $_SERVER['HTTP_REFERER']);
            $pahtOrigin = $aPahtOrigin[0];
            header("Location: $pahtOrigin?msg=$msg");
        }
  }
    function sessionexit(){
        session_unset();
        session_destroy();
        header("location:http://localhost/clases_php/actividad/login.php");
    }

}
?> 