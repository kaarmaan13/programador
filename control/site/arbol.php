<link href="includes/dtree/dtree.css" type="text/css" rel="stylesheet" />
<script src="includes/dtree/dtree.js" type="text/javascript"></script>
<script type="text/javascript">
	function eliminar(id) {
		if (id!=0) {
			var answer = confirm ("Se va a proceder a eliminar una carpeta.¿Está seguro?") 
			if (answer)
				window.location.href="?site=arbol&accionfin=eliminar&id="+id+"&accion=eliminar_seccion&action=custom";
		}
		else
			alert('La carpeta raíz no se puede eliminar');
	}

	var volver="<br /><br /><a href='javascript:ayuda()'>volver</a>";

	function ayuda(i) {
		switch (i) {
			case 0: document.getElementById('textoayuda').innerHTML="Introduzca con un número la posici&aacute;n en el menú del elemento que está introduciendo.<br /><br /><b>Este campo es obligatorio</b>."+volver;
					break;
			case 1: document.getElementById('textoayuda').innerHTML="Introduzca el nombre de la secci&aacute;n/subsecci&aacute;n que va a introducir.<br /><br /><b>Este campo es obligatorio</b>."+volver;
					break;
			case 2: document.getElementById('textoayuda').innerHTML="Introduzca, si procede el nombre en inglés de la secci&aacute;n/subsecci&aacute;n que va a introducir."+volver;
					break;
			case 3: document.getElementById('textoayuda').innerHTML="Marque esta casilla si desea que este apartado sea <strong>destacado</strong>. Con esto conseguirá que este apartado se vea resaltado en negrita en la web, diferenciado con respecto al resto. Para que se vea con una fuente normal, déjelo sin marcar."+volver;
					break;
			case 4: document.getElementById('textoayuda').innerHTML="Propiedades para Google Maps."+volver;
					break;
			default: document.getElementById('textoayuda').innerHTML="Desde aqu&iacute; puede a&ntilde;adir contenidos a las secciones/ subsecciones del Árbol de Contenidos.<br /><br />En la parte superior, con el lema \"Está  en...\", aparece la ruta d&aacute;nde se encuentra. Las barras \"/\" marcan la relaci&aacute;n entre padres e hijas, y la secci&aacute;n/ subsecci&aacute;n padre actual aparece al final de la cadena.<br /><br />La nueva secci&aacute;n se creará como hija de la que aparece al final de la cadena.<br /><br />Una vez cumplimentados los datos, pulse el bot&aacute;n <strong>A&ntilde;adir secci&aacute;n/subsecci&aacute;n</strong>.<br /><br />Si tiene dudas sobre el funcionamiento de alg&uacute;n elemento, pulse el bot&aacute;n de Ayuda correspondiente.";
		}
	}
	
	function enviar() {
		/* Nombre sección/subsección */
		if (document.getElementById('formu').nombre.value == '') {
			alert('Por favor, compruebe que los datos introducidos en el campo \'Nombre sección/subsección\' son correctos');
			document.getElementById('formu').nombre.focus();
			return;
		}
		/* Posición */
		if ((isNaN(document.getElementById('formu').posicion.value)) || (document.getElementById('formu').posicion.value == '')) {
			alert('Por favor, introduzca sólo números en el campo \'Posición\'');
			document.getElementById('formu').posicion.focus();
			return;
		}
		/* Destacado */
		if (document.getElementById('formu').ch_destacado.checked) document.getElementById('formu').destacado.value="1";
		else document.getElementById('formu').destacado.value="0";

		document.getElementById('formu').submit();
	}
</script>

<!-- PREVIA_SECCIÓN o DATOS DEL ÁRBOL -->
<? if($_GET["site2"] == "") { ?>
	<!-- contenido -->
	<div class="esta">Está en: <strong>Árbol de Contenidos / <? echo $_GET["titlecontent"] ?><? if($accion=="aniadir_seccion") echo "Añadir sección/subsección"; if($accion=="modificar_seccion") echo "Modificar sección/subsección"; if($accion=="eliminar_seccion") echo "Eliminar sección/subsección"; ?></strong></div>
	<div id="contenido">
<?
	// INTRODUCIR
	if ((isset($accionfin)) && ($accionfin=="guardar")) {
		$result=mysql_query("SELECT * FROM arbol WHERE nombre='$nombre'");
		$row=mysql_fetch_row($result);
		$result=mysql_query("SELECT MAX(nodo) FROM arbol");
		$row=mysql_fetch_row($result);
		$nodo=$row[0]+1;
		$result=mysql_query("INSERT INTO arbol (nodo,padre,nombre,nombreE,destacado,onLoad,onUnload,posicion) VALUES ($nodo,$padre,'$nombre','$nombreE',$destacado,'$onLoad','$onUnload',$posicion) ");
		$ultimo_id=mysql_insert_id();
		$nombre='';
		echo"<div class=\"ok\">Los datos han sido guardados</div>";		
	}
	// MODIFICAR
	if ((isset($accionfin)) && ($accionfin=="modificar")) {
		$result=mysql_query("UPDATE arbol SET padre=$padre, nombre='$nombre', nombreE='$nombreE', destacado=$destacado, onLoad='$onLoad', onUnload='$onUnload', posicion=$posicion WHERE nodo=$nodo");
		echo"<div class=\"ok\">Los datos han sido guardados</div>";
	}
	// ELIMINAR
	if ((isset($accionfin)) && ($accionfin=="eliminar")) {
		// Comprobamos que la sección que vamos a eliminar no tenga ninguna sección hija o archivo
		$result=mysql_query("SELECT * FROM arbol WHERE padre = $id");
		if(mysql_num_rows($result) != 0)
			echo"<div class=\"error\">La eliminación no se ha llevado a cabo.<br /><br />Antes de eliminar una carpeta, debe eliminar todas las carpetas y archivos que pertenezcan a ella.</div>";
		else {
			$result=mysql_query("DELETE FROM arbol WHERE nodo = $id");
			echo"<div class=\"ok\">Los datos han sido eliminados</div>";
		}
	}

	// Seleccionamos los archivos del árbol
	$result=mysql_query("SELECT * FROM arbol");
	if (mysql_num_rows($result) == 0) {
		// Hay que añadir sección padre
		$result=mysql_query("INSERT INTO arbol (nodo,padre,nombre,nombreE,destacado) VALUES (0,-1,'ÁRBOL DE CONTENIDOS','CONTENTS TREE',0) ");
		$ultimo_id=mysql_insert_id();
	}
	
	// Seleccionamos los archivos del cliente
	$result=mysql_query("SELECT * FROM arbol ORDER BY posicion");
?>
		<!-- Árbol de contenidos -->
		<div class="dtree">
			<script type="text/javascript">
				<!--
				d = new dTree('d');
<?
		while($row=mysql_fetch_row($result)) {
			// Añadir, modificar o eliminar secciones
			if(($accion=="aniadir_seccion") || ($accion=="modificar_seccion")) {
				if($row["4"]==1) echo"d.add($row[0],$row[1],'$row[2]','index.php?site=arbol&site2=$_REQUEST[accion]&id=$row[0]&action=custom&titlecontent=$_REQUEST[titlecontent]','','','images/folder.gif','images/folderopen.gif','images/destacado.gif');";
				else echo"d.add($row[0],$row[1],'$row[2]','index.php?site=arbol&site2=$accion&id=$row[0]&action=custom&titlecontent=$_REQUEST[titlecontent]','','','images/folder.gif','images/folderopen.gif','images/sizer.gif');";
			}
			else if($accion=="eliminar_seccion") {
				if($row["4"]==1) echo"d.add($row[0],$row[1],'$row[2]','javascript:eliminar($row[0])','','','images/folder.gif','images/folderopen.gif','images/destacado.gif');";
				else echo"d.add($row[0],$row[1],'$row[2]','javascript:eliminar($row[0])','','','images/folder.gif','images/folderopen.gif','images/sizer.gif');";
			}
			else {
				if($accion=="") { 
					if($row["4"]==1) echo"d.add($row[0],$row[1],'$row[2]','index.php?site=arbol&site2=$_REQUEST[accion]&nodo=$row[0]&action=insert&titlecontent=$_REQUEST[titlecontent]','','','images/folder.gif','images/folderopen.gif','images/destacado.gif');";
					else echo"d.add($row[0],$row[1],'$row[2]','index.php?site=arbol&site2=$_REQUEST[accion]&nodo=$row[0]&action=insert&titlecontent=$_REQUEST[titlecontent]','','','images/folder.gif','images/folderopen.gif','images/sizer.gif');";
				}
				// Introducir datos del árbol
				else {
					if($row["4"]==1) echo"d.add($row[0],$row[1],'$row[2]','index.php?site=$_REQUEST[accion]&nodo=$row[0]&action=$_REQUEST[action]&titlecontent=$_REQUEST[titlecontent]','','','images/folder.gif','images/folderopen.gif','images/destacado.gif');";
					else echo"d.add($row[0],$row[1],'$row[2]','index.php?site=$_REQUEST[accion]&nodo=$row[0]&action=$_REQUEST[action]&titlecontent=$_REQUEST[titlecontent]','','','images/folder.gif','images/folderopen.gif','images/sizer.gif');";
				}
			}
		}
?>
				document.write(d);
		
				//-->
			</script>		
			<p style="background-image:url(images/sizer.gif);font-size:11px;font-weight:normal"><a href="javascript: d.openAll();">Abrir todos</a> | <a href="javascript: d.closeAll();">Cerrar todos</a></p>			
		</div>
		<!-- /Árbol de contenidos -->
	</div>
	<div id="ayuda">
		<div class="encab">Ayuda de Árbol de contenidos</div>
			<!-- Árbol de contenidos -->
			<? if($_REQUEST["titlecontent"] == "") { ?>
		<div id="textoayuda"><div style='font-weight:normal'></div>
		<script type="text/javascript">ayuda();</script>
			<!-- Datos del Árbol -->
			<? } else { ?>
		<div id="textoayuda"><div style="font-weight:normal">Desde aqu&iacute; puede <strong><? echo $_REQUEST["titlecontent"] ?></strong> asociados al Árbol de Contenidos.<br /><br />Seleccione la sección del Árbol para la que desea <strong><? echo $_REQUEST["titlecontent"] ?></strong> y se le llevará a una pantalla donde podrá hacerlo.<br /><br />Pulse el botón <strong>Abrir todos</strong> para desplegar todo el árbol de contenidos, y <strong>Cerrar todos</strong> para replegarlo de nuevo. Puede desplegar y replegar secciones en particular pulsando sobre los iconos <strong>+</strong> y <strong>-</strong> correspondientes.</div>
			<? } ?>

		</div>
	</div>
<? } ?>

<!-- ANIADIR_SECCIÓN -->
<? if($_GET["site2"] == "aniadir_seccion") { ?>
	<!-- contenido -->
	<div class="esta">Está en: <strong>Árbol de contenidos / Añadir sección/subsección</strong></div>
	<div id="contenido">
		<div class="info">Campo obligatorio <img src="images/obligatorio.gif" alt="" /><br />Campo opcional <img src="images/opcional.gif" alt="" /></div>
<?
	// Mostramos la ruta a los datos
	$result=mysql_query("SELECT * FROM arbol where nodo=$_GET[id]");
	$row=mysql_fetch_array($result);
	$cadena=$row['nombre'];
	while($row['padre']!=-1) {
		$result=mysql_query("SELECT * FROM arbol WHERE nodo=".$row['padre']);
		$row=mysql_fetch_array($result);
		$cadena=$row['nombre']." / ".$cadena;
	}

	echo"<div class=\"estaen\"><strong>Est&aacute; usted en:</strong> ".$cadena."</div>";

	// Mostramos la ruta a los datos
	$result=mysql_query("SELECT * FROM arbol WHERE nodo=$id");
	$row=mysql_fetch_array($result);
?>
		<form id="formu" method="post" action="index.php?site=arbol&accionfin=guardar&accion=aniadir_seccion&action=custom" enctype="multipart/form-data"><br />
			<input type="hidden" name="bloqueado" value="0" />
			<input type="hidden" name="padre" value="<? echo $id ?>" />
			<div class="sep"><img src="images/sizer.gif" alt="" /></div>
			<p class="obligatorio">Nombre sección/subsección:</p><p class="ayuda"><a tabindex="100" href="javascript:ayuda(1)"><img src="images/ayuda.gif" alt="Ayuda" /></a></p><input type="text" name="nombre" size="60" value="<? if(isset($nombre)) echo $nombre; ?>" /><div class="seppuntos"><img src="images/sizer.gif" alt="" /></div>
<!--			<p><strong>Nombre sección/subsección <img src="images/en.gif" alt="" style="margin:0px 5px 0px 5px" />:</strong></p><p class="ayuda"><a tabindex="100" href="javascript:ayuda(2)"><img src="images/ayuda.gif" alt="Ayuda" /></a></p><input type="text" name="nombreE" size="60" value="<? if(isset($nombreE))echo $nombreE ?>" /><div class="seppuntos"><img src="images/sizer.gif" alt="" /></div>-->
			<input type="hidden" name="destacado" value="<? echo $destacado; ?>" />
			<p class="obligatorio">Posición:</p><p class="ayuda"><a tabindex="100" href="javascript:ayuda(0)"><img src="images/ayuda.gif" alt="Ayuda" /></a></p><input type="text" name="posicion" size="30" value="<? if(isset($posicion)) echo $posicion; ?>" maxlength="10" /><div class="seppuntos"><img src="images/sizer.gif" alt="" /></div>
			<p>Destacado:</p><p class="ayuda"><a tabindex="100" href="javascript:ayuda(3)"><img src="images/ayuda.gif" alt="Ayuda" /></a></p><input type="checkbox" name="ch_destacado" <? if($destacado==1) echo "checked" ?> style="border:0px" /><div class="seppuntos"><img src="images/sizer.gif" alt="" /></div>
			<p>onLoad</p><p class="ayuda"><a tabindex="100" href="javascript:ayuda(4)"><img src="images/ayuda.gif" alt="Ayuda" /></a></p><input type="text" name="onLoad" size="60" value="<? if(isset($onLoad))echo $onLoad ?>" /><div class="seppuntos"><img src="images/sizer.gif" alt="" /></div>
			<p>onUnload</p><p class="ayuda"><a tabindex="100" href="javascript:ayuda(4)"><img src="images/ayuda.gif" alt="Ayuda" /></a></p><input type="text" name="onUnload" size="60" value="<? if(isset($onUnload))echo $onUnload ?>" /><div class="seppuntos"><img src="images/sizer.gif" alt="" /></div>
			<div class="fondointro"><input type="button" name="Submit" onclick="javascript:enviar();" value="Añadir sección/subsección" /></div>
		</form>
	</div>
	<!-- /contenido -->
	<!-- ayuda -->
	<div id="ayuda">
		<div class="encab">Ayuda de Árbol de contenidos</div>
		<div id="textoayuda"><div style='font-weight:normal'></div>
		<script type="text/javascript">ayuda();</script>
	</div>
	<!-- /ayuda -->
<? } ?>

<!-- MODIFICAR_SECCIÓN -->
<? if($_GET["site2"] == "modificar_seccion") { ?>
	<!-- contenido -->
	<div class="esta">Está en: <strong>Árbol de contenidos / Modificar sección/subsección</strong></div>
	<div id="contenido">
		<div class="info">Campo obligatorio <img src="images/obligatorio.gif" alt="" /><br />Campo opcional <img src="images/opcional.gif" alt="" /></div>
<?
	// Mostramos la ruta a los datos
	$result=mysql_query("SELECT * FROM arbol where nodo=$id");
	$row=mysql_fetch_array($result);
	$cadena=$row['nombre'];
	while($row['padre']!=-1) {
		$result=mysql_query("SELECT * FROM arbol WHERE nodo=".$row['padre']);
		$row=mysql_fetch_array($result);
		$cadena=$row['nombre']." / ".$cadena;
	}

	echo"<div class=\"estaen\"><strong>Est&aacute; usted en:</strong> ".$cadena."</div>";
	
	// Mostramos los datos
	$result=mysql_query("SELECT * FROM arbol where nodo=$id");
	$row=mysql_fetch_array($result);
?>
	<form id="formu" method="post" action="index.php?site=arbol&accionfin=modificar&accion=modificar_seccion&action=custom" enctype="multipart/form-data">
		<input type="hidden" name="bloqueado" value="0" />
		<input type="hidden" name="nodo" value="<? echo $id ?>" />
		<input type="hidden" name="padre" value="<? echo $row["padre"] ?>" />
		<p class="obligatorio">Nombre secci&aacute;n/subsecci&aacute;n:</p><p class="ayuda"><a tabindex="100" href="javascript:ayuda(1)"><img src="images/ayuda.gif" alt="Ayuda" /></a></p><div class="sep"><img src="images/sizer.gif" alt="" width="1" height="1" /></div><input type="text" name="nombre" size="60" value="<? echo $row["nombre"] ?>" /><div class="seppuntos"><img src="images/sizer.gif" alt="" /></div>
<!--		<p><strong>Nombre secci&aacute;n/subsecci&aacute;n <img src="images/eng.gif" alt="" style="margin:0px 5px 0px 5px" />:</strong></p><p class="ayuda"><a tabindex="100" href="javascript:ayuda(2)"><img src="images/ayuda.gif" alt="Ayuda" /></a></p><input type="text" name="nombreE" size="60" value="<? echo $row["nombreE"] ?>" /><div class="seppuntos"><img src="images/sizer.gif" alt="" /></div>-->
		<input type="hidden" name="destacado" value="<? echo $row["destacado"]; ?>" />
		<p class="obligatorio">Posici&aacute;n:</p><p class="ayuda"><a tabindex="100" href="javascript:ayuda(0)"><img src="images/ayuda.gif" alt="Ayuda" /></a></p><input type="text" name="posicion" size="30" value="<? echo $row["posicion"]; ?>" maxlength="10" /><div class="seppuntos"><img src="images/sizer.gif" alt="" /></div>
		<p>Destacado:</p><p class="ayuda"><a tabindex="100" href="javascript:ayuda(3)"><img src="images/ayuda.gif" alt="Ayuda" /></a></p><input type="checkbox" name="ch_destacado" <? if($row["destacado"]==1) echo "checked" ?> style="border:0px" /><div class="seppuntos"><img src="images/sizer.gif" alt="" /></div>
		<p>onLoad</p><p class="ayuda"><a tabindex="100" href="javascript:ayuda(4)"><img src="images/ayuda.gif" alt="Ayuda" /></a></p><input type="text" name="onLoad" size="60" value="<? echo $row["onLoad"]; ?>" /><div class="seppuntos"><img src="images/sizer.gif" alt="" /></div>
		<p>onUnload</p><p class="ayuda"><a tabindex="100" href="javascript:ayuda(4)"><img src="images/ayuda.gif" alt="Ayuda" /></a></p><input type="text" name="onUnload" size="60" value="<? echo $row["onUnload"]; ?>" /><div class="seppuntos"><img src="images/sizer.gif" alt="" /></div>
		<div class="fondointro"><input type="button" name="Submit" onclick="javascript:enviar();" value="Modificar secci&aacute;n/subsecci&aacute;n" /></div>
	</form>
	</div>
	<!-- /contenido -->
	<div id="ayuda">
		<div class="encab">Ayuda de Árbol de contenidos</div>
		<div id="textoayuda"><div style='font-weight:normal'></div>
		<script type="text/javascript">ayuda();</script>
	</div>
<? } ?>