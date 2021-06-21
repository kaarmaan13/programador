<? include "php/conexion.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="es" lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Programador Aut&oacute;nomo en Madrid - Dise&ntilde;ador Web Freelance en Madrid :: Contacto</title>
<? include "includes/metas.php" ?>
<link href="css/estilos.css?v=1.1" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function enviar() {
	// Nombre
	if (document.getElementById('formu').nombre.value=='') {
		alert('Por favor, verifique los datos introducidos en el campo \"Nombre"\ ');
		document.getElementById('formu').nombre.focus();
		return;
	}
	// E-mail
	if (document.getElementById('formu').email.value == '') {
		alert('Por favor, verifique los datos introducidos en el campo \"E-mail"\ ');
		document.getElementById('formu').email.focus();
		return;
	}	
	for (var i=0;i!=document.getElementById('formu').email.value.length;i++) 
		if(document.getElementById('formu').email.value.charAt(i)!=' ') 
			{ valido = true; }
	if ( (document.getElementById('formu').email.value.indexOf('@') == -1) || (document.getElementById('formu').email.value.indexOf('.') == -1) ) {
		alert('Por favor, verifique los datos introducidos en el campo \"E-mail"\ ');
		document.getElementById('formu').email.focus();	
		return;
	}
	if ( (document.getElementById('formu').email.value.indexOf('@')) > (document.getElementById('formu').email.value.indexOf('.')) ) {
		alert('Por favor, verifique los datos introducidos en el campo \"E-mail"\ ');
		document.getElementById('formu').email.focus();	
		return;
	}
	if (valido == false) {
		alert('Por favor, verifique los datos introducidos en el campo \"E-mail"\ ');
		document.getElementById('formu').email.focus();	
		return;
	}
	// Teléfono
	if (document.getElementById('formu').telefono.value!='')
		if ( (document.getElementById('formu').telefono.value.length!=9) || isNaN(document.getElementById('formu').telefono.value) ) {
			alert('Por favor, verifique los datos introducidos en el campo \"Teléfono"\ ');
			document.getElementById('formu').telefono.focus();
			return;		
	}
	// Consulta
	if (document.getElementById('formu').consulta.value == '') {
		alert('Por favor, verifique los datos introducidos en el campo \"Consulta"\ ');
		document.getElementById('formu').consulta.focus();
		return;
	}
	if(grecaptcha.getResponse().length == 0){
		alert('Por favor, verifique que \"No soy un robot"\ ');
		return;	
	}
	
	document.getElementById('formu').submit();
}
</script>
</head>
<body>
	<div id="cont">
<? include "includes/superior.php" ?>
        <ul id="menu">
            <li class="home"><a href="index.php"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="portfolio"><a href="portfolio.php"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="clientes"><a href="clientes.php"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="servicios"><a href="servicios.php"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="aplicacionesweb"><a href="aplicacionesweb.php"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="contacto"><a href="contacto.php" class="activo"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="sep"><img src="images/sizer.gif" alt="" width="1" height="1" /></li>
        </ul>
        <div id="logo"><a href="index.php"><img src="images/logo.gif" alt="Programador Autónomo" /></a></div>
		<div id="contenido">
           	<h1><img src="images/contacto.gif" alt="contacto" /></h1>
			<div class="formulario">
            	<form id="formu" method="post" action="enviocontacto.php">
                <label for="verificacion" class="verif">¡Si ves esto, no llenes el siguiente campo!</label>
                <input name="verificacion" class="verif" />
            	<div class="col1">Nombre</div><div class="col2"><input type="text" name="nombre" value="" /></div>
            	<div class="col1">Empresa (opcional)</div><div class="col2"><input type="text" name="empresa" value="" /></div>
            	<div class="col1">Teléfono</div><div class="col2"><input type="text" name="telefono" value="" /></div>
            	<div class="col1">E-mail</div><div class="col2"><input type="text" name="email" value="" /></div>
            	<div class="col1">Consulta</div><div class="col2"><textarea name="consulta" cols="40" rows="10"></textarea></div>
                <div class="g-recaptcha" data-sitekey="6LeNCpsUAAAAAKVzZAoIHD4G0UqprvbAbb0a3tHv"></div>
                <div class="boton"><br class="sep" /><a href="javascript:enviar()">ENVIAR</a></div>
                </form>
                <script src='https://www.google.com/recaptcha/api.js?hl=es'></script>
            </div>
            <div class="datos">
            	<br /><br />
            	<img src="images/mapamundo.gif" alt="Mapa Mundi" />
                <br /><br /><br />
                Teléfono de contacto: <strong>637 22 51 51</strong><br /><br />
                E-mail: <strong><a href="mailto:info@programadorautonomo.com">info@programadorautonomo.com</a></strong>
            </div>
            <br class="sep" />
		</div>
<? include "includes/inferior.php" ?>
	</div>
<? include "includes/googleanalytics.php" ?>
</body>
</html>
<? include "php/desconexion.php" ?>