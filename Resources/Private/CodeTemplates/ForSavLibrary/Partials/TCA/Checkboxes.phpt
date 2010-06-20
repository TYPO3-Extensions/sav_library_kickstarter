'type' => 'check',
'cols' => 4,
'items' => array (
<f:for each="{field.items}" as="item" key="itemKey">
  array('LLL:EXT:{extensionKey}/locallang_db.xml:{model}.{field.fieldname}.I.{itemKey}', ''),
</f:for>
),
