<? include "php/conexion.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="es" lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Programador Aut&oacute;nomo en Madrid - Dise&ntilde;ador Web Freelance en Madrid :: Portfolio</title>
<? include "includes/metas.php" ?>
<link href="css/estilos.css?v=1.1" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="includes/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript">
<!--//--><![CDATA[//><!--
function mostrar(ind, inicio, fin) {
	for(i=inicio;i<=fin;i++) {
		document.getElementById('foto'+i).style.display='none';
		document.getElementById('enlace'+i).style.background='#4974a0';
	}
	document.getElementById('foto'+ind).style.display='block';
	document.getElementById('enlace'+ind).style.background='#3b4043';
}
//--><!]]>
</script>
</head>
<body>
	<div id="cont">
<? include "includes/superior.php" ?>
	<script src="includes/fancybox/jquery.fancybox.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,
				openEffect : 'none',
				helpers : {
					title : {type : 'inside'},
					overlay : {
						css : {'background' : 'rgba(238,238,238,0.85)'}
					}
				}
			});			
		});
	</script>
        <ul id="menu">
            <li class="home"><a href="index.php"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="portfolio"><a href="portfolio.php" class="activo"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="clientes"><a href="clientes.php"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="servicios"><a href="servicios.php"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="aplicacionesweb"><a href="aplicacionesweb.php"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="contacto"><a href="contacto.php"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="sep"><img src="images/sizer.gif" alt="" width="1" height="1" /></li>
        </ul>
        <div id="logo"><a href="index.php"><img src="images/logo.gif" alt="Programador Autónomo" /></a></div>
		<div id="contenido">
            <div class="centro">
            	<h1><img src="images/portfolio.gif" alt="portfolio" /></h1>
<? 
	$cont=0;
	$grupo=0;
	$result=mysql_query("SELECT * FROM trabajos WHERE oculto=0 ORDER BY orden", $db);
	while($row=mysql_fetch_array($result)) {
		$grupo++;
		$listaenlaces="";
		$inicio=$cont; $inicio++;
		$fin=$cont;
		if($row["fotomini1"]) $fin++; if($row["fotomini2"]) $fin++; if($row["fotomini3"]) $fin++; if($row["fotomini4"]) $fin++; if($row["fotomini5"]) $fin++;
?>
				<div class="trabajo">
                	<div class="galeria">					
	          	  		<? if($row["fotomini1"]) { ?><p id="foto<? $cont++; echo $cont; if(($row["fotomini2"] != "") || ($row["fotomini3"] != "") || ($row["fotomini4"] != "") || ($row["fotomini5"] != "")) { $listaenlaces="<div class=\"enlace\"><a id=\"enlace".$cont."\" href=\"javascript:mostrar(".$cont.", ".$inicio.", ".$fin.")\" class=\"activo\">1</a></div>"; } ?>">
							<a class="fancybox" href="/images/<? echo $row["foto1"]?>?v=<? echo date("Ymd");?>" data-fancybox-group="gallery-<? echo $grupo ?>" title="<? echo $row["trabajo"] ?>"><img src="images/<? echo $row["fotomini1"] ?>?v=<? echo date("Ymd");?>" alt="<? echo $row["trabajo"] ?>" /></a>
						</p><? } ?>
                        <? if($row["fotomini2"]) { ?><p id="foto<? $cont++; echo $cont; if($row["fotomini2"]) { $listaenlaces.="<div class=\"enlace\"><a id=\"enlace".$cont."\" href=\"javascript:mostrar(".$cont.", ".$inicio.", ".$fin.")\">2</a></div>"; } ?>" style="display:none">
							<a class="fancybox" href="/images/<? echo $row["foto2"]?>?v=<? echo date("Ymd");?>" data-fancybox-group="gallery-<? echo $grupo ?>" title="<? echo $row["trabajo"] ?>"><img src="images/<? echo $row["fotomini2"] ?>?v=<? echo date("Ymd");?>" alt="<? echo $row["trabajo"] ?>" /></a>
						</p><? } ?>
                        <? if($row["fotomini3"]) { ?><p id="foto<? $cont++; echo $cont; if($row["fotomini3"]) { $listaenlaces.="<div class=\"enlace\"><a id=\"enlace".$cont."\" href=\"javascript:mostrar(".$cont.", ".$inicio.", ".$fin.")\">3</a></div>"; } ?>" style="display:none">
							<a class="fancybox" href="/images/<? echo $row["foto3"]?>?v=<? echo date("Ymd");?>" data-fancybox-group="gallery-<? echo $grupo ?>" title="<? echo $row["trabajo"] ?>"><img src="images/<? echo $row["fotomini3"] ?>?v=<? echo date("Ymd");?>" alt="<? echo $row["trabajo"] ?>" /></a>
						</p><? } ?>
                        <? if($row["fotomini4"]) { ?><p id="foto<? $cont++; echo $cont; if($row["fotomini4"]) { $listaenlaces.="<div class=\"enlace\"><a id=\"enlace".$cont."\" href=\"javascript:mostrar(".$cont.", ".$inicio.", ".$fin.")\">4</a></div>"; } ?>" style="display:none">
							<a class="fancybox" href="/images/<? echo $row["foto4"]?>?v=<? echo date("Ymd");?>" data-fancybox-group="gallery-<? echo $grupo ?>" title="<? echo $row["trabajo"] ?>"><img src="images/<? echo $row["fotomini4"] ?>?v=<? echo date("Ymd");?>" alt="<? echo $row["trabajo"] ?>" /></a>
						</p><? } ?>
                        <? if($row["fotomini5"]) { ?><p id="foto<? $cont++; echo $cont; if($row["fotomini5"]) { $listaenlaces.="<div class=\"enlace\"><a id=\"enlace".$cont."\" href=\"javascript:mostrar(".$cont.", ".$inicio.", ".$fin.")\">5</a></div>"; } ?>" style="display:none">
							<a class="fancybox" href="/images/<? echo $row["foto5"]?>?v=<? echo date("Ymd");?>" data-fancybox-group="gallery-<? echo $grupo ?>" title="<? echo $row["trabajo"] ?>"><img src="images/<? echo $row["fotomini5"] ?>?v=<? echo date("Ymd");?>" alt="<? echo $row["trabajo"] ?>" /></a>
						</p><? } ?>
                        <div class="enlaces">
                        	<? echo $listaenlaces; ?>
                            <br class="sep" />
                        </div>
                        <br class="sep" />
                    </div>
                    <div class="texto">	
                    	<h2><? echo $row["trabajo"] ?></h2>
                    	<h3><a href="http://<? echo $row["url"] ?>" onclick="window.open(this.href); return false;"><? echo $row["url"] ?></a></h3>
                        <p><? echo nl2br($row["descripcion"]) ?></p>
                        <span><? echo nl2br($row["requisitos"]) ?></span>
                        <h4><strong>Tecnologías:</strong> <? echo $row["tecnologias"] ?></h4>
           			</div>
                    <br class="sep" />
                </div>
<?	} ?>
            </div>
		</div>
<? include "includes/inferior.php" ?>
	</div>
<? include "includes/googleanalytics.php" ?>
</body>
</html>
<? include "php/desconexion.php" ?>