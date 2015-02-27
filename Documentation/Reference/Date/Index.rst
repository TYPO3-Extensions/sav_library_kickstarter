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


Date
----


======================================================= =========== ============
Property                                                Data type   Default
======================================================= =========== ============
:ref:`Date.format`                                      Date format %d/%m/%Y
:ref:`Date.noDefault`                                   Boolean     0
======================================================= =========== ============


.. _Date.format:

format
^^^^^^
   
Description
  Sets a format to display the date. The format is the same as in
  strftime php function.
         
  Example: full weekday and month names plus year
         
  ::
         
    format = %A %B %Y;
   
Data type
  Date format
   
Default
  %d/%m/%Y


.. _Date.noDefault:

noDefault
^^^^^^^^^
   
Description
  Do not display the default date.
   
Data type
  Boolean
   
Default
  0

