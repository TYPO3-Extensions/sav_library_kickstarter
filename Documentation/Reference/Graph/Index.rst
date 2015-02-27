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


Graph
-----


======================================================= =========== ============
Property                                                Data type   Default
======================================================= =========== ============
:ref:`Graph.graphTemplate`                              String      None
:ref:`Graph.markers`                                    String      None
======================================================= =========== ============


.. _Graph.graphTemplate:

graphTemplate
^^^^^^^^^^^^^
   
Description
  File name of the XML template from the site root.
   
Data type
  String
   
Default
  None


.. _Graph.markers:

markers
^^^^^^^
   
Description
  Comma-separated list of definitions. Example: “marker#begin =
  ###beginPeriod###” means that the “marker” whose id is “begin” in the
  template will be replaced by the marker “###beginPeriod###”, that is
  by the alias “beginPeriod”.
   
Data type
  String
   
Default
  None

