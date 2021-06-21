<?php header("Content-type: text/css"); ?>
<? include "../includes/global_cliente.php"; ?>
<? include "../includes/global_conexion.php"; ?>
<?
	$vsql="select * from conf where idconfiguracion=1";
	$result=mysql_query($vsql,$db);
	$row=mysql_fetch_array($result);
	
	$colorfuente1=$row["colorfuente1"];
	$colorfuente2=$row["colorfuente2"];
	$colorfondo=$row["colorfondo"];
	$colorfondomenu=$row["colorfondomenu"];
	$colorfondobotones=$row["colorfondobotones"];
	$colorfondocontenido=$row["colorfondocontenido"]; 
?>	
body {
width:1000px;
height:680px;
margin:0px;
padding:0px;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:10px;
color:<? echo $colorfuente2; ?>;
}
img {
border:0px;
margin:0px;
padding:0px;
}
form {
border:0px;
margin:0px;
padding:0px;
}
select,input,textarea{
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:10px;
color:#000000;
font-weight:normal;
}
textarea {
width:540px;
height:120px;
}
select{
border:1px solid #5D8BA1;
padding:2px 2px 2px 2px;
}
input {
border:1px solid #5D8BA1;
padding:2px 2px 2px 2px;
}
textarea {
border:1px solid #5D8BA1;
padding:2px 2px 2px 2px;
}
input.check {
border:0px;
padding:0px;
vertical-align:middle;
}
a {
text-decoration:none;
}
.sep {
clear:both;
height:1px;
margin:0px;
padding:0px;
font-size:1px;
line-height:1px;
}

/* ARRIBA */
#arriba {
height:110px;
background-color:#ffffff;
}
#arriba .logo {
float:left;
width:200px;
margin-top:10px;
text-align:center;
}
#arriba .logo .entidad {
height:65px;
color:<? echo $colorfondobotones; ?>;
font-size:26px;
font-weight:bold;
font-family:"Courier New", Courier, mono;
}
#arriba .panel {
float:left;
width:526px;
color:<? echo $colorfondobotones; ?>;
font-weight:bold;
font-size:25px;
margin:30px 0px 0px 100px;
}
#arriba .config {
float:left;
border-left:3px solid <? echo $colorfondomenu; ?>;
border-right:3px solid <? echo $colorfondomenu; ?>;
border-bottom:3px solid <? echo $colorfondomenu; ?>;
padding:10px;
background-color:<? echo $colorfondobotones; ?>;
}
#arriba .config a {
color:<? echo $colorfuente1; ?>;
font-weight:bold;
}
/* /ARRIBA */

/* MENU */
#menu {
float:left;
background-color:<? echo $colorfondomenu; ?>;
width:200px;
margin:0px 10px 0px 0px;
height:500px;
}
#menu #opcion {
background-color:<? echo $colorfondobotones; ?>;
text-align:center;
padding:6px 0px 6px 0px;
border-bottom:1px solid <? echo $colorfuente2; ?>;
}
#menu #opcion a {
color:<? echo $colorfuente1; ?>;
font-weight:bold;
}
#menu #opcion a:hover {
text-decoration:underline;
}
#menu #subopciones {
background-color:<? echo $colorfondomenu; ?>;
}
#menu #subopciones p {
margin:0px;
padding:4px 0px 4px 30px;
}
#menu #subopciones p a {
color:<? echo $colorfuente2; ?>;
font-weight:normal;
}
#menu #subopciones p a:hover {
color:<? echo $colorfondobotones; ?>;
}
#menu #subopciones p.flecha1 {
padding:0px;margin:0px 0px 0px 92px;width:16px;height:1px;background-color:<? echo $colorfondobotones; ?>;
}
#menu #subopciones p.flecha2 {
padding:0px;margin:0px 0px 0px 93px;width:14px;height:1px;background-color:<? echo $colorfondobotones; ?>;
}
#menu #subopciones p.flecha3 {
padding:0px;margin:0px 0px 0px 94px;width:12px;height:1px;background-color:<? echo $colorfondobotones; ?>;
}
#menu #subopciones p.flecha4 {
padding:0px;margin:0px 0px 0px 95px;width:10px;height:1px;background-color:<? echo $colorfondobotones; ?>;
}
#menu #subopciones p.flecha5 {
padding:0px;margin:0px 0px 0px 96px;width:8px;height:1px;background-color:<? echo $colorfondobotones; ?>;
}
#menu #subopciones p.flecha6 {
padding:0px;margin:0px 0px 0px 97px;width:6px;height:1px;background-color:<? echo $colorfondobotones; ?>;
}
#menu #subopciones p.flecha7 {
padding:0px;margin:0px 0px 0px 98px;width:4px;height:1px;background-color:<? echo $colorfondobotones; ?>;
}
#menu #subopciones p.flecha8 {
padding:0px;margin:0px 0px 0px 99px;width:2px;height:1px;background-color:<? echo $colorfondobotones; ?>;
}
#menu #subopciones p.introducir {
background-image:url(../images/introducir.gif);
background-repeat:no-repeat;
background-position:left center;
}
#menu #subopciones p.custom {
background-repeat:no-repeat;
background-position:left center;
}
#menu #subopciones p.modificar {
background-image:url(../images/modificar.gif);
background-repeat:no-repeat;
background-position:left center;
}
#menu #subopciones p.eliminar {
background-image:url(../images/eliminar.gif);
background-repeat:no-repeat;
background-position:left center;
border-bottom:1px solid #000000;
}
#menu #subopciones p.listado {
background-image:url(../images/listado.gif);
background-repeat:no-repeat;
background-position:left center;
margin-bottom:10px;
}
#menu .seppuntos {
border-bottom:1px dotted #000000;
line-height:1px;
height:1px;
margin:0px 10px 0px 10px;
}

/* /MENU */

/* CONTENIDO */
.esta {
font-weight:normal;
padding:0px;
margin-bottom:10px;
color:#4f4f4f;
}
.esta strong {
color:<? echo $colorfondobotones; ?>;
}
#contenido {
float:left;
font-weight:bold;
margin:0px 0px 20px 0px;
width:570px;
padding:10px 10px 10px 10px;
border:1px solid <? echo $colorfondobotones; ?>;
voice-family: "\"}\"";
voice-family: inherit;
width:548px;
}
html>body #contenido {
width:548px;
}
#contenido .info {
text-align:right;
width:550px;
font-weight:normal;
}
#contenido p {
float:left;
width:510px;
background-image:url(../images/opcional.gif);
background-position:left center;
background-repeat:no-repeat;
margin:8px 0px 3px 0px;
padding:0px 0px 0px 10px;
}
#contenido p.obligatorio {
background-image:url(../images/obligatorio.gif);
}
#contenido p.busqueda {
background-image:none;
padding:0px;
}
#contenido p.ayuda {
float:left;
width:14px;
background-image:url(../images/sizer.gif);
}
#contenido p strong {
color:#CC0000;
}
#contenido .seppuntos {
clear:both;
margin-top:9px;
border-bottom:1px dotted #BFBFBF;
line-height:1px;
height:1px;
}
#contenido .fondointro {
background-color:<? echo $colorfondobotones; ?>;
padding:6px 10px 6px 0px;
text-align:right;
margin:20px 0px 0px 0px;
}
#contenido .fondointro input {
border:2px solid <? echo $colorfuente1; ?>;
padding:2px 2px 2px 2px;
background-color:<? echo $colorfondomenu; ?>;
color:<? echo $colorfuente2; ?>;
font-weight:bold;
}
#contenido .fondointro input.volver {
float:left;
margin-left:10px;
font-weight:normal;
}
#contenido .ok {
background-color:#8DAA8D;
padding:4px 0px 4px 0px;
margin:10px 0px 10px 0px;
color:#ffffff;
text-align:center;
}
#contenido .msg {
background-color:#8DAA8D;
padding:4px 0px 4px 0px;
margin:10px 0px 10px 0px;
color:#ffffff;
text-align:center;
}
#contenido .ok a {
text-decoration:underline;
color:#000000;
}
#contenido .ok p a:hover {
text-decoration:none;
}
#contenido .error {
clear:both;
background-color:#ff0000;
padding:4px 0px 4px 0px;
margin:10px 0px 10px 0px;
color:#ffffff;
text-align:center;
margin-top:10px;
}
#contenido .encab {
width:540px;
background-color:<? echo $colorfondobotones; ?>;
color:#000000;
font-weight:bold;
margin:0px;
padding:0px;
}
#contenido .filtro {
border:1px solid <? echo $colorfondobotones; ?>;
background-color:#E6E6E6;
padding:6px 10px 6px 10px;
margin:0px 0px 12px 0px;
}
#contenido .encab .encab1 {
float:left;
width:530px;
background-color:<? echo $colorfondobotones; ?>;
color:#ffffff;
padding:4px 0px 4px 10px;
}
#contenido .encab .encab2 {
float:left;
width:260px;
background-color:<? echo $colorfondobotones; ?>;
color:#ffffff;
padding:4px 0px 4px 10px;
}
#contenido .encab .encab3 {
float:left;
width:170px;
background-color:<? echo $colorfondobotones; ?>;
color:#ffffff;
padding:4px 0px 4px 10px;
}
#contenido .encab .encab4 {
float:left;
width:125px;
background-color:<? echo $colorfondobotones; ?>;
color:#ffffff;
padding:4px 0px 4px 10px;
}
#contenido .encab .flecha1 {
display:block;padding:0px;margin:0px 0px 0px 2px;width:8px;height:2px;background-color:<? echo $colorfuente1; ?>;
}
#contenido .encab #activa {
background-color:<? echo $colorfuente2; ?>;
}
#contenido .encab .flecha1 a {
display:block;width:8px;
}
#contenido .encab .flecha2 {
display:block;padding:0px;margin:0px 0px 0px 3px;width:6px;height:2px;background-color:<? echo $colorfuente1; ?>;
}
#contenido .encab .flecha2 a {
display:block;width:6px;
}
#contenido .encab .flecha3 {
display:block;padding:0px;margin:0px 0px 0px 4px;width:4px;height:2px;background-color:<? echo $colorfuente1; ?>;
}
#contenido .encab .flecha3 a {
display:block;width:4px;
}
#contenido .encab .flecha4 {
display:block;padding:0px;margin:0px 0px 0px 5px;width:2px;height:2px;background-color:<? echo $colorfuente1; ?>;
}
#contenido .encab .flecha4 a {
display:block;width:2px;
}
#contenido .fila {
width:540px;
margin:0px;
padding:0px;
}
#contenido .fila .flecha1 {
float:left;display:block;padding:0px;margin:4px 0px 0px 7px;width:1px;height:5px;background-color:<? echo $colorfondobotones; ?>;
}
#contenido .fila .flecha2 {
float:left;display:block;padding:0px;margin:5px 0px 0px 0px;width:1px;height:3px;background-color:<? echo $colorfondobotones; ?>;
}
#contenido .fila .flecha3 {
float:left;display:block;padding:0px;margin:6px 5px 0px 0px;width:1px;height:1px;background-color:<? echo $colorfondobotones; ?>;
}
#contenido .fila a:hover .flecha1, #contenido .fila a:hover .flecha2, #contenido .fila a:hover .flecha3 {
background-color:<? echo $colorfuente2; ?>;
}
#contenido .fila a {
display:block;
width:540px;
}
#contenido .fila a:hover {
display:block;
background-color:<? echo $colorfondomenu; ?>;
color:<? echo $colorfuente2; ?>;
cursor:hand;
}
#contenido .fila .col1 {
float:left;
width:530px;
padding:4px 10px 4px 0px;
}
#contenido .fila .subcol1 {
float:left;
width:515px;
}
#contenido .fila .col2 {
float:left;
width:260px;
padding:4px 10px 4px 0px;
}
#contenido .fila .subcol2 {
float:left;
width:245px;
}
#contenido .fila .col3 {
float:left;
width:170px;
padding:4px 10px 4px 0px;
}
#contenido .fila .subcol3 {
float:left;
width:155px;
}
#contenido .fila .col4 {
float:left;
width:125px;
padding:4px 10px 4px 0px;
}
#contenido .fila .subcol4 {
float:left;
width:110px;
}
#contenido .encab .ant {
float:left;
background-color:<? echo $colorfondobotones; ?>;
color:#ffffff;
padding:4px 0px 4px 12px;
voice-family: "\"}\"";
voice-family: inherit;
width:50px;
text-align:right;
}
html>body #contenido .encab .ant {
width:50px;
}
#contenido .encab .ant a{
color:#ffffff;
}
#contenido .encab .act {
float:left;
width:394px;
background-color:<? echo $colorfondobotones; ?>;
color:#ffffff;
padding:3px 0px 3px 12px;
text-align:center;
}
#contenido .encab .act .pag {
color:<? echo $colorfuente2; ?>;
}
#contenido .encab .sig {
float:left;
width:60px;
background-color:<? echo $colorfondobotones; ?>;
color:#ffffff;
padding:3px 0px 3px 12px;
voice-family: "\"}\"";
voice-family: inherit;
text-align:left;
}
html>body #contenido .encab .sig {
width:60px;
}
#contenido .encab .act a, #contenido .encab .ant a, #contenido .encab .sig a {
color:<? echo $colorfuente1; ?>;
}
#contenido .encab .act a:hover, #contenido .encab .ant a:hover, #contenido .encab .sig a:hover {
color:<? echo $colorfuente2; ?>;
}
#contenido .fila a {
color:<? echo $colorfondobotones; ?>;
}
#contenido a.popup img {
border:1px solid #BFBFBF;
}
#contenido a.popup:hover img {
border:1px solid <? echo $colorfondobotones; ?>;
}
#contenido #enlaces {
margin-top:10px;
}
/* tabla */
#contenido .tabla {
font-weight:normal;
background-color:#E2F1FF;
border-bottom:2px solid #ffffff;
padding:0px 5px 0px 15px;
background-image:url(../images/flechita.gif);
background-repeat:no-repeat;
background-position:left top;
}
#contenido .tabla .cola {
float:left;
background-color:#E2F1FF;
width:440px;
padding:4px 0px 4px 0px;
}
#contenido .tabla .colb {
float:left;
background-color:#E2F1FF;
width:90px;
padding:3px 0px 3px 0px;
}
#contenido .tabla a {
color:#2E7BC7;
text-decoration:underline;
}
/* /tabla */
#contenido .imagen {
float:left;
background-color:<? echo $colorfondomenu; ?>;
margin:10px 10px 10px 0px;
padding:10px 10px 10px 10px;
border:1px solid #BFBFBF;
text-align:center;
}
#contenido .imagen .pie {
background-image:url(../image/sizer.gif);
padding:3px 0px 0px 0px;
text-align:center;
margin:0px;
font-weight:normal;
}
/* /CONTENIDO */

/* AYUDA */
#ayuda {
float:left;
background-image:url(../images/ayuda2.gif);
background-position:right top;
background-repeat:no-repeat;
background-color:<? echo $colorfondobotones; ?>;
width:190px;
border:3px solid <? echo $colorfondomenu; ?>;
margin-left:10px;
padding:20px 10px 100px 10px;
color:#ffffff;
voice-family: "\"}\"";
voice-family: inherit;
width:164px;
}
html>body #ayuda {
width:164px;
}
#ayuda .encab {
font-weight:bold;
border-bottom:1px dotted <? echo $colorfondobotones; ?>;
margin:10px 0px 15px 0px;
padding-bottom:3px;
}
#ayuda b {
font-weight:normal;
font-style:italic;
}
#ayuda a {
color:#8DC6FF;
text-decoration:underline;
font-weight:bold;
}
/* /AYUDA */

#calendario {
padding:0px 0px 2px 6px;
vertical-align:bottom;
}
.estaen {
background-image:url(../images/flechita.gif);
background-repeat:no-repeat;
color:#000000;
background-color:<? echo $colorfondobotones; ?>;
font-weight:normal;
margin-top:10px;
padding:4px 0px 4px 15px;
}

/* GALERÍA DE FOTOS */
#contenido ul {
clear:both;
list-style-type:none;
margin:0px;
padding:0px;
font-weight:normal;
}
#contenido ul li {
float:left;
list-style-type:none;
padding:3px 0px 3px 12px;
margin:0px 0px 3px 0px;
}
#contenido ul.encabezado {
background-color:<? echo $colorfondobotones ?>;
color:#FFFFFF;
font-weight:bold;
}
#contenido ul.encabezado li.encab1 {
width:310px;
background-color:<? echo $colorfondobotones ?>;
}
#contenido ul.encabezado li.encab2 {
width:210px;
background-color:<? echo $colorfondobotones ?>;
}
#contenido ul li.col1 {
width:310px;
background-image:url(../images/flechita.gif);
background-repeat:no-repeat;
font-weight:bold;
}
#contenido ul li.col2 {
width:210px;
}
/* /GALERÍA DE FOTOS */