<script type="text/javascript">
	//<![CDATA[

    var map = null;
    var geocoder = null;

	function onLoad() {
		if (GBrowserIsCompatible()) {
<?			
			// Consulta de puntos seleccionados
			if($_REQUEST["itemsel"]=="") $_REQUEST["itemsel"]=$_REQUEST["idgrupopuntos"];
			$seleccionados = split( ",", $_REQUEST["itemsel"]);
			$querysel = "";
			for($i=0;$i<=count($seleccionados)-1;$i++) {
				if($seleccionados[$i]!="") {
					$querysel .= "idgrupopuntos=".$seleccionados[$i];
					if($i!=count($seleccionados)-1) $querysel .= " || ";
				}
			}
			if(substr($querysel, strlen($querysel)-3, strlen($querysel)) == "|| ") $querysel=substr($querysel, 0, strlen($querysel)-3);
			$result=mysql_query("SELECT * FROM grupopuntos WHERE ".$querysel);
			if (mysql_num_rows($result)>0) {
				while($row=mysql_fetch_array($result)) {
?>
				var icon_<? echo $row["idgrupopuntos"]; ?> = new GIcon();
					icon_<? echo $row["idgrupopuntos"]; ?>.image = "img/<? echo $row["iconogrupo"] ?>";
					icon_<? echo $row["idgrupopuntos"]; ?>.shadow = "<? if($row["sombraiconogrupo"]=="") $row["sombraiconogrupo"]=$default_shadow; else $row["sombraiconogrupo"]="img/".$row["sombraiconogrupo"]; echo $row["sombraiconogrupo"]; ?>";
					<? list($w_image, $h_image, $tip_image) = getimagesize('img/'.$row["iconogrupo"].''); ?>
					<? list($w_shadow, $h_shadow, $tip_shadow) = getimagesize($row["sombraiconogrupo"]); ?>
					icon_<? echo $row["idgrupopuntos"]; ?>.iconSize = new GSize(<? echo $w_image ?>, <? echo $h_image ?>);
					icon_<? echo $row["idgrupopuntos"]; ?>.shadowSize = new GSize(<? echo $w_shadow ?>, <? echo $h_shadow ?>);
					icon_<? echo $row["idgrupopuntos"]; ?>.iconAnchor = new GPoint(<? echo ($w_image)-14; ?>, <? echo $h_image ?>);
					icon_<? echo $row["idgrupopuntos"]; ?>.infoWindowAnchor = new GPoint(5, 1);
<?				
				}
			}
?>

				var icon_click = new GIcon();
					icon_click.image = "img/1x1.gif"; //change this to be google default
					icon_click.shadow = "img/1x1.gif";
					icon_click.iconSize = new GSize(0, 0);
					icon_click.shadowSize = new GSize(0, 0);
					icon_click.iconAnchor = new GPoint(6, 20);
					icon_click.infoWindowAnchor = new GPoint(5, 1);
			
				map = new GMap2(document.getElementById("map"));
					map.addControl(new GLargeMapControl());
					map.addControl(new GMapTypeControl());
					map.addControl(new GScaleControl());    //Muestra la imagen de 200 pies
					map.setCenter(new GLatLng(<?= $centerpoint; ?>), <?= $mapZoom; ?>); //long,lat

				geocoder = new GClientGeocoder(); //para el buscador de sitios
<?
			   /* br2nl for use with HTML forms, etc. */
			   function br2nl($text)
			   {
				   /* Remove XHTML linebreak tags. */
				   $text = str_replace("<br />","\\n",$text);
				   /* Remove HTML 4.01 linebreak tags. */
				   $text = str_replace("<br>","\\n",$text);
				   /* Return the result. */
				   return $text;
			   }

				$numMarkers = sizeof($coord_array);
				for ($i=0; $i<$numMarkers; $i++){

					$content = '<div style="width:360px">';					
					$content .= '<div style="float:left;margin: 30px 0px 8px 2px;width:200px;font-size:11px"><strong>' . $coord_array[$i]['nombre'] . '</strong></div>';
				if($coord_array[$i]['punto_logo']!=null) {
					$content .= '<div style="float:left;margin: 10px 0px 8px 2px;width:150px;text-align:right"><img src="' . $ruta_imagenes.$coord_array[$i]['punto_logo'] . '" /></div>';
				}
					$content .= '<div class="sep"></div>';
				if($coord_array[$i]['punto_fotomini']!=null) {
					$content .= '<div style="float:left;margin: 0px 12px 0px 0px;"><img src=' . $ruta_imagenes.$coord_array[$i]['punto_fotomini'] . ' style="border:1px solid #000000" /></div>';
				}
					$content .= '<div style="float:left">';
					$content .= '<div>' . $coord_array[$i]['direcc'] . '</div>';
					$content .= '<div style="margin:4px 0px 4px 0px"><a style="text-decoration:underline;href="mailto:' . $coord_array[$i]['email'] . '">' . $coord_array[$i]['email'] . '</a></div>';
					$content .= '<div><a style="color:#3265cb" href="' . $coord_array[$i]['web'] . '" target="_blank">' . $coord_array[$i]['url'] . '</a></div>';
					$content .= '</div>';
					$content .= '<div class="sep"></div>';
					$content .= '<div style="margin:8px 0px 0px 0px">' . $coord_array[$i]['coment'] . '</div>';
					$content .= '</div>';
?>
				var point<?= $i; ?> = new GLatLng(<?= $coord_array[$i]['lat']; ?>, <?= $coord_array[$i]['long']; ?>);

<?
                /*Los iconos de colores*/
                $grupopuntos_nombre = $coord_array[$i]['punto_tipo'];
				$result=mysql_query("SELECT * FROM puntos");
				if (mysql_num_rows($result)>0) {
					while($row=mysql_fetch_array($result)) {
						if($row["punto_tipo"] == $coord_array[$i]['punto_tipo'])
                            $icono = 'icon_'.$row["punto_tipo"];

					}
				}
?>
                var marker<?= $i; ?> = new PdMarker(point<?= $i; ?>, <?=$icono; ?>);

					marker<?= $i; ?>.setTooltip("<?= addslashes($coord_array[$i]['nombre']); ?>");
					map.addOverlay(marker<?= $i; ?>);
					GEvent.addListener(marker<?= $i; ?>, 'click', function() {marker<?= $i; ?>.openInfoWindowHtml('<?= $content; ?>');});
<?
					/* Adds lines for who recommended them */
					$r = $coord_array[$i]['recommended'];
					if($r) {
						$p++;
						$recommendedquery="SELECT * 
										   FROM puntos
										   WHERE punto_ID = '$r';";
						$recommendedresult = mysql_query($recommendedquery);if(!$recommendedresult) {echo "Jarrl!  Error obteniendo los puntos de recomendacion de la Base de Datos."; exit;}
						$recommend_row = mysql_fetch_object($recommendedresult);
?>
							var polyline<?= $p; ?> = new GPolyline([point<?= $i; ?>,new GLatLng(<?= $recommend_row->punto_lat; ?>,<?= $recommend_row->punto_long; ?>)],'<?= $linecolor; ?>', 1, 0);
							map.addOverlay(polyline<?= $p; ?>);
<?
					}
					/* ------------------------------------ */
				}
?>
				GEvent.addListener(map, 'click', function(overlay, point) {//esta esperando a un click en el mapa para añadir una nueva marca

				});
		}
	}
<? /* -------FUNCION PARA EL BUSCADOR DE DIRECCIONES----------------------------- */ ?>
    function showAddress(address) {
      geocoder.getLatLng(
        address,
        function(point) {
          if (!point) {
            alert(address + " not found");
          } else {
            map.setCenter(point, <?= $mapZoom; ?>);
            var marker = new GMarker(point);
            map.addOverlay(marker);
            marker.openInfoWindowHtml(address);
          }
        }
      );
    }
	//]]>
</script>