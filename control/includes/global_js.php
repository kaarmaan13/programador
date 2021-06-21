<script type="text/javascript">
	function subopciones(i) {
		valor=document.getElementById("subopciones"+i).style.display;
		for (ind=0;ind<<? echo sizeof($global_menu_opcion)?>;ind++)
			document.getElementById("subopciones"+ind).style.display='none';
		if (valor=='block')
			document.getElementById("subopciones"+i).style.display='none';
		else
			document.getElementById("subopciones"+i).style.display='block';
	}
	var pong;
	function makeArray(n){
	  this.length = n;
	  for (i=1;i<=n;i++){
		this[i]=0;
	  }
	  return this;
	}	
	function displayDate() {
	  var this_month = new makeArray(12);
	  this_month[0]  = "Enero";
	  this_month[1]  = "Febrero";
	  this_month[2]  = "Marzo";
	  this_month[3]  = "Abril";
	  this_month[4]  = "Mayo";
	  this_month[5]  = "Junio";
	  this_month[6]  = "Julio";
	  this_month[7]  = "Agosto";
	  this_month[8]  = "Septiembre";
	  this_month[9]  = "Octubre";
	  this_month[10] = "Noviembre";
	  this_month[11] = "Diciembre";
	
	  var this_day_e = new makeArray(7);
	  this_day_e[0]  = "Domingo";
	  this_day_e[1]  = "Lunes";
	  this_day_e[2]  = "Martes";
	  this_day_e[3]  = "Miércoles";
	  this_day_e[4]  = "Jueves";
	  this_day_e[5]  = "Viernes";
	  this_day_e[6]  = "Sábado";
	
	  var today = new Date();
	  var day   = today.getDate();
	  var month = today.getMonth();
	  var year  = today.getYear();
	  var dia = today.getDay();
		if (year < 1000) {
		   year += 1900; }
	  return( " " + this_day_e[dia] + ", " + day + " de " + this_month[month] + " " + year);
	}
	
	/* Popup */
	PositionX = 100;
	PositionY = 100;
	defaultWidth  = 500;
	defaultHeight = 500;
	var AutoClose = false;
	if (parseInt(navigator.appVersion.charAt(0))>=4) {
		var isNN=(navigator.appName=="Netscape")?1:0;
		var isIE=(navigator.appName.indexOf("Microsoft")!=-1)?1:0;
	}
	var optNN='scrollbars=no,width='+defaultWidth+',height='+defaultHeight+',left='+PositionX+',top='+PositionY;
	var optIE='scrollbars=no,width=150,height=100,left='+PositionX+',top='+PositionY;
	
	function popup(imageURL,imageTitle) {
		if (isNN){imgWin=window.open('about:blank','',optNN);}
		if (isIE){imgWin=window.open('about:blank','',optIE);}
		with (imgWin.document) {
			writeln('<html><head><title>Cargando ...</title><style>body{margin:0px;}</style>');writeln('<sc'+'ript>');
			writeln('var isNN,isIE;');writeln('if (parseInt(navigator.appVersion.charAt(0))>=4){');
			writeln('isNN=(navigator.appName=="Netscape")?1:0;');writeln('isIE=(navigator.appName.indexOf("Microsoft")!=-1)?1:0;}');
			writeln('function reSizeToImage(){');writeln('if (isIE){');writeln('window.resizeTo(100,100);');
			writeln('width=122-(document.body.clientWidth-document.images[0].width);');
			writeln('height=100-(document.body.clientHeight-document.images[0].height);');
			writeln('window.resizeTo(width,height);}');writeln('if (isNN){');
			writeln('window.innerWidth=document.images["imagenes"].width;');writeln('window.innerHeight=document.images["imagenes"].height;}}');
			writeln('function doTitle(){document.title="'+imageTitle+'";}');writeln('</sc'+'ript>');
			if (!AutoClose) writeln('</head><body bgcolor=000000 scroll="no" onload="reSizeToImage();doTitle();self.focus()">')
			else writeln('</head><body bgcolor=ffffff scroll="no" onload="reSizeToImage();doTitle();self.focus()" onblur="self.close()">');
			writeln('<img name="imagenes" src='+imageURL+' style="display:block"></body></html>');
			close();
		}
	}
	/* /Popup */
	
	/* Comprobación entero */
	function justNumbers(e) {
		var keynum = window.event ? window.event.keyCode : e.which;
		if ( keynum == 8 ) return true;
		return /\d/.test(String.fromCharCode(keynum));
	}
	/* /Comprobación entero */
</script>