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


Date and time
-------------


======================================================= =========== ============
Property                                                Data type   Default
======================================================= =========== ============
:ref:`DateAndTime.format`                               Date format %d/%m/%Y %H:%M
:ref:`DateAndTime.noDefault`                            Boolean     0
======================================================= =========== ============



.. _DateAndTime.format:

format
^^^^^^
   
Description
  Sets a format to display the date. The format is the same as in
  strftime php function.
         
  Example: full weekday and month names plus year and time
         
  ::
         
    format = %A %B %Y at %H:%M;
   
Data type
  Date format
   
Default
  %d/%m/%Y %H:%M


.. _DateAndTime.noDefault:

noDefault
^^^^^^^^^
   
Description
  Do not display the default date.
   
Data type
  Boolean
   
Default
  0
