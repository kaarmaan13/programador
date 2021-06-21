<? include "php/conexion.php"; ?>
<? $resultpost=mysql_query("SELECT * FROM blog WHERE idblog=".$_REQUEST['id']." AND oculto=0 ORDER BY fecha DESC", $db);
   $rowpost=mysql_fetch_array($resultpost); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="es" lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Programador Aut&oacute;nomo en Madrid - Dise&ntilde;ador Web Freelance en Madrid :: Portfolio</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />
<? include "includes/metas.php" ?>
<link href="css/estilos.css?v=1.1" rel="stylesheet" type="text/css" />
<meta property="og:url" content="http://programadorautonomo.com/blog-post.php?id=<? echo $rowpost['idblog']; ?>" />
<meta property="og:title" content="<? echo $rowpost['titulo']; ?>" />
<meta property="og:description" content="<? echo nl2br($rowpost['introduccion']); ?>" />
<meta property="og:image" content="http://programadorautonomo.com/images/blog/<? echo $rowpost["foto"]; ?>" />
</head>
<body>
	<div id="cont">
<? include "includes/superior.php" ?>
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
            <div class="lado-postblog">
            	<h1>blog</h1>
				<script>
				function abrirFacebook(){
					window.open("http://www.facebook.com/sharer.php?s=100&p[url]=http://programadorautonomo.com/blog-post.php?id=<? echo $rowpost['idblog']; ?>","width=600,height=400");
					}
				</script>
				<div class="noticia-blog" id="blog<? echo $rowpost["idblog"]; ?>">
					<h2><? echo $rowpost['titulo']; ?></h2>
					<div class="image">	
						<img src="/images/blog/<? echo $rowpost["foto"]; ?>" alt="Blog Programador Autonomo - <? echo $rowpost['titulo']; ?>" />
					</div>
					<p class="texto"><? echo $rowpost['informacion']; ?></p>
					<p class="user"><? echo $rowpost['usuario']; ?></p>
					<div class="compartir">
						<div class="ico facebook">
							<a href="http://www.facebook.com/sharer.php?s=100&p[url]=http://programadorautonomo.com/blog-post.php?id=<? echo $rowpost['idblog']; ?>" target="popup" onclick="abrirFacebook()"><img src="/images/compartir-facebook.png" alt="Compartir Blog Programador Autonomo Madrid en Facebook" /></a>	
						</div>
						<div class="ico twitter">
							<a href="http://twitter.com/home?status=<? echo urlencode($rowpost['titulo']." via: http://programadorautonomo.com/blog-post.php?id=".$rowpost['idblog']); ?>"><img src="/images/compartir-twitter.png" alt="Compartir Blog Programador Autonomo Madrid en Twitter" /></a>
						</div>
					</div>
					<?	$resulttag1=mysql_query("SELECT * FROM tags WHERE idtag=".$rowpost['idtag1'], $db);
						$rowtag1=mysql_fetch_array($resulttag1);
						if($rowtag1['tag']!=''){?>
						<div class="tag prioridad<? echo $rowtag1['prioridad']; ?>"><a href="#"><? echo $rowtag1['tag']; ?></a></div>
						<?} ?>
					<?	$resulttag2=mysql_query("SELECT * FROM tags WHERE idtag=".$rowpost['idtag2'], $db);
						$rowtag2=mysql_fetch_array($resulttag2);
						if($rowtag2['tag']!=''){?>
						<div class="tag prioridad<? echo $rowtag2['prioridad']; ?>"><a href="#"><? echo $rowtag2['tag']; ?></a></div>
						<?} ?>
					<?	$resulttag3=mysql_query("SELECT * FROM tags WHERE idtag=".$rowpost['idtag3'], $db);
						$rowtag3=mysql_fetch_array($resulttag3);
						if($rowtag3['tag']!=''){?>
						<div class="tag prioridad<? echo $rowtag3['prioridad']; ?>"><a href="#"><? echo $rowtag3['tag']; ?></a></div>
						<?} ?>
					<?	$resulttag4=mysql_query("SELECT * FROM tags WHERE idtag=".$rowpost['idtag4'], $db);
						$rowtag4=mysql_fetch_array($resulttag4);
						if($rowtag4['tag']!=''){?>
						<div class="tag prioridad<? echo $rowtag4['prioridad']; ?>"><? echo $rowtag4['tag']; ?></a></div>
						<?} ?>
                </div>
            </div>
		</div>
<? include "includes/inferior.php" ?>
	</div>
<? include "includes/googleanalytics.php" ?>
</body>
</html>
<? include "php/desconexion.php" ?>