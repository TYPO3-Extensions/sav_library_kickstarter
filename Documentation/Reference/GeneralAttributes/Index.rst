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


General attributes
------------------

======================================================= =========== ============
Property                                                Data type   Default
======================================================= =========== ============
:ref:`General.addEdit`                                  Boolean     0
:ref:`General.addEditIfAdmin`                           Boolean     0
:ref:`General.addEditIfNull`                            Boolean     0
:ref:`General.addLeftIfNotNull`                         String      None
:ref:`General.addLeftIfNull`                            String      None
:ref:`General.addNewIcon`                               Boolean     0
:ref:`General.addRighIfNotNull`                         String      None
:ref:`General.addRighIfNull`                            String      None
:ref:`General.alias`                                    Field name  None
:ref:`General.classLabel`                               String      None
:ref:`General.classValue`                               String      None
:ref:`General.classHTMLTag`                             String      None
:ref:`General.cutIf`                                    String      None
:ref:`General.cutIfNull`                                Boolean     0
:ref:`General.cutLabel`                                 Boolean     0
:ref:`General.edit`                                     Boolean     1 in Edit views
:ref:`General.editAdminPlus`                            Boolean     0
:ref:`General.func`                                     String      None
:ref:`General.funcAddLeftIfNotNull`                     String      None
:ref:`General.funcAddLeftIfNull`                        String      None
:ref:`General.funcAddRightIfNotNull`                    String      None
:ref:`General.funcAddRightIfNull`                       String      None
:ref:`General.fusion`                                   {begin,     None
                                                        end}
:ref:`General.label`                                    String      None
:ref:`General.mail`                                     Boolean     0
:ref:`General.mailAlways`                               Boolean     0
:ref:`General.mailAuto`                                 Boolean     0
:ref:`General.onLabel`                                  Boolean     0
:ref:`General.orderLinkInTitle`                         Boolean     0
:ref:`General.orderLinkInTitleSetup`                    String      \:link\:
:ref:`General.query`                                    SQL         None
                                                        statements
:ref:`General.queryOnValue`                             String      None
:ref:`General.queryForEach`                             Field name  None
:ref:`General.renderReqValue`                           Boolean     0
:ref:`General.reqValue`                                 SQL SELECT  None
                                                        statement
:ref:`General.showIf`                                   String      None
:ref:`General.setExtendLink`                            Table name  None
:ref:`General.stdWrapItem`                              stdWrap     None
:ref:`General.stdWrapValue`                             stdWrap     None
:ref:`General.styleLabel`                               String      None
:ref:`General.styleValue`                               String      None
:ref:`General.styleHTMLTag`                             String      None
:ref:`General.tsObject`                                 cObject     None
:ref:`General.tsProperties`                             String      None
:ref:`General.value`                                    String      None
:ref:`General.verifier`                                 String      None
:ref:`General.verifierMessage`                          String      None
:ref:`General.verifierParam`                            String      None
:ref:`General.verifierSetWarning`                       Boolean     0
:ref:`General.wrapItem`                                 Wrap        None
======================================================= =========== ============



.. _General.addEdit:
  
addEdit
^^^^^^^
   
Description
  When the field is used in an "Update form" view, it will add an input
  element for update that can be used with the marker
  ###field\_name\_Edit### where "field\_name" is the name of the field.
         
  See also the help for Form views (showAllItemTemplate) to see how to
  use markers ###field[field\_name, label]###.
   
Data type
  Boolean
   
Default
  0


.. _General.addEditIfAdmin:

addEditIfAdmin
^^^^^^^^^^^^^^
   
Description
  Same as addEdit but the element will be added only if the user has the
  input right for the plugin.
   
Data type
  Boolean
   
Default
  0
     
  
.. _General.addEditIfNull:

addEditIfNull
^^^^^^^^^^^^^
   
Description
  Same as addEdit but the element will be added only if the field is
  null.
   
Data type
  Boolean
   
Default
  0


.. _General.addLeftIfNotNull:

addLeftIfNotNull
^^^^^^^^^^^^^^^^
   
Description
  String will be added to the left if the field value is not null.
   
Data type
  String
   
Default
  0 


.. _General.addLeftIfNull:

addLeftIfNull
^^^^^^^^^^^^^
   
Description
  String will be added to the left if the field value is null.
   
Data type
  String
   
Default
  None


.. _General.addNewIcon:

addNewIcon
^^^^^^^^^^
   
Description
  A new icon, will be displayed in front of the field during the number
  of days given by the int number.
   
Data type
  Boolean
   
Default
  0


.. _General.addRighIfNotNull:

addRighIfNotNull
^^^^^^^^^^^^^^^^
   
Description
  String will be added to the right if the field value is not null.
   
Data type
  String
   
Default
  None


.. _General.addRighIfNull:

addRighIfNull
^^^^^^^^^^^^^
   
Description
  String will be added to the right if the field value is null.
   
Data type
  String
   
Default
  None


.. _General.alias:

alias
^^^^^
   
Description
  The displayed value will be provided by the fieldname value for the
  current record.
   
Data type
  Field name
   
Default
  None


.. _General.classLabel:

classLabel
^^^^^^^^^^
   
Description
  The default class "label" associated with the label of the displayed
  value will be replaced by the string.
   
Data type
  String
   
Default
  None


.. _General.classValue:

classValue
^^^^^^^^^^
   
Description
  The default class "value" associated with the displayed value will be
  replaced by the string.
   
Data type
  String
   
Default
  None


.. _General.classHTMLTag:

classHTMLTag
^^^^^^^^^^^^
   
Description
  The string will be added as a class to the HTML tag associated with
  the displayed item (not always available).
   
Data type
  String
   
Default
  None


.. _General.cutIf:

cutIf / showIf
^^^^^^^^^^^^^^
   
Description
  The string can be:
         
  - fieldName=valueCuts / shows the field if current value of the field is
    equal to the given value. The markers ###user### or ###cruser### (same
    as user but should be used if a new record is created) will be
    replaced by the user id. Use EMPTY for the value to test an empty
    field.
         
  - fieldName!=valueCuts / shows the field if current value of the field
    is not equal to the given value. Same markers as above can be used.
         
  - ###usergroup=group\_name###The field is cut / shown if the group
    “group\_name” is a valid group for the current user.
         
  - ###usergroup!=group\_name###The field is cut / shown if the group
    “group\_name” is not a valid group for the current user.
         
  - ###group=group\_name###The field is cut / shown if the group
    “group\_name” is a valid group for the current record. It checks the
    usergroup field in the local table if any.
         
  - ###group!=group\_name###The field is cut / shown if the group
    “group\_name” is not a valid group for the current record. It checks
    the usergroup field in the local table if any.
         
  Logical connectors & and \| can be used between expression. However no
  parentheses are allowed.
   
Data type
  String
   
Default
  None
  
  
.. _General.cutIfNull:

cutIfNull
^^^^^^^^^
   
Description
  Cut the field if it is empty.
   
Data type
  Boolean
   
Default
  0


.. _General.cutLabel:

cutLabel
^^^^^^^^
   
Description
  Cuts the label associated with the field.
   
Data type
  Boolean
   
Default
  0


.. _General.edit:

edit
^^^^
   
Description
  Makes the field not editable in an input form.
   
Data type
  Boolean
   
Default
  1 in Edit views 


.. _General.editAdminPlus:

editAdminPlus
^^^^^^^^^^^^^
   
Description
  Makes the field editable in an input form, if the user has the
  "Admin+" right. To be an "Admin" user, his/her TSConfig must contain a
  line as follows:
         
  - extKey\_Admin=value where “extKey” is the extension key and value is
    one of the possible value of the "Input Admin Field" defined in the
    flexform associated with the extension.
         
  - The user becomes an "Admin+" user, if his/her TSConfig contains a line
    as follows:
         
  ::
         
    extKey_Admin=value+
   
Data type
  Boolean
   
Default
  0


.. _General.func:

func
^^^^
   
Description
  See :ref:`functions`.
   
Data type
  String
   
Default
  None


.. _General.funcAddLeftIfNotNull:

funcAddLeftIfNotNull
^^^^^^^^^^^^^^^^^^^^
   
Description
  String will be added to the left if the result of the applied
  function, defined by "func=function\_name;" property, is not null.
   
Data type
  String
   
Default
  None


.. _General.funcAddLeftIfNull:

funcAddLeftIfNull
^^^^^^^^^^^^^^^^^
   
Description
  String will be added to the left if the result of the applied
  function, defined by "func=function\_name;" property, is null.
   
Data type
  String
   
Default
  None


.. _General.funcAddRightIfNotNull:

funcAddRightIfNotNull
^^^^^^^^^^^^^^^^^^^^^
   
Description
  String will be added to the right if the result of the applied
  function, defined by "func=function\_name;" property, is not null.
   
Data type
  String
   
Default
  None


.. _General.funcAddRightIfNull:

funcAddRightIfNull
^^^^^^^^^^^^^^^^^^
   
Description
  String will be added to the right if the result of the applied
  function, defined by "func=function\_name;" property, is null.
   
Data type
  String
   
Default
  None


.. _General.fusion:

fusion
^^^^^^
   
Description
  - fusion = begin;
         
  Starts the fusion of the fields, that is the following fields will be
  displayed on the same line.
         
  - fusion = end;
         
  Ends the fusion of the fields, that is the following field will be
  displayed on the next line.
   
Data type
  {begin, end}
   
Default
  None


.. _General.label:

label
^^^^^
   
Description
  The displayed label will be provided by the string.
   
Data type
  String
   
Default
  None


.. _General.mail:

mail
^^^^
   
Description
  A mail will be associated with the field.
         
  If the field is a checkbox, it is used as a flag to verify is the mail
  has to be sent. Mail information are the following and can be used as
  properties:
         
  - fieldForCheckMail=field\_name; The mail will be sent if the value of
    the fieldname for the current row is not null.
         
  - mailIfFieldSetTo=string; The mail will be sent if the value of the
    fieldname for the current row was previously null or zero and is set
    to the given string value. If the string is a comma- separated list of
    values, the mail is sent is the value of the fieldname for the current
    row belongs to this list (only in SAV Library Plus).
         
  - mailSender=string; mail of the sender. Marker ###user\_email### will
    be replaced by the user email.
         
  - mailReceiver=string; mail of the person who will receive the mail and
    process the information.
         
  - mailReceiverFromField=field\_name; The field\_name contains the mail
    of the person who will receive the mail and process the information.
         
  - mailReceiverFromQuery=MySQL\_Query; The receiver is obtained from a
    select query with an alias "value" that will used to retrieve the
    receiver. Example:
         
  ::
         
    SELECT email AS value FROM fe_users WHERE ... 
         
  - mailSubject=string; subject of the mail. Markers ###fieldname### are
    allowed and will be replaced by their current value.
         
  - mailMessage=string, mail message. Markers ###fieldname### are allowed
    and will be replaced by their current value.
         
  - mailcc=string; if set the string is used as Cc: for the mail.
         
  - mailMessageLanguage=string; This parameter will force the language for
    the message to the value of the string.
         
  - mailMessageLanguageFromField=fieldname; This parameter will force the
    language for the message to the value of the field (for example a
    selector box).
         
  Localization by means of the file locallang.xml can be used with
  $$$tag$$$ which will be replaced by its value according to the
  configuration language.
   
Data type
  Boolean
   
Default
  0


.. _General.mailAlways:

mailAlways
^^^^^^^^^^
   
Description
  **The mail property must be set (mail = 1;) when using this
  property.**
         
  The mail is always sent when saving. Mail information are the
  following:
         
  - mailSender=string; mail of the sender. Marker ###user\_email### will
    be replaced by the user email.
         
  - mailReceiver=string; mail of the person who will receive the mail and
    process the information.
         
  - mailReceiverFromField=field\_name; The field\_name contains the mail
    of the person who will receive the mail and process the information.
         
  - mailReceiverFromQuery=MySQL\_Query; The receiver is obtained from a
    select query with an alias "value" that will used to retreive the
    receiver. Example:
         
  ::
         
    SELECT email AS value FROM fe_users WHERE ... 
         
  - mailSubject=string; subject of the mail. Markers ###fieldname### are
    allowed and will be replaced by their current value.
         
  - mailMessage=string, mail message. Markers ###fieldname### are allowed
    and will be replaced by their current value.
         
  - mailcc=string; if set the string is used as Cc: for the mail.
         
  Localization by means of the file locallang.xml can be used with
  $$$tag$$$ which will be replaced by its value according to the
  configuration language.
         
  - mailMessageLanguage=string; This parameter will force the language for
    the message to the value of the string.
         
  - mailMessageLanguageFromField=fieldname; This parameter will force the
    language for the message to the value of the field (for example a
    selector box).
   
Data type
  Boolean
   
Default
  0


.. _General.mailAuto:

mailAuto
^^^^^^^^
   
Description
  **The mail property must be set (mail = 1;) when using this
  property.**
         
  The mail is sent when saving, if the field is not empty and if one
  field in the form is changed. Mail information are the following:
         
  - mailSender=string; mail of the sender. The marker ###user\_email###
    will be replaced by the user email.
         
  - mailReceiver=string; mail of the person who will receive the mail and
    process the information.
         
  - mailReceiverFromField=field\_name; The field\_name contains the mail
    of the person who will receive the mail and process the information.
         
  - mailReceiverFromQuery=MySQL\_Query; The receiver is obtained from a
    select query with an alias "value" that will used to retreive the
    receiver. Example:
         
  ::
         
    SELECT email AS value FROM fe_users WHERE ... 
         
  - mailSubject=string; subject of the mail. Markers ###fieldname### are
    allowed and will be replaced by their current value.
         
  - mailMessage=string, mail message. Markers ###fieldname### are allowed
    and will be replaced by their current value.
           
  - mailcc=string; if set the string is used as Cc: for the mail.
         
  Localization by means of the file locallang.xml can be used with
  $$$tag$$$ which will be replaced by its value according to the
  configuration language.
         
  - mailMessageLanguage=string; This parameter will force the language for
    the message to the value of the string.
         
  - mailMessageLanguageFromField=fieldname; This parameter will force the
    language for the message to the value of the field (for example a
    selector box).
   
Data type
  Boolean
   
Default
  0


.. _General.onLabel:

onLabel
^^^^^^^
   
Description
  The value will be displayed in place of the label. Not so useful since
  the label can be cut.
   
Data type
  Boolean
   
Default
  0


.. _General.orderLinkInTitle:

orderLinkInTitle
^^^^^^^^^^^^^^^^
   
Description
  If this property is set, it makes it possible to generate a hyperlink
  in the title bar of the "list view". The hyperlink is associated with
  the field if the marker ###fieldname### is used in the "Title bar"
  section. Order clauses have to be defined in the "Where Tags" section
  of the "Query Form".
         
  Use the two followings “Where Tags”:
         
  ::
         
    Name: fieldname+
    WHERE Clause:
    ORDER BY Clause: tablename.fieldname
    Name: fieldname-
    WHERE Clause:
    ORDER BY Clause: tablename.fieldname DESC
         
  Note: orderLink can be also directly added in the title bar without
  any reference to a field. The syntax is:
         
  ::
         
    ###link(Default)[whereTagName1(,whereTageName2)]###
         
  If the optional part “Default” is used, by default the whereTagName1
  is assumed when the extension is launched.
         
  The optional whereTagName2 can be used to set a toggle link with two
  different behaviours.
   
Data type
  Boolean
   
Default
  None


.. _General.orderLinkInTitleSetup:

orderLinkInTitleSetup
^^^^^^^^^^^^^^^^^^^^^
   
Description
  This property controls the display of the link when “orderLinkInTitle”
  is set. The format is “param1:param2:param3” where “param1” to
  “param3” can take the following values:
         
  - value: the field value is displayed,
         
  - link: the field value is displayed with a link which toggles the sort,
         
  - asc: an icon is displayed with a link to make an ascending sort,
         
  - desc: an icon is displayed with a link to make a descending sort,
         
  - ascdesc: two icons are displayed with separate links to make an
    ascending or descending sort.
         
  - if there is no value, nothing is displayed.
   
Data type
  String
   
Default
  \:link\:


.. _General.query:

query
^^^^^
   
Description
  The query will be executed once the input form data have been saved.
  Therefore, it can only be used with "input" or "update" views.
         
  .. important::
    Because any query may be executed, for security reason, this
    property can only be used if an admin user has checked the field
    “Allow the use of the “query” property” in the advanced folder of the
    flexform.
         
  It may be useful, for example, to update a specific table when the
  current data are saved. Several queries can be used in the SQL
  statements. Each query must be separated using "\;".
         
  Special markers can be used in the statement:
         
  - ###uid### will be replaced by the current record uid.
         
  - ###CURRENT\_PID### will be replaced by the current page uid.
         
  - ###STORAGE\_PID### will be replaced by the storage page uid.
         
  - ###user### will be replaced by the user id.
         
  - ###value### will be replaced by the current value for the field.
   
Data type
  SQL statements
   
Default
  None


.. _General.queryOnValue:

queryOnValue
^^^^^^^^^^^^
   
Description
  The query, as defined above, will be executed if the current field
  value is equal to the right hand side string.
   
Data type
  String
   
Default
  None


.. _General.queryForEach:

queryForEach
^^^^^^^^^^^^
   
Description
  If the field is a true MM relation, the query, as defined above, will
  be executed for all the record in the relation.
         
  The special marker ###field\_name###, where "field\_name" is the field
  where the relation is defined, can be used to identify the record. It
  will be replaced by the uid of the associated record.
   
Data type
  Field name
   
Default
  None



.. _General.renderReqValue:

renderReqValue
^^^^^^^^^^^^^^
   
Description
  Rendering is applied to the value provided by the "reqValue" attribute
  according to the type of the field.  **Not available in “basic” type
  library** .
   
Data type
  Boolean
   
Default
  None


.. _General.reqValue:

reqValue
^^^^^^^^
   
Description
  SQL SELECT statement must have an alias "value" which will be used as
  the value to display.
         
  Special markers can be used in the statement :
         
  - ###uid### will be replaced by the current record uid.
         
  - ###uidItem### will be replaced by the uid of the current subform item
    (only  **in “basic” type library** ).
         
  - ###uidMainTable### will be replaced by the uid of the reccord in the
    main table (only  **in “**  **plus**  **” type library** ).
         
  - ###user### will be replaced by the user id.
         
  - ###row[field\_name]### where field\_name is the name of a field in the
    current record, will be replaced by its current value.
         
  The following example returns the name of the user who has created the
  current record, assuming that tx\_mytable is the local table:
         
  ::
         
    reqValue= SELECT name AS value 
    FROM fe_users
    WHERE uid=(SELECT cruser_id FROM tx_mytable WHERE uid=###uid###);
   
Data type
  SQL SELECT statement
   
Default
  None
  

.. _General.setExtendLink:

setExtendLink
^^^^^^^^^^^^^
   
Description
  The table name will be left-joined to existing tables.
   
Data type
  Table name
   
Default
  None


.. _General.showIf:

showIf
^^^^^^
   
Description
  See cutIf.
         
  **Not available in “basic” type library** .
   
Data type
  String
   
Default
  None


.. _General.stdWrapItem: 

stdWrapItem
^^^^^^^^^^^
   
Description
  It defines a conventional TypoScript stdWrap property. You can add
  here full TS syntax.
         
  .. important::
    Do not forget that the configuration field is ended by a semi-column,
    therefore if you need a semi-column in your TS write it "\;".
      
    **Not available in “basic” type library** .
   
Data type
  stdWrap
   
Default
  None


.. _General.stdWrapValue:

stdWrapValue
^^^^^^^^^^^^
   
Description
  It defines a conventional TypoScript stdWrap property. You can add
  here full TS syntax.
         
  .. important:: 
    Do not forget that the configuration field is ended by a semi-column,
    therefore if you need a semi-column in your TS write it "\;".
   
Data type
  stdWrap
   
Default
  None
  
  
.. _General.styleLabel:

styleLabel
^^^^^^^^^^
   
Description
  The string will be added as a style attribute associated with the
  label of the displayed value.
   
Data type
  String
   
Default
  None


.. _General.styleValue:

styleValue
^^^^^^^^^^
   
Description
  The string will be added as a style attribute associated with the
  displayed value.
   
Data type
  String
   
Default
  None


.. _General.styleHTMLTag:

styleHTMLTag
^^^^^^^^^^^^
   
Description
  The string will be added as a style attribute to the HTML tag
  associated with the displayed item (not always available).
   
Data type
  String
   
Default
  None


.. _General.tsObject:

tsObject
^^^^^^^^
   
Description
  It defines a TS content object (e.g. TEXT, IMAGE,...)
   
Data type
  cObject
   
Default
  None


.. _General.tsProperties:

tsProperties
^^^^^^^^^^^^
   
Description
  It defines the properties of the TS cObject.
         
  .. important::
    Do not forget that the configuration field is ended by a semi-column,
    therefore if you need a semi-column in your TS write it “\;”.
   
Data type
  String
   
Default
  None


.. _General.value:

value
^^^^^
   
Description
  It defines directly the value for the field.
   
Data type
  String
   
Default
  None


.. _General.verifier:

verifier
^^^^^^^^
   
Description
  Verifiers can be used to check if a field satisfy a constraint. Each
  field can have one verifier. Each verifier is associated with a
  parameter.
                 
  The verifier name can be:
         
  - isValidPattern
         
  - isValidLength
         
  - isValidInterval
         
  - isValidQuery
   
Data type
  String
   
Default
  None


.. _General.verifierMessage:

verifierMessage
^^^^^^^^^^^^^^^
   
Description
  It replaces the default message.
         
  Localization by means of the file locallang.xml can be used with
  $$$tag$$$ which will be replaced by its value according to the
  configuration language.
         
  The marker $$$label[fieldName]$$$ will be replaced by the fieldName
  title according to the localization.
   
Data type
  String
   
Default
  None


.. _General.verifierParam:

verifierParam
^^^^^^^^^^^^^
   
Description
  The string can be:
         
  - a regular expression for the verifier "isValidPattern". For example
    /^[A-Za-z0-9\_]\*$/ will allow any input which contains letters,
    numbers or underline characters.
         
  - an integer value for the verifier "isValidLength".
         
  - an interval [a, b] where a and b are integers for the verifier
    "isValidInterval".
         
  - a SELECT query for "isValidQuery". The marker ###value### in the query
    will be replaced by the value of the field. The marker ###uid### will
    be replaced by the uid of the current record.
   
Data type
  String
   
Default
  None


.. _General.verifierSetWarning:

verifierSetWarning
^^^^^^^^^^^^^^^^^^
   
Description
  If set an error detected by the verifier becomes a warning. In that
  case, the field content is written in the database (which is not the
  case for errors) and a message is displayed.
   
Data type
  Boolean
   
Default
  0


.. _General.wrapItem:

wrapItem
^^^^^^^^
   
Description
  The string will be used to wrap the item. The syntax in the same as in
  TypoScript.
         
  Localization by means of the file locallang.xml can be used with
  $$$tag$$$ which will be replaced by its value according to the
  configuration language.
         
  The marker $$$label[fieldName]$$$ will be replaced by the fieldName
  title according to the localization.
   
Data type
  Wrap
   
Default
  None



