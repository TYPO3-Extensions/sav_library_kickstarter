'type' => 'inline',
'foreign_table' => '{field.conf_rel_table}',
'appearance' => array(
  'collapseAll' => 1,
  'expandSingle' => 1,
),
'size' => {f:if(condition:field.conf_relations_selsize,then:field.conf_relations_selsize,else:1)},
'minitems' => 0,
'maxitems' => {f:if(condition:field.conf_relations,then:field.conf_relations,else:100000)},
<f:if condition="{field.conf_norelation} == 1">
  <f:then>
'norelation' => 1,
  </f:then>
  <f:else>
'MM' => '{model}_{field.fieldname}_mm',
  </f:else>
</f:if>



