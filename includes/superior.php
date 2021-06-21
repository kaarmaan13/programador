		<div id="sup">
            <div class="telefono">Tlf. 637 22 51 51JJJ</div>
            <div class="email"><a href="mailto:info@programadorautonomo.com">info@programadorautonomo.com</a></div>
            <div class="clientes">
                <form id="formuclientes" action="post" >
                    <div class="col1">Usuario</div><div class="col2"><input type="text" name="user" /></div><div class="sep">&nbsp;</div>
                    <div class="col1">Contraseña</div><div class="col2"><input type="text" name="passwd" /></div><div class="sep">&nbsp;</div>
                </form>
            </div>
            <br class="sep" />
        </div>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			$('.boton-menu').click(function() {
				$('#enlaces-menu').toggle();
			});
		});
		</script>
		<div id="menu-movil">
			<div class="boton-menu"><img src="images/mobil-menu.png" alt="boton menu" /></div>
			<ul id="enlaces-menu" class="sf-menu">
			<li <? if(($_SERVER['REQUEST_URI'] == "/") || (strpos($_SERVER['REQUEST_URI'], "index.php"))) { ?> class="activo"<? } ?>><a href="/" title="Programador Autonomo Madrid">home</a></li>
			<li <? if(strpos($_SERVER['REQUEST_URI'], "portafolio.php")){ ?> class="activo"<? } ?>><a href="portfolio.php" title="portafolio">portafolio</a></li>
			<li <? if(strpos($_SERVER['REQUEST_URI'], "clientes.php")){ ?> class="activo"<? } ?>><a href="clientes.php" title="clientes">clientes</a></li>
			<li <? if(strpos($_SERVER['REQUEST_URI'], "servicios.php")){ ?> class="activo"<? } ?>><a href="servicios.php" title="servicios">servicios</a></li>
			<li <? if(strpos($_SERVER['REQUEST_URI'], "aplicacionesweb.php")){ ?> class="activo"<? } ?>><a href="aplicacionesweb.php" title="aplicaciones web">aplicaciones web</a></li>
			<li <? if(strpos($_SERVER['REQUEST_URI'], "index.php")){ ?> class="activo"<? } ?>><a href="contacto.php" title="contacto">contacto</a></li>
			</ul>
		</div>