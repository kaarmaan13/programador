<?
  	// Cambio CHMOD del directorio control/images
	$conn_id = ftp_connect("$global_db_servidor");
	ftp_login($conn_id, $global_ftp_user, $global_ftp_password);
	if(!dir($_SERVER["DOCUMENT_ROOT"].$directorio))
		ftp_mkdir($conn_id, $global_ftp_dir.$directorio);
	if(substr(sprintf('%o', fileperms($_SERVER["DOCUMENT_ROOT"].$directorio)), -4) != "0777")
		ftp_site($conn_id, 'CHMOD 777, '.$global_ftp_dir.$directorio);
	ftp_close($conn_id);
?>