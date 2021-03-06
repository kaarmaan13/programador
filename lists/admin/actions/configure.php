<?php

$status = '';

if (empty($_REQUEST['id'])) {
  $id = '';
} else {
  $id = $_REQUEST['id'];
  if (!isset($default_config[$id])) {
    print $GLOBALS['I18N']->get('invalid request');
    return;
  }
}

/*
printf('<script type="text/javascript">
$(".configValue").each(function() {
  if (this.id != "edit_%s") {
    this.innerHTML = "Not editing";
  }
});
</script>',$id);
*/

$configItem = $default_config[$id];
printf('<div class="configEditing">' . s('Editing') . ' <b>%s</b></div>',$configItem['description']);
printf('<div class="configValue" id="edit_%s"><input type="hidden" name="id" value="%s" />',$id,$id);
$dbval = getConfig($id);
#  print $dbval.'<br/>';
if (isset($dbval))
  $value = $dbval;
else
  $value = $configItem['value'];
#  print $id.' '.$value . " ".$website . " ".$domain.'<br/>';

if ($id != "website" && $id != "domain") {
  $value = str_replace($GLOBALS['website'],'[WEBSITE]', $value);
  $value = str_replace($GLOBALS['domain'],'[DOMAIN]', $value);
}

#  print "VALUE:".$value . '<br/>';
if ($configItem['type'] == "textarea") {
  printf('<textarea name="values[%s]" rows=25 cols=55>%s</textarea>',
    $id,htmlspecialchars(stripslashes($value)));
} else if (
  $configItem['type'] == "text" || $configItem['type'] == "url" || 
  $configItem['type'] == "email" || $configItem['type'] == "emaillist" 
  ) {
  printf('<input type="text" name="values[%s]" size="70" value="%s" />',
  $id,htmlspecialchars(stripslashes($value)));
} else if ($configItem['type'] == "integer") {
  printf('<input type="text" name="values[%s]" size="70" value="%d" />',
  $id,htmlspecialchars(stripslashes($value)));
} else if ($configItem['type'] == "boolean") {
  printf ('<select name="values[%s]">',$id);
  print '<option value="true" ';
  if ($value === true || $value == "true" || $value == 1) {
    print 'selected="selected"';
  }
  print '>';
  print $GLOBALS['I18N']->get('Yes') ;
  print '  </option>';
  print '<option value="false" ';
  if ($value === false || $value == "false" || $value == 0) {
    print 'selected="selected"';
  }
  print '>';
  print $GLOBALS['I18N']->get('No') ;
  print '  </option>';
  print '</select>';
} else {
  print s('Don\'t know how to handle type '.$configItem['type']);
}
if (isset($_GET['ret']) && $_GET['ret'] == 'catlists') {
    print '<input type="hidden" name="ret" value="catlists" />';
}
print '<input type="hidden" name="save" value="item_'.$id.'" />
<button class="submit" type="submit" name="savebutton">' . s('save changes') . '</button>';

## for cancellation, we use a reset button, but that will reset all values in the entire page
## https://mantis.phplist.org/view.php?id=16924 

## UX wise, it would be good to close the editing DIV again.
print '<button class="dontsavebutton" id="dontsaveitem_'.$id.'" type="reset">' . s('undo') . '</button>';

## another option is to use a link back to configure, but that will go back to top, which isn't great UX either.
#print '<a href="./?page=configure" class="button">'.s('cancel changes').'</a>';

print '</div>';
