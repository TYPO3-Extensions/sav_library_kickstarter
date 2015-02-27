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


Selectorbox
-----------


======================================================= =========== ============
Property                                                Data type   Default
======================================================= =========== ============
:ref:`Selectorbox.func`                                 Integer     see TCA
:ref:`Selectorbox.separator`                            String      None
======================================================= =========== ============


.. _Selectorbox.func:

func
^^^^
   
Description
  It associates a function with the selectorbox items. The parameter
  function\_name can be:
         
  - makeItemLink
         
  - makeExtLink
         
  - makeLink
         
  - makeUrlLink
         
  - makeEmailLink
         
  See :ref:`functions` for the associated parameters .
   
Data type
  Function name
   
Default
  None


.. _Selectorbox.separator:

separator
^^^^^^^^^
   
Description
  It can be used with selector boxes associated with a MM relation to
  replace the default <br /> separator between items in showAll or
  showSingle views.
   
Data type
  character or string
   
Default
  None



