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


Files and images
----------------


======================================================= =========== ============
Property                                                Data type   Default
======================================================= =========== ============
:ref:`FilesAndImages.addIcon`                           Boolean     0
:ref:`FilesAndImages.addLinkInEditMode`                 Boolean     0
:ref:`FilesAndImages.addToUploadFolder`                 String      None
:ref:`FilesAndImages.addToUploadFolderFromField`        Field name  None
:ref:`FilesAndImages.alt`                               String      None
:ref:`FilesAndImages.default`                           String      None
:ref:`FilesAndImages.fieldAlt`                          Field name  None
:ref:`FilesAndImages.fieldMessage`                      Field name  None
:ref:`FilesAndImages.height`                            Integer     None
:ref:`FilesAndImages.iframe`                            Boolean     0
:ref:`FilesAndImages.message`                           String      None
:ref:`FilesAndImages.size`                              Integer     None
:ref:`FilesAndImages.tsProperties`                      String      None
:ref:`FilesAndImages.uploadFolder`                      String      None
:ref:`FilesAndImages.width`                             Integer     None
======================================================= =========== ============


.. _FilesAndImages.addIcon:

addIcon
^^^^^^^

Description
  Adds an icon in front of the hyperlink associated with the file.

Data type
  Boolean

Default
  0


.. _FilesAndImages.addLinkInEditMode:

addLinkInEditMode
^^^^^^^^^^^^^^^^^

Description
  A hyperlink to the file will be added in the edit mode.  **Only for
  “plus” library type** .

Data type
  Boolean

Default
  0


.. _FilesAndImages.addToUploadFolder:

addToUploadFolder
^^^^^^^^^^^^^^^^^

Description
  Adds a subpath to the UploadFolder path.

Data type
  String

Default
  None


.. _FilesAndImages.addToUploadFolderFromField:

addToUploadFolderFromField
^^^^^^^^^^^^^^^^^^^^^^^^^^

Description
  Adds the content of the field whose name is given by "field\_name" to
  the uploadFolder attribute. This information is separated with an
  underscore.

  Example: if the field\_name is "my\_field" and its contents is "123",
  then

  ::

    AddToUploadFolderFromField = my_field;

  will add "\_123" to the uploadFolder name.

Data type
  Field name

Default
  None


.. _FilesAndImages.alt:

alt
^^^

Description
  Provides the HTML alt attribute for an image.

Data type
  string

Default
  None


.. _FilesAndImages.default:

default
^^^^^^^

Description
  Defines the default image if the content of the field is null
  otherwise the default image is “unknown.gif” taken in the directory
  sav\_library\_Plus/Resources/Private/Images.

Data type
  string

Default
  None


.. _FilesAndImages.fieldAlt:

fieldAlt
^^^^^^^^

Description
  Sets the "alt" attribute with the content of the field whose name is
  given by field\_name.

Data type
  Field name

Default
  None


.. _FilesAndImages.fieldMessage:

fieldMessage
^^^^^^^^^^^^

Description
  Sets the attribute "message" with the content of the field whose name
  is given by field\_name.

Data type
  Field name

Default
  None


.. _FilesAndImages.height:

height
^^^^^^

Description
  Sets the height of an image or of the iframe.

Data type
  Integer

Default
  None


.. _FilesAndImages.iframe:

iframe
^^^^^^

Description
  Opens the image in an iframe.

Data type
  Boolean

Default
  0


.. _FilesAndImages.message:

message
^^^^^^^

Description
  If the file is not an image, a hyperlink is created with the string.

Data type
  string

Default
  None


.. _FilesAndImages.size:

size
^^^^

Description
  Sets the size attribute. It overwrites the same attribute in the TCA.

Data type
  integer

Default
  None


.. _FilesAndImages.tsProperties:

tsProperties
^^^^^^^^^^^^

Description
  It makes it possible to use the graphic possibilities of TYPO3. If
  set, an IMAGE cObject is generated with the given TS properties.

  .. important::
    Do not forget that the configuration field is ended by a semi-column,
    therefore if you need a semi-column in your TS write it “\;”

Data type
  String

Default
  None


.. _FilesAndImages.uploadFolder:

uploadFolder
^^^^^^^^^^^^

Description
  Sets the folder path where the file is stored. It overwrites the same
  attribute in the TCA.

Data type
  String

Default
  None


.. _FilesAndImages.width:

width
^^^^^

Description
  Sets the width of an image or of the iframe.

Data type
  Integer

Default
  None
