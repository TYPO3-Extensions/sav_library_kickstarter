<f:alias map="{where:{
  all: 'AND 1',
  select_cur: 'AND {field.conf_rel_table}.pid=###CURRENT_PID###',
  select_root: 'AND {field.conf_rel_table}.pid=###SITEROOT###',
  select_storage: 'AND {field.conf_rel_table}.pid=###STORAGE_PID###'
}, custom:'_CUSTOM'}">
<sav:alias map="{whereClause:'{where.{field.conf_rel_type}}'}">
'type' => 'select',
<f:if condition="{field.conf_rel_dummyitem}">
'items' => array (
	array('',0),
),
</f:if>
<f:if condition="{field.conf_rel_table} == {custom}">
<f:then>
'foreign_table' => '{field.conf_custom_table_name}',
'foreign_table_where' => '{whereClause} ORDER BY {field.conf_custom_table_name}.uid',
</f:then>
<f:else>
'foreign_table' => '{field.conf_rel_table}',
'foreign_table_where' => '{whereClause} ORDER BY {field.conf_rel_table}.uid',
</f:else>
</f:if>
'size' => 1,
'minitems' => 0,
'maxitems' => 1,
</sav:alias>
</f:alias>
