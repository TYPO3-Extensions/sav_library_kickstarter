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


Link
----


======================================================= =========== ============
Property                                                Data type   Default
======================================================= =========== ============
:ref:`Link.fieldLink`                                   Field name  None
:ref:`Link.fieldMessage`                                Field name  None
:ref:`Link.generateRTF`                                 Boolean     0
:ref:`Link.link`                                        String      None
:ref:`Link.message`                                     String      None
:ref:`Link.saveFileRTF`                                 String      None
:ref:`Link.tableName.fieldName`                         String      None
:ref:`Link.templateRTF`                                 String      None
======================================================= =========== ============



.. _Link.fieldLink:

fieldLink
^^^^^^^^^
   
Description
  Sets the attribute "link" with the content of the field whose name is
  given by fieldName.
   
Data type
  Field name
   
Default
  None
  

.. _Link.fieldMessage:

fieldMessage
^^^^^^^^^^^^
   
Description
  Sets the attribute "message" with the content of the field whose name
  is given by fieldName.
   
Data type
  fieldName
   
Default
  None
  
  
.. _Link.generateRTF:

generateRTF
^^^^^^^^^^^
   
Description
  Sets the RTF generator.
   
Data type
  Boolean
   
Default
  0


.. _Link.link:

link
^^^^
   
Description
  The string will be used for the link instead of the field value.
   
Data type
  String
   
Default
  None


.. _Link.message:

message
^^^^^^^
   
Description
  Message associated with the link.
   
Data type
  String
   
Default
  None
    

.. _Link.saveFileRTF:

saveFileRTF
^^^^^^^^^^^
   
Description
  Name under which the generated file will be saved. Field markers
  ###tableName.fieldName### or ###fieldName### (for aliases) can be
  used.
   
Data type
  String
   
Default
  None  
  

.. _Link.tableName.fieldName:

tableName.fieldName
^^^^^^^^^^^^^^^^^^^
   
Description
  String can be string1->string2 or NL-> string2
         
  In an rtf document, if the field marker ###tableName.fieldName###
  exists string1 will be replaced by string2. String1 can be NL (for the
  ASCII character LF).
         
  It may be useful when one wants to input data in a textarea and
  display them in one line with a given separator in the file.
   
Data type
  String
   
Default
  None


  
.. _Link.templateRTF:

templateRTF
^^^^^^^^^^^
   
Description
  Defines the template to be used by the RTF generator. Field markers
  ###tableName.fieldName### or ###fieldName### (for aliases) can be
  used.
   
Data type
  String
   
Default
  None



