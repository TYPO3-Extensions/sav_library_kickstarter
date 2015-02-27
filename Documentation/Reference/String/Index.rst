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


String
------


======================================================= =========== ============
Property                                                Data type   Default
======================================================= =========== ============
:ref:`String.size`                                      Integer     see TCA
:ref:`String.keepZero`                                  Boolean     0
======================================================= =========== ============


.. _String.size:

size
^^^^
   
Description
  Size of the field.
   
Data type
  Integer
   
Default
  30


.. _String.keepZero:

keepZero
^^^^^^^^
   
Description
  If set and the field is equal to zero the "0" is displayed otherwise
  an empty field is displayed.
   
Data type
  Boolean
   
Default
  0
