<?php header("Content-type: text/css"); ?>

<? $color1="759abf"; ?>
body {
margin:0px;
padding:0px;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:10px;
color:#2f2f2f;
}
img {
border:0px;
}
select,input{
font-family:Verdana, Arial, Helvetica, sans-serif;
color:#4f4f4f;
font-size:10px;
}
#sup {
margin:15px 0px 40px 30px;
}
#sup .logo {
color:#<? echo $color1; ?>;
font-size:32px;
font-family:"Courier New", Courier, mono;
font-weight:bold;
}
#cuadro {
margin-left: -200px;
position: absolute;
left: 50%;
width: 400px;
height: 180px;
border:1px solid #<? echo $color1; ?>;
voice-family: "\"}\"";
voice-family: inherit;
width:398px;
height:178px;
}
html>body #cuadro {
width:398px;
height:178px;
}
#cuadro .bandasup {
background-color:#<? echo $color1; ?>;
font-size:17px;
color:#ffffff;
line-height:25px;
text-align:center;
border-bottom:1px solid #<? echo $color1; ?>;
margin-bottom:25px;
}
#cuadro .error {
font-size:11px;
color:#ff0000;
text-align:center;
margin-bottom:10px;
}
#cuadro #formulario .fila {
margin:0px 0px 10px 0px;
padding:0px 0px 0px 0px;
}
#cuadro #formulario .fila .titulo {
float:left;
width:170px;
text-align:right;
margin:3px 8px 0px 0px;
}
#cuadro #formulario .fila .input {
float:left;
width:200px;
text-align:left;
}
.sep {
clear:both;
height:1px;
margin:0px;
padding:0px;
font-size:1px;
line-height:1px;
}