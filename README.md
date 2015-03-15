
# Mock Services

The European Commission provides web services but those are only available from 
within the EC network (and sometimes only from the production web services).
 
This set of mocked services allow developers to develop functionality against 
these services without the need to really access them.


## Installation

See the [installation manual](INSTALL.md).


## Provided services

### LDAP

The EC LDAP service provides the functionality to retrieve information about an
EC email address. It returns if the email address exists and some extra info
like the country the user is located in and the department he/she is working in.

#### Functionality

The service will validate if:

1. The given email parameter has a valid email address format.
2. If the email address does not start with `invalid`. This gives the 
   opportunity to validate an email address with a valid domain but that will
   be validated as not valid.
3. If the email address has one of the supported email addresses (see config).

It will return a XML structured response with following structure:

```
<user>
    <valid>[valid/invalid]</valid>
    <title>[mr/ms/mss]</title>
    <userid>[the username of the user]</userid>
    <fname>[the firstname of the user]</fname>
    <lname>[the lastame of the user]</lname>
    <email>[the email address of the user]</email>
    <dg>[the department the user is part of]</dg>
    <country iso="[the country ISO code, e.g. BE]">[country name where the user is located]</country>
    <region>[the region of the country]</region>
</user>
```

#### Usage

The services is available on `/ldap` and requires 2 parameters:

* event : The service event that should handle the request. This should always 
  be `c4d.checkUser`.
* email : The email address that should be validated.

Example:

```
http://<URL TO MOCK SERVER>/ldap?event=c4d.checkUser&email=test.me@ec.europa.eu
```

#### Configuration

The LDAP service has 2 configuration parameters (see `src/config/config.php`):

* ldap.domains : an array of email domains that will be validated as valid.
  The default domains are:
  * ext.ec.europa.eu
  * ec.europa.eu
  * cec.eu.int
  * eeas.europa.eu
  * ext.eeas.europa.eu
  * jrc.ec.europa.eu
  * ext.jrc.ec.europa.eu
* ldap.invalid : a regular expression pattern that will be used to identify 
  email addresses as invalid. The default is `/^invalid/`.
