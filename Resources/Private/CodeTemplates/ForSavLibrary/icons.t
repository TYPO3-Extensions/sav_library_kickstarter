<sav:comment><!-- Create icon.gif --></sav:comment>
<sav:function name="copyFile" arguments="{
  source:'Resources/Private/CodeTemplates/ForSavLibrary/Resources/Icons/ext_icon.gif',
  destinationExtension:extension.general.1.extensionKey,
  destination:'ext_icon.gif'
}" />

<sav:comment><!-- Create the files icons --></sav:comment>
<f:for each="{extension.newTables}" as="table">
  <sav:function name="copyFile" arguments="{
    source:'Resources/Private/CodeTemplates/ForSavLibrary/Resources/Icons/{table.defIcon}.gif',
    destinationExtension:extension.general.1.extensionKey,
    destination:'icon_{sav:BuildTableName(shortName:table.tablename,extensionKey:extension.general.1.extensionKey)}.gif'
  }" />
</f:for>
