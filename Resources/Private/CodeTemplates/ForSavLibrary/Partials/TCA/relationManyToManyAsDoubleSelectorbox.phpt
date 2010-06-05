'type' => 'select',
'foreign_table' => '{field.conf_rel_table}',
'foreign_table_where' => 'ORDER BY {field.conf_rel_table}.uid',
'size' => {f:if(condition:field.conf_relations_selsize,then:field.conf_relations_selsize,else:1)},
'minitems' => 0,
'maxitems' => {f:if(condition:field.conf_relations,then:field.conf_relations,else:1)},
<f:if condition="{field.conf_relations_mm}">
'MM' => '{model}_{field.fieldname}_mm',
</f:if>

