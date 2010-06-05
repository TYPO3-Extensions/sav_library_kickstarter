'type' => 'group',
'internal_type' => 'db',
'allowed' => '{field.conf_rel_table}',
'size' => {f:if(condition:field.conf_relations_selsize,then:field.conf_relations_selsize,else:1)},
'minitems' => 0,
'maxitems' => {f:if(condition:field.conf_relations,then:field.conf_relations,else:1)},
<f:if condition="{field.conf_norelation} == 1">
  <f:then>
'norelation' => 1,
  </f:then>
  <f:else>
    <f:if condition="{field.conf_relations_mm}">
'MM' => '{model}_{field.fieldname}_mm',
    </f:if>
  </f:else>
</f:if>



