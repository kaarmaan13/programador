<?php
switch ($page) {
  case 'home': $page_title = 'Dashboard';break;
  case 'setup': $page_title = 'Configuration';break;
  case 'about': $page_title = 'About '.NAME;break;
  case 'attributes': $page_title = 'Configure attributes';break;
  case 'stresstest': $page_title = 'Stress test';break;
  case 'list': $page_title = 'Subscriber lists';break;
  case 'catlists': $page_title = 'Categorise lists';break;
  case 'editattributes': $page_title = 'Configure attributes';break;
  case 'editlist': $page_title = 'Edit a list';break;
  case 'checki18n': $page_title = 'Check that translations exist';break;
  case 'importsimple': $page_title = 'Import subscribers by cut-and-paste';break;
  case 'import4': $page_title = 'Import subscribers from a remote database';break;
  case 'import3': $page_title = 'Import subscribers from IMAP';break;
  case 'import2': $page_title = 'Import subscribers from CSV file';break;
  case 'import1': $page_title = 'Import subscribers from text file';break;
  case 'import': $page_title = 'Import emails';break;
  case 'export': $page_title = 'Export subscribers';break;
  case 'initialise': $page_title = 'Initialise the database';break;
  case 'send': $page_title = 'Send a Campaign';break;
  case 'preparesend': $page_title = 'Prepare a message for sending';break;
  case 'sendprepared': $page_title = 'Send a prepared message';break;
  case 'members': $page_title = 'List membership';break;
  case 'users': $page_title = 'Search subscribers';break;
  case 'reconcileusers': $page_title = 'Reconcile subscribers';break;
  case 'user': $page_title = 'Details of a subscriber';break;
  case 'userhistory': $page_title = 'History of a subscriber';break;
  case 'messages': $page_title = 'List of campaigns';break;
  case 'message': $page_title = 'View a campaign';break;
  case 'processqueue': $page_title = 'Send the queue';break;
  case 'defaults': $page_title = 'Some useful default attributes';break;
  case 'upgrade': $page_title = 'Upgrade '.NAME;break;
  case 'templates': $page_title = 'Manage campaign templates';break;
  case 'template': $page_title = 'Add or edit a template';break;
  case 'viewtemplate': $page_title = 'Template preview';break;
  case 'configure': $page_title = 'Settings';break;
  case 'admin': $page_title = 'Edit or add an administrator';break;
  case 'admins': $page_title = 'List administrators';break;
  case 'adminattributes': $page_title = 'Configure administrator attributes';break;
  case 'processbounces': $page_title = 'Retrieve bounces from server';break;
  case 'bounces': $page_title = 'View bounces';break;
  case 'bounce': $page_title = 'View a bounce';break;
  case 'spageedit': $page_title = 'Edit a subscribe page';break;
  case 'spage': $page_title = 'Subscribe pages';break;
  case 'eventlog': $page_title = 'Log of events';break;
  case 'getrss': $page_title = 'Retrieve RSS feeds';break;
  case 'viewrss': $page_title = 'View RSS Items';break;
  case 'community': $page_title = 'Help'; break;#$page_title = 'Welcome to the phpList community';break;
  case 'vote': $page_title = 'Vote for phpList';break;
  case 'login': $page_title = 'Login';break;
  case 'logout': $page_title = 'Log out';break;
  case 'mclicks': $page_title = 'Campaign click statistics'; break;
  case 'uclicks': $page_title = 'URL click statistics'; break;
  case 'massunconfirm': $page_title = 'Suppression list';break;
  case 'massremove': $page_title = 'Remove subscribers'; break;
  case 'usermgt': $page_title = 'Manage subscribers'; break;
  case 'bouncemgt': $page_title = 'Manage bounces'; break;
  case 'domainstats': $page_title = 'Domain statistics'; break;
  case 'mviews': $page_title = 'View opens'; break;
  case 'statsmgt': $page_title = 'Manage statistics'; break;
  case 'statsoverview': $page_title = 'Statistics overview'; break;
  case 'subscriberstats': $page_title = 'Subscriber statistics'; break;
  case 'dbcheck': $page_title = 'Verify the DB structure'; break;
  case 'importadmin': $page_title = 'Import administrators'; break;
  case 'dbadmin': $page_title = ''; break;
  case 'usercheck': $page_title = 'Verify that subscribers exist in the system';break;
  case 'listbounces': $page_title = 'View bounces per list';break;
  case 'bouncerules': $page_title = 'Bounce rules';break;
  case 'checkbouncerules': $page_title = 'Check bounce rules';break;
  case 'translate': $page_title = 'Translate phpList';break;
  case 'ajaxform': $page_title = 'Ajax integration';break;
  case 'updatetranslation': $page_title = 'Update translations'; break;
  case 'reindex': $page_title = 'Re-index DB'; break;
  case 'plugins': $page_title = 'Manage Plugins'; break;

  default: $page_title = $page;
    if (0) { ## discover new titles
      file_put_contents('/tmp/pagetitles.php',' case \''.$page.'\'\: $page_title = ""; break;'."\n",FILE_APPEND);
    }
}
?>
