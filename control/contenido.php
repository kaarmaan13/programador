	<br />
	<?
	$site = @$_REQUEST["site"];
	$action = @$_REQUEST["action"];
	
	//find length of the needle
	$needle_len = strlen($needle);
	//find postion
	$position_num = strpos($site,"?") + $needle_len;
	//cut the string
	if($position_num != 0) $result_site = substr("$site",0,$position_num);
	else $result_site=$site;
	
	if ($action==""){ ?>
			Bienvenido al Panel de Control de <strong><? echo $global_titulo ?></strong>.<br /><br />
			Seleccione a su izquierda el &aacute;rea del Panel de Control que desea modificar.
	<?
	} else {
		if ($result_site!=""){
			include("site/".$result_site.".php");
		}
		if ($action!="custom"){
			include("acciones.php");
		}		
	}
	?>
