<?php
<sav:function name="removeEmptyLines">
if (!defined ('TYPO3_MODE')) {
 	die ('Access denied.');
}
<f:if condition="{extension.general.1.compatibility} == 0">
	<sav:render partial="../CodeTemplates/ForSavLibraryPlus/Configuration/ExtLocalconf/TYPO6x7x/extLocalconf.phpt" arguments="{extension:extension}" /> 
</f:if>
<f:if condition="{extension.general.1.compatibility} == 1">
	<sav:render partial="../CodeTemplates/ForSavLibraryPlus/Configuration/ExtLocalconf/TYPO4x/extLocalconf.phpt" arguments="{extension:extension}" />
</f:if>
<f:if condition="{extension.general.1.compatibility} == 2">
if (version_compare(TYPO3_version, '6.0', '<')) {
	<sav:render partial="../CodeTemplates/ForSavLibraryPlus/Configuration/ExtLocalconf/TYPO4x/extLocalconf.phpt" arguments="{extension:extension}" />
} else {
	<sav:render partial="../CodeTemplates/ForSavLibraryPlus/Configuration/ExtLocalconf/TYPO6x7x/extLocalconf.phpt" arguments="{extension:extension}" />
}
</f:if>
</sav:function>
?>
