'type' => 'select',
'items' => array (
<f:for each="{field.items}" as="item" key="itemKey">
  array('LLL:EXT:{extension.general.1.extensionKey}/Resources/Private/Language/locallang_db.xml:{model}.{field.fieldname}.I.{itemKey}', '{item.value}'),
</f:for>
),
'size' => 1,
'maxitems' => 1,
