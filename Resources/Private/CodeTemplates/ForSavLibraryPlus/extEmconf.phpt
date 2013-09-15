<?php

/***************************************************************
* Extension Manager/Repository config file for ext: "{extension.general.1.extensionKey}"
*
* Auto generated by SAV Library Kickstarter <f:format.date>now</f:format.date>
*
* Manual updates:
* Only the data in the array - anything else is removed by next write.
* "version" and "dependencies" must not be touched!
***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => '{sav:function(name:"addSlashes", arguments:"{extension.emconf.1.title}")}',
	'description' => '{sav:function(name:"addSlashes", arguments:"{extension.emconf.1.description}")}',
	'category' => 'plugin',
	'author' => '{sav:function(name:"addSlashes", arguments:"{extension.emconf.1.author}")}',
	'author_email' => '{sav:function(name:"addSlashes", arguments:"{extension.emconf.1.author_email}")}',
	'author_company' => '',
	'shy' => '',
	'priority' => '',
	'module' => '',
	'state' => '{extension.emconf.1.state}',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '{extension.emconf.1.version}',
	'constraints' => array(
		'depends' => array(
			'typo3' => '4.5.0-6.1.99',	
{sav:buildConstraintsForExtensionManager(dependencies:extension.emconf.1.dependencies)}	
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);

?>
