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


Relation n:n (subform)
----------------------



======================================================= =========== ============
Property                                                Data type   Default
======================================================= =========== ============
:ref:`Relation_n_n.addDelete`                           Boolean     0
:ref:`Relation_n_n.addSave`                             Boolean     0
:ref:`Relation_n_n.addUpDown`                           Boolean     0
:ref:`Relation_n_n.cutNewButtonIfNotSaved`              Boolean     0
:ref:`Relation_n_n.keepFieldsInSubForm`                 String      None
:ref:`Relation_n_n.labelOnTitle`                        Boolean     0
:ref:`Relation_n_n.maxSubformItems`                     Integer     0
:ref:`Relation_n_n.noFirstLast`                         Boolean     0
:ref:`Relation_n_n.subFormTemplate`                     String      None
:ref:`Relation_n_n.subformTitle`                        String      None
======================================================= =========== ============


.. _Relation_n_n.addDelete:

addDelete
^^^^^^^^^

Description
  A delete icon will be added in front of each item.

Data type
  Boolean

Default
  0


.. _Relation_n_n.addSave:

addSave
^^^^^^^

Description
  A save button and an anchor will be added. It simplifies the saving
  when several items are in the subform and the height of an item is
  important.

Data type
  Boolean

Default
  0


.. _Relation_n_n.addUpDown:

addUpDown
^^^^^^^^^

Description
  Two buttons (up and down) will be added. They can be used to
  reorganize the order of the subform items.

Data type
  Boolean

Default
  0


.. _Relation_n_n.cutNewButtonIfNotSaved:

cutNewButtonIfNotSaved
^^^^^^^^^^^^^^^^^^^^^^

Description
  The new button of the subform will be cut if the form in which the
  subform takes place is not saved.

Data type
  Boolean

Default
  0


.. _Relation_n_n.keepFieldsInSubForm:

keepFieldsInSubForm
^^^^^^^^^^^^^^^^^^^

Description
  The string is a comma-separated list of fields. Values of the fields
  (use tableName.fieldName) from the parent
  form will be kept in the subform. It can be used to deal with these
  values in the subform.

  If \* is used instead of the comma-separated list of fields, all
  fields are kept.  **Only for “basic” library type** .

Data type
  String

Default
  None


.. _Relation_n_n.labelOnTitle:

labelOnTitle
^^^^^^^^^^^^

Description
  The label will be displayed in the title of the subform in input mode.

Data type
  Boolean

Default
  0


.. _Relation_n_n.maxSubformItems:

maxSubformItems / maxSubItems
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Description
  Number of items that will be displayed in the subform. All items are
  displayed if set to 0.

  **Use maxSubformItems for “plus” library type** .

Data type
  Integer

Default
  0


.. _Relation_n_n.noFirstLast:

noFirstLast
^^^^^^^^^^^

Description
  First and last buttons in the browser associated with the subform will
  not be shown.

Data type
  Boolean

Default
  0


.. _Relation_n_n.subFormTemplate:

subFormTemplate
^^^^^^^^^^^^^^^

Description
  Name of the template (e.g. subFormAlt). By default the template
  "subForm" is used.  **Only for “basic” library type** .

Data type
  String

Default
  None


.. _Relation_n_n.subformTitle:

subformTitle
^^^^^^^^^^^^

Description
  If set, the string will be displayed in the title bar of the subform.
  Localization tags and markers can be used.  **Only for “plus” library
  type**.

Data type
  String

Default
  None



