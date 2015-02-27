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



Checkboxes: several checkboxes
------------------------------

======================================================= =========== ============
Property                                                Data type   Default
======================================================= =========== ============
:ref:`Checkboxes.checkboxSelectedImage`                 String      None
:ref:`Checkboxes.checkboxNotSelectedImage`              String      None
:ref:`Checkboxes.cols`                                  Integer     1
:ref:`Checkboxes.displayAsImage`                        Boolean     1 (0 for “basic”)
:ref:`Checkboxes.doNotDisplayIfNotChecked`              Boolean     0
:ref:`Checkboxes.nbItems`                               Integer     1
======================================================= =========== ============


.. _Checkboxes.checkboxSelectedImage:

checkboxSelectedImage
^^^^^^^^^^^^^^^^^^^^^

Description
  The string is used as a file name which is searched in the default
  icon directory and, if not found, in the extension icon directory. It
  replaces the default image for a selected checkbox.  **Not available
  in “basic” type library** .

Data type
  String

Default
  None


.. _Checkboxes.checkboxNotSelectedImage:

checkboxNotSelectedImage
^^^^^^^^^^^^^^^^^^^^^^^^

Description
  The string is used as a file name which is searched in the default
  icon directory and, if not found, in the extension icon directory. It
  replaces the default image for an unselected checkbox.  **Not
  available in “basic” type library** .

Data type
  String

Default
  None


.. _Checkboxes.cols:

cols
^^^^

Description
  Number of columns to display.

Data type
  Integer

Default
  1


.. _Checkboxes.displayAsImage:

displayAsImage
^^^^^^^^^^^^^^

Description
  If set, the check boxes are displayed as images instead of labels.

Data type
  Boolean

Default
  1 (0 for “basic”)


.. _Checkboxes.doNotDisplayIfNotChecked:

doNotDisplayIfNotChecked
^^^^^^^^^^^^^^^^^^^^^^^^

Description
  If set, do not display the check box value if it is not checked
  (obviously it does not apply when in edit mode).

Data type
  Boolean

Default
  0


.. _Checkboxes.nbItems:

nbItems
^^^^^^^

Description
  Number of items to display.

Data type
  Integer

Default
  None


