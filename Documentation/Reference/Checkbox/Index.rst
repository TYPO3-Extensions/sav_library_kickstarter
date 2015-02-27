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



Checkbox: simple checkbox
-------------------------

======================================================= =========== ============
Property                                                Data type   Default
======================================================= =========== ============
:ref:`Checkbox.checkboxSelectedImage`                   String      None
:ref:`Checkbox.checkboxNotSelectedImage`                String      None
:ref:`Checkbox.displayAsImage`                          Boolean     1 (0 for “basic”)
:ref:`Checkbox.doNotDisplayIfNotChecked`                Boolean     0
======================================================= =========== ============


.. _Checkbox.checkboxSelectedImage:
         
checkboxSelectedImage
^^^^^^^^^^^^^^^^^^^^^

Description
  The string is used as a file name which is searched in the icon
  directory. It replaces the default image for a selected checkbox.
  **Not available in “basic” type library** .
   
Data type
  String
     
Default
  None

  
 
.. _Checkbox.checkboxNotSelectedImage:

checkboxNotSelectedImage
^^^^^^^^^^^^^^^^^^^^^^^^

Description
  The string is used as a file name which is searched in the icon
  directory. It replaces the default image for an unselected checkbox.
  **Not available in “basic” type library** .

Data type
  String
   
Default
  None
  
  
.. _Checkbox.displayAsImage:

displayAsImage
^^^^^^^^^^^^^^

Description
  If set, the check box is displayed as an image instead of a label.
  
Data type
  Boolean
     
Default
  1 (0 for “basic”)


.. _Checkbox.doNotDisplayIfNotChecked:

doNotDisplayIfNotChecked
^^^^^^^^^^^^^^^^^^^^^^^^
   
Description
  If set, do not display the check box value if it is not checked
  (obviously it does not apply when in edit mode).
   
Data type
  Boolean
   
Default
  0



