.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
  :class:  typoscript
.. role::   php(code)


Relation 1:n (Selectorbox) or relation n:n (Double selectorbox)
---------------------------------------------------------------



======================================================= =========== ============
Property                                                Data type   Default
======================================================= =========== ============
:ref:`Relation_1_n.aliasSelect`                         Field name  None
:ref:`Relation_1_n.additionalTableSelect`               String      None
:ref:`Relation_1_n.applyFuncToRecords`                  Boolean     0
:ref:`Relation_1_n.groupBySelect`                       String      None
:ref:`Relation_1_n.labelSelect`                         Field name  None
:ref:`Relation_1_n.orderSelect`                         String      None
:ref:`Relation_1_n.overrideEnableFields`                Boolean     0
:ref:`Relation_1_n.overrideStartingPoint`               Boolean     0
:ref:`Relation_1_n.separator`                           String      None
:ref:`Relation_1_n.singleWindow`                        Boolean     0
:ref:`Relation_1_n.specialFields`                       String      None
:ref:`Relation_1_n.whereSelect`                         String      None
======================================================= =========== ============


.. _Relation_1_n.additionalTableSelect:

additionalTableSelect
^^^^^^^^^^^^^^^^^^^^^
   
Description
  The string is a comma-separated table names.
  It Adds the table names in the select query. It can be used when tables
  need to be joined.
   
Data type
  String
   
Default
  None


.. _Relation_1_n.aliasSelect:

aliasSelect
^^^^^^^^^^^
   
Description
  Defines an alias used in the SELECT query. Markers ###fieldname### can
  be used, fieldname must be in the relation table.
   
Data type
  Field name
   
Default
  None


.. _Relation_1_n.applyFuncToRecords:

applyFuncToRecords
^^^^^^^^^^^^^^^^^^
   
Description
  If true the function defined by the “func” attribute is applied to
  each record of a double selector in the single view.  **Only for
  “plus” library type** .
   
Data type
  Boolean
   
Default
  0
  
  
.. _Relation_1_n.content:

content
^^^^^^^
   
Description
  SQL SELECT statement must have an alias "uid" and an alias "label"
  which will be used as the value to display. Special markers can be
  used in the statement :
         
  - ###uid### will be replaced by the current record uid.
         
  - ###uidSelected### will be replaced by the selected item.
         
  - ###user### will be replaced by the user id.
         
  - ###cruser### will be replaced by the user id.
         
  The following example returns a selectorbox with the usernames that
  are linked with the user by a MM relation:
         
  ::
         
    content = 
    SELECT fe_users.uid as uid, fe_users.name as label 
    FROM tx_mytable_rel_myfield_mm,fe_users 
    WHERE tx_mytable_rel_myfields_mm.uid_local=###user###
    AND tx_mytable_rel_myfields_mm.uid_foreign=fe_users.uid
    ORDER by label;
   
Data type
  SQL SELECT statement
   
Default
  None


.. _Relation_1_n.groupBySelect:

groupBySelect
^^^^^^^^^^^^^
   
Description
  Defines the GROUP BY clause for the selector.
   
Data type
  String
   
Default
  None
  

.. _Relation_1_n.labelSelect:

labelSelect
^^^^^^^^^^^
   
Description
  Defines the label from the field name for the selector.
   
Data type
  Field name
   
Default
  None


.. _Relation_1_n.orderSelect:

orderSelect
^^^^^^^^^^^
   
Description
  Define the order clause for the selector. In general: fieldname
  [desc].
   
Data type
  String
   
Default
  None


.. _Relation_1_n.overrideEnableFields:

overrideEnableFields
^^^^^^^^^^^^^^^^^^^^
   
Description
  If set, the method enableFields of the class tslib\_cObj which filters
  out records with start/end times or hidden/fe\_groups fields is not
  applied to the query associated with the selectorbox.
         
  It may be used in specific cases when you needed to retreive all the
  records.
   
Data type
  Boolean
   
Default
  0


.. _Relation_1_n.overrideStartingPoint:

overrideStartingPoint
^^^^^^^^^^^^^^^^^^^^^
   
Description
  By default, when starting points are provided, information associated
  with the selector is searched in these page. This property overrides
  the default behavior.
   
Data type
  Boolean
   
Default
  0

.. _Relation_1_n.separator:

separator
^^^^^^^^^
   
Description
  It should be used when the max number of relations is greater than 1
  (not true MM-relation) to replace the default <br /> separator between
  items in showAll or showSingle views.
   
Data type
  String
   
Default
  None

  
.. _Relation_1_n.singleWindow:

singleWindow
^^^^^^^^^^^^
   
Description
  In case of a MM relation, a double window is used to select items.
  When this option is used, a single selectorbox in multiple mode is
  used.
   
Data type
  Boolean
   
Default
  0


.. _Relation_1_n.specialFields:

specialFields
^^^^^^^^^^^^^
   
Description
  The value of the fields will be propagated in the
  ###special[fieldname]### marker when available.
   
Data type
  comma-separated list of fields
   
Default
  None


.. _Relation_1_n.whereSelect:

whereSelect
^^^^^^^^^^^
   
Description
  Defines the WHERE clause for the selector. It can be:
         
  - a conventional MySQL clause.- The marker ###user### can be used. It
    will be replaced by the user uid.- The marker ###uid### can be used.
    it will be replaced by the main current record.- The marker
    ###CURRENT\_PID### can be used. It will be replaced by the current
    page uid.- The marker ###STORAGE\_PID### can be used. It will be
    replaced by the storage page uid.
         
  - ###group\_list = list\_of\_comma\_separed\_fe\_groups###. To be used
    with a selector on fe\_users. It checks if the user belongs to the
    group list.
         
  - ###group\_list != list\_of\_comma\_separed\_fe\_groups###. To be used
    with a selector on fe\_users. It checks if the user does not belong to
    the group list.
   
Data type
  String
   
Default
  None








