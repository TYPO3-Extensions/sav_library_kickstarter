'type' => 'select',
<f:alias map="{custom:'_CUSTOM'}">
<f:if condition="{field.conf_rel_table} == {custom}">
<f:then>
'foreign_table' => '{field.conf_custom_table_name}',
'foreign_table_where' => 'ORDER BY {field.conf_custom_table_name}.uid',
</f:then>
<f:else>
'foreign_table' => '{field.conf_rel_table}',
'foreign_table_where' => 'ORDER BY {field.conf_rel_table}.uid',
</f:else>
</f:if>
</f:alias>
'size' => {f:if(condition:field.conf_relations_selsize,then:field.conf_relations_selsize,else:1)},
'minitems' => 0,
'maxitems' => {f:if(condition:field.conf_relations,then:field.conf_relations,else:1)},
<f:if condition="{field.conf_relations_mm}">
'MM' => '{model}_{field.fieldname}_mm',
</f:if>
