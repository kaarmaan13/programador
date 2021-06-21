<? include "php/conexion.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="es" lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Programador Aut&oacute;nomo en Madrid - Dise&ntilde;ador Web Freelance en Madrid :: Portfolio</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />
<? include "includes/metas.php" ?>
<link href="css/estilos.css?v=1.1" rel="stylesheet" type="text/css" />
<meta property="og:url" content="http://programadorautonomo.com/blog.php?v1.3" />
<meta property="og:title" content="Blog Programador Web Madrid" />
<meta property="og:description" content="Programadro Autonomo Web Madrid recopila en un blog cronologicamente información de interés para sus clientes." />
<meta property="og:image" content="http://programadorautonomo.com/images/logo.gif" />
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
            <div class="lado-blog">
            	<h1>blog</h1>
				<script>
				function abrirFacebook(){
					window.open("http://www.facebook.com/sharer.php?s=100&p[url]=http://programadorautonomo.com/blog.php","width=600,height=400");
					}
				/* Función para bajar despacio */
				$(function() {
				  $('a[href*=#]:not([href=#])').click(function() {
					if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {

					  var target = $(this.hash);
					  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
					  if (target.length) {
						$('html,body').animate({
						  scrollTop: target.offset().top
						}, 1000);
						return false;
					  }
					}
				  });
				});
				// <![CDATA[
				$(window).scroll(function(){
					if ($(this).scrollTop() > 250){
						 $('.lateral-blog').addClass("fixed").fadeIn();
					}
					else {
						$('.lateral-blog').removeClass("fixed");
					}
				});
				// ]]>
				</script>
			<? 	$result=mysql_query("SELECT * FROM blog WHERE oculto=0 ORDER BY fecha DESC", $db);
				while($row=mysql_fetch_array($result)) {	?>
				<div class="noticia-blog" id="blog<? echo $row["idblog"]; ?>">
					<a href="/blog-post.php?id=<? echo $row["idblog"]; ?>"><h2><? echo $row['titulo']; ?></h2></a>
					<div class="image">	
						<img src="/images/blog/<? echo $row["foto"]; ?>" alt="Blog Programador Autonomo" />
					</div>
					<p class="texto"><? echo nl2br($row['introduccion']); ?></p>
					<div class="vermas"><a href="/blog-post.php?id=<? echo $row["idblog"]; ?>">Ver más</a></div>
					<p class="user"><? echo $row['usuario']; ?></p>
					<?	$resulttag1=mysql_query("SELECT * FROM tags WHERE idtag=".$row['idtag1'], $db);
						$rowtag1=mysql_fetch_array($resulttag1);
						if($rowtag1['tag']!=''){?>
						<div class="tag prioridad<? echo $rowtag1['prioridad']; ?>"><a href="#"><? echo $rowtag1['tag']; ?></a></div>
						<?} ?>
					<?	$resulttag2=mysql_query("SELECT * FROM tags WHERE idtag=".$row['idtag2'], $db);
						$rowtag2=mysql_fetch_array($resulttag2);
						if($rowtag2['tag']!=''){?>
						<div class="tag prioridad<? echo $rowtag2['prioridad']; ?>"><a href="#"><? echo $rowtag2['tag']; ?></a></div>
						<?} ?>
					<?	$resulttag3=mysql_query("SELECT * FROM tags WHERE idtag=".$row['idtag3'], $db);
						$rowtag3=mysql_fetch_array($resulttag3);
						if($rowtag3['tag']!=''){?>
						<div class="tag prioridad<? echo $rowtag3['prioridad']; ?>"><a href="#"><? echo $rowtag3['tag']; ?></a></div>
						<?} ?>
					<?	$resulttag4=mysql_query("SELECT * FROM tags WHERE idtag=".$row['idtag4'], $db);
						$rowtag4=mysql_fetch_array($resulttag4);
						if($rowtag4['tag']!=''){?>
						<div class="tag prioridad<? echo $rowtag4['prioridad']; ?>"><? echo $rowtag4['tag']; ?></a></div>
						<?} ?>
                </div>
			<?	} ?>
            </div>
			<div class="lateral-blog">
				<div class="caja">
					<h3>Ultimos post</h3>
					<?	$resultlista=mysql_query("SELECT * FROM blog WHERE oculto=0 ORDER BY fecha DESC", $db);
						while($rowlista=mysql_fetch_array($resultlista)) { ?>
					<div class="noticia"><a href="#blog<? echo $rowlista["idpost"]; ?>"><? echo $rowlista['titulo']; ?></a></div>
					<?	} ?>
				</div>
				<div class="caja">
					<h3>Busqueda por tags</h3>
					<? $resulttag=mysql_query("SELECT * FROM tags ORDER BY prioridad ASC", $db);
					while($rowtag=mysql_fetch_array($resulttag)) {?>
						<div class="tag prioridad<? echo $rowtag['prioridad']; ?>"><a href="#"><? echo $rowtag['tag']; ?></a></div>
					<?}?>
				</div>
				<div class="ico facebook">
					<a href="http://www.facebook.com/sharer.php?s=100&p[url]=http://programadorautonomo.com/blog.php&p[title]=<? echo $row['titulo']; ?>&p[images][0]=http://programadorautonomo.com//images/blog/<? echo $row["img"]; ?>&p[summary]=<? echo $row['titulo']; ?>" target="popup" onclick="abrirFacebook()"><img src="/images/compartir-facebook.png" alt="Compartir Blog Programador Autonomo Madrid en Facebook" /></a>
				</div>

			</div>
		</div>
<? include "includes/inferior.php" ?>
	</div>
<? include "includes/googleanalytics.php" ?>
</body>
</html>
<? include "php/desconexion.php" ?>