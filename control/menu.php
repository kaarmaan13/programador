<?
/*
	Se necesita para construir el menu las siguientes matrices:
	
	global_menu_titulo 	= cada uno de los titulos que llevan las opciones
	global_menu_tipo 	= S para Standard si queremos que se creen automaticamente las opciones de insertar, modificar y eliminar
	
*/?>
<div class="sep"><img src="images/sizer.gif" alt="" /></div>
<div id="menu">
<?
for ($i=0;$i<sizeof($global_menu_opcion);$i++){ ?>
<? if($global_menu_opcion[$i] == "Portfolio") { ?>
    <div id="opcion" style="background-color:#3C4244;font-weight:bold;font-size:13px;color:#FFF">CONTENIDOS WEB</div>
    <?	} ?>
    <? if($global_menu_opcion[$i] == "Blog") { ?>
    <div id="opcion" style="background-color:#3C4244;font-weight:bold;font-size:13px;color:#FFF">BLOG</div>
    <?	} ?>
	<div id="opcion"><a href="javascript:subopciones(<? echo $i ?>);"><? echo $global_menu_opcion[$i] ?></a></div>
	<div id="subopciones">
	<div id="subopciones<? echo $i ?>" style="display:none">
	<p class="flecha1"><img src="images/sizer.gif" alt="" width="1" height="1" /></p><p class="flecha2"><img src="images/sizer.gif" alt="" width="1" height="1" /></p><p class="flecha3"><img src="images/sizer.gif" alt="" width="1" height="1" /></p><p class="flecha4"><img src="images/sizer.gif" alt="" width="1" height="1" /></p>
	<p class="flecha5"><img src="images/sizer.gif" alt="" width="1" height="1" /></p><p class="flecha6"><img src="images/sizer.gif" alt="" width="1" height="1" /></p><p class="flecha7"><img src="images/sizer.gif" alt="" width="1" height="1" /></p><p class="flecha8"><img src="images/sizer.gif" alt="" width="1" height="1" /></p>
	<? if ($global_menu_tipo[$i]=="S"){ ?>
		<p class="introducir"><a href="index.php?site=<? echo $global_menu_id[$i] ?>&action=insert">A&ntilde;adir <? echo $global_menu_opcion[$i] ?></a></p>
		<p class="modificar"><a href="index.php?site=<? echo $global_menu_id[$i] ?>&action=update">Modificar <? echo $global_menu_opcion[$i] ?></a></p>
		<p class="eliminar"><a href="index.php?site=<? echo $global_menu_id[$i] ?>&action=delete">Eliminar <? echo $global_menu_opcion[$i] ?></a></p>
	<? } ?>
	<? if ($global_menu_tipo[$i]=="M") { ?>
		<p class="modificar"><a href="index.php?site=<? echo $global_menu_id[$i] ?>&action=update">Modificar <? echo $global_menu_opcion[$i] ?></a></p>
	<? } ?>
	<? if ($global_menu_tipo[$i]=="C"){ 
			for ($j=0;$j<sizeof($global_menu_custom);$j++){
				if ($global_menu_custom[$j][0]==$global_menu_id[$i]){ ?>
					<p class="listado" style="margin-bottom:0px"><a href="index.php?site=<? echo $global_menu_custom[$j][2] ?>&action=custom"><? echo $global_menu_custom[$j][1] ?></a></p>
	<? 			}
			}
			echo"<br />";
		} ?>
	</div>
	</div>
<?
}
?>
<div style="float:left;;margin:15px 0px 20px 20px"><a href="http://validator.w3.org/check?uri=referer"><img src="images/valid-xhtml11.gif" alt="Valid XHTML 1.1" /></a></div>
<div style="float:left;margin:15px 0px 0px 15px"><a href="http://jigsaw.w3.org/css-validator/check?uri=referer"><img src="images/valid-css.gif" alt="" /></a></div>
<div class="sep"><img src="images/sizer.gif" alt="" /></div>
<!--<div><img src="images/valid-wai.gif" alt="" /></div>-->
</div>