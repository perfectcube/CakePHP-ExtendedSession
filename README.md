# CakePHP Extended Session

Extended Session allows you to display multiple messages for a single key.


### Reason for Development

We needed a way to display multiple flash messages on a page without littering our layout files with calls to `$this->Session->flash()`, each with its own unique key. So we wrote an extension to the Session Component and Helper to allow a single key to contain multiple messages.


### Integrating into your CakePHP project

To use Extended Session, do the following:
1. Drop ExtendedSessionComponent.php into your Controller/Component folder and ExtendedSessionHelper.php into View/Helper.
2. In your AppController.php, replace the inclusion of the Session component with the following: ```'Session'=>array('className'=>'ExtendedSession') ```
3. Do the same for the inclusion of the Session helper
4. Eat cake because you're done!


### Above and beyond

Extended Session provides two simple API changes to make it easier for you to display messages from wherever you want.

**Set a message at a specific index**
##*TODO* Finish Documentation

