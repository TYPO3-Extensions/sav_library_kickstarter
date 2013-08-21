<f:alias map="{where:{
  all: 'AND 1',
  select_cur: 'AND {field.conf_rel_table}.pid=###CURRENT_PID###',
  select_root: 'AND {field.conf_rel_table}.pid=###SITEROOT###',
  select_storage: 'AND {field.conf_rel_table}.pid=###STORAGE_PID###'
}, custom:'_CUSTOM'}">
<f:alias map="{whereClause:'{where.{field.conf_rel_type}}'}">
'type' => 'select',
<f:if condition="{field.conf_rel_table} == {custom}">
<f:then>
'foreign_table' => '{field.conf_custom_table_name}',
'foreign_table_where' => 'ORDER BY {field.conf_custom_table_name}.uid',
</f:then>
<f:else>
'foreign_table' => '{field.conf_rel_table}',
'foreign_table_where' => '{whereClause} ORDER BY {field.conf_rel_table}.uid',
</f:else>
</f:if>
'size' => {f:if(condition:field.conf_relations_selsize,then:field.conf_relations_selsize,else:1)},
'minitems' => 0,
'maxitems' => {f:if(condition:field.conf_relations,then:field.conf_relations,else:100000)},
<f:if condition="{field.conf_relations_mm}">
'MM' => '{model}_{field.fieldname}_mm',
</f:if>
</f:alias>
</f:alias>