<?php
/*
  We request you retain the full headers below including the links.
  This not only gives respect to the large amount of time given freely
  by the developers, but also helps build interest, traffic and use of
  phpList, which is beneficial to it's future development.

  Michiel Dethmers, phpList Ltd 2003 - 2015
  * 
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $_SESSION['adminlanguage']['iso']?>" lang="<?php echo $_SESSION['adminlanguage']['iso']?>" dir="<?php echo $_SESSION['adminlanguage']['dir']?>">
<head>
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
<meta name="License" content="GNU Affero General Public License, http://www.gnu.org/licenses/agpl.html" />
<meta name="Author" content="Michiel Dethmers - https://www.phplist.com" />
<meta name="Copyright" content="Michiel Dethmers, phpList Ltd - http://phplist.com" />
<meta name="Powered-By" content="phplist version <?php echo VERSION?>" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="SHORTCUT ICON" id="favicon" href="./images/phplist.ico" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<!-- initial styles and JS from basic application -->
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.1.all.min.js"></script>
<script type="text/javascript" src="js/jquery.tools.scrollable.js"></script>
<script type="text/javascript" src="js/phplistapp.js"></script>
<link rel="stylesheet" href="css/reset.css" />
<link href="css/jquery-ui-1.8.1.all.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/app.css" />
<link rel="stylesheet" href="css/menu.css" />

<!-- now override the above with the styles and JS from the UI theme -->
<script type="text/javascript" src="ui/dressprow/js/jquery.tablednd.js"></script>
<script type="text/javascript" src="ui/dressprow/js/phplist.js"></script>
<link rel="stylesheet" href="ui/dressprow/css/base.css" />
<link rel="stylesheet" href="ui/dressprow/css/layout.css" />
<link rel="stylesheet" href="ui/dressprow/css/skeleton.css" />
<link rel="stylesheet" href="ui/dressprow/css/style.css" />
<link rel="stylesheet" href="ui/dressprow/css/gray.css" />

<!-- Style for rtl language <link rel="stylesheet" href="ui/dressprow/css/style_rtl.css" /> -->

<?php
if (isset($GLOBALS['config']['head'])) {
  foreach ($GLOBALS['config']['head'] as $sHtml) {
    print $sHtml;
    print "\n";
    print "\n";
  }
}
