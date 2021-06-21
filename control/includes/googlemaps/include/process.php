<script type="text/javascript">
	//<![CDATA[

    var map = null;
    var geocoder = null;

	function onLoad() {
		if (GBrowserIsCompatible()) {
<?			
			$result=mysql_query("SELECT * FROM grupopuntos");
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
				
				
					$content = '<form name=form1 id=form1 method=post action=index.php enctype=multipart/form-data><table style=font-size:10px;font-family:Verdana, Arial, Helvetica, sans-serif>';
					$content .= '<tr><td align=right>Nombre:</td><td align=left><input name=punto_nombre type=text size=34 value="' . $coord_array[$i]['nombre'] . '"></td></tr>';
					$content .= '<tr><td align=right>Dirección:</td><td align=left><textarea name=punto_direcc cols=33 rows=4 wrap=VIRTUAL>' . br2nl($coord_array[$i]['direcc']) . '</textarea></td></tr>';
					$content .= '</tr><tr><td align=right>Tipo de punto:</td><td align=left><select name=punto_tipo style=vertical-align: middle>';

			$result=mysql_query("SELECT * FROM grupopuntos ORDER BY grupopuntos");
			if (mysql_num_rows($result)>0) {
				while($row=mysql_fetch_array($result)) {
					if($coord_array[$i]['punto_tipo']==$row["idgrupopuntos"]) $content .= '<option value="' . $row["idgrupopuntos"] . '" selected>' . $row["grupopuntos"] . '</option>';
					else $content .= '<option value="' . $row["idgrupopuntos"] . '">' . $row["grupopuntos"] . '</option>';
				}
			}
					
					$content .= '</select></td></tr>';
					$content .= '<tr><td align=right>E-mail:</td><td align=left size=34><input name=punto_email type=text value="' . $coord_array[$i]['email'] . '"></td></tr>';
					$content .= '<tr><td align=right>Web:</td><td align=left><input name=punto_url type=text size=34 value="' . $coord_array[$i]['url'] . '"></td></tr>';
					$content .= '<tr><td align=right>Logo <i>(150x40 px)</i>:</td><td align=left><input name=punto_logo type=file></td></tr>';
				if($coord_array[$i]['punto_logo']!=null) {
					$content .= '<tr><td align=right></td>';
					$content .= '<td align=right><div class="imagen"><img src=' . $ruta_imagenes.$coord_array[$i]['punto_logo'] . '?x=uniqid((double)microtime()*1000000,1) id=imagen alt="" /></a>';
					$content .= '<div class=pie><a href=javascript:eliminar_foto("' . $coord_array[$i]['punto_logo'] . "\",\"" . 'punto_logo' . '")><img src=img/eliminar2.gif alt="Eliminar esta foto" /></a></div></div>';
					$content .= '</td></tr>';
				}	
					$content .= '<tr><td align=right>Foto Mini <i>(120x120 px)</i>:</td><td align=left><input name=punto_fotomini type=file></td></tr>';					
				if($coord_array[$i]['punto_fotomini']!=null) {
					$content .= '<tr><td align=right></td>';
					$content .= '<td align=right><div class="imagen"><a href="window.open("' . $ruta_imagenes.$coord_array[$i]['punto_fotomini'] . '")"><img src=' . $ruta_imagenes.$coord_array[$i]['punto_fotomini'] . '?x=uniqid((double)microtime()*1000000,1) id=imagen alt="" /></a>';
					$content .= '<div class=pie><a href=javascript:eliminar_foto("' . $coord_array[$i]['punto_fotomini'] . "\",\"" . 'punto_fotomini' . '")><img src=img/eliminar2.gif alt="Eliminar esta foto" /></a></div></div>';
					$content .= '</td></tr>';
				}		
					$content .= '<tr><td align=right>Foto <i>(780x490 px)</i>:</td><td align=left><input name=punto_foto type=file></td></tr>';
				if($coord_array[$i]['punto_foto']!=null) {
					$content .= '<tr><td align=right></td>';
					$content .= '<td align=right><div class="imagen"><a href=# onclick=javascript:window.open("' . $ruta_imagenes.$coord_array[$i]['punto_foto'] . '","ventana","width=780,height=490,scrolling=no")><img src=' . $ruta_imagenes.$coord_array[$i]['punto_foto'] . '?x=uniqid((double)microtime()*1000000,1) width=120 id=imagen alt="Imagen reducida. Pulse sobre la foto para ver a tamaño real" /></a>';
					$content .= '<div class=pie><a href=javascript:eliminar_foto("' . $coord_array[$i]['punto_foto'] . "\",\"" . 'punto_foto' . '")><img src=img/eliminar2.gif alt="Eliminar esta foto" /></a></div></div>';
					$content .= '</td></tr>';
				}	
					$content .= '<tr><td align=right>Comentarios:</td><td align=left><textarea name=punto_coment cols=33 rows=4 wrap=VIRTUAL>' . br2nl($coord_array[$i]['coment']) . '</textarea></td></tr>';
					$content .= '<tr><td align=right></td><td align=right><input type=button name=Submit value=Modificar onclick="javascript:modificar(' . $coord_array[$i]['punto_ID'] . ');">&nbsp;&nbsp;<input type=button name=Submit2 value=Eliminar onclick="javascript:eliminar(' . $coord_array[$i]['punto_ID'] . ');"></td></tr></table></form>';
				
				
				

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
					if (point) {
						//map.addOverlay(new GMarker(point));
						var markera = new GMarker(point, icon_click);
						map.addOverlay(markera);
						var y = point.y;
						var x = point.x;
						popup="<form name=form1 id=form1 method=post action='index.php?x="+x+"&y="+y+"' enctype=multipart/form-data><table style='font-size:10px;font-family:Verdana, Arial, Helvetica, sans-serif'>";
						popup+="<tr><td align=right>Nombre:</td><td align=left><input name=punto_nombre type=text size=34></td></tr>";
						popup+="<tr><td align=right>Dirección:</td><td align=left><textarea name='punto_direcc' cols='33' rows='4' wrap='VIRTUAL'></textarea></td></tr>";
						popup+="</tr><tr><td align=right>Tipo de punto:</td><td align=left><select name=punto_tipo style='vertical-align: middle'>";
<?
			$result=mysql_query("SELECT * FROM grupopuntos ORDER BY grupopuntos");
			if (mysql_num_rows($result)>0) {
				$cont=1;
				while($row=mysql_fetch_array($result)) {
?>
							popup+="<option value='<? echo $row["idgrupopuntos"]; ?>'><? echo $row["grupopuntos"]; ?></option>";
<?				}
			}
?>
						popup+="</select></td></tr>";
						popup+="<tr><td align=right>E-mail:</td><td align=left size=34><input name=punto_email type=text></td></tr>";
						popup+="<tr><td align=right>Web:</td><td align=left><input name=punto_url type=text size=34></td></tr>";
						popup+="<tr><td align=right>Logo <i>(200x40 px)</i>:</td><td align=left><input name=punto_logo type=file></td></tr>";
						popup+="<tr><td align=right>Foto Mini <i>(120x120 px)</i>:</td><td align=left><input name=punto_fotomini type=file></td></tr>";
						popup+="<tr><td align=right>Foto <i>(780x490 px)</i>:</td><td align=left><input name=punto_foto type=file></td></tr>";
						popup+="<tr><td align=right>Comentarios:</td><td align=left><textarea name='punto_coment' cols='33' rows='4' wrap='VIRTUAL'></textarea></td></tr>";
						popup+="<tr><td align=right></td><td align=center><input type=button name=Submit value=Enviar onclick='javascript:enviarpunto();'></td></tr></table></form>";
                        markera.openInfoWindowHtml(popup);
                    }
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