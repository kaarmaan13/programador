<?php
// grab recaptcha library
require_once "includes/recaptchalib.php";

if(($_REQUEST["nombre"] != "") && (!is_numeric($_REQUEST["nombre"])) && ($_REQUEST["email"] != "") && ($_POST['verificacion'] == "") && ($response != null && $response->success)) {
	$nombre=$_REQUEST["nombre"];
	$empresa=$_REQUEST["empresa"];
	$telefono=$_REQUEST["telefono"];
	$email=$_REQUEST["email"];
	$consulta=$_REQUEST["consulta"];
	
	$encabezado = "From: $nombre <$email>";
	$encabezado .= "\nReply-To: $email";
	$encabezado .= "\nX-Mailer: PHP/" . phpversion();
	
	$para = "info@programadorautonomo.com";
	$sujeto = "Correo enviado desde página web www.programadorautonomo.com";
	$mensaje = "Nombre: $nombre\n";
	$mensaje .= "Empresa: $empresa\n";
	$mensaje .= "Telefono: $telefono\n";
	$mensaje .= "Email: $email\n";
	$mensaje .= "Consulta: $consulta"; 
	$respuesta = "contacto_ok.php";
	
	if(!mail($para, $sujeto, $mensaje, $encabezado)) {
	   echo "<h1>No se pudo enviar el Mensaje</h1>";
	   exit();
	} else {
		/* aqui redireccionamos a la pagina de respuesta */
	   echo "<meta HTTP-EQUIV='refresh' content='1;url=$respuesta'>";
	}
} else {
   echo "<meta HTTP-EQUIV='refresh' content='1;url=contacto.php'>";
}
?>
