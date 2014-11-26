# jGrundner WP Login Form #
* Requires at least: WordPress 3.9 and TinyMCE 4
* Tested up to: 4.0
* Not tested with versions lower than 3.9... Your mileage may very.
* Stable tag: trunk
* License: GPLv2
* License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add a WordPress login form anywhere you can put a shortcode

## Description ##

Add a WordPress Login form/Logout link anywhere you can put a shortcode.

This plugin came out of the need to add custom login to a page that could hook into the client's existing users and roles.

## Login ##
`[jcg-login-form]`

This shortcode uses all of the existing arguments for wp_login_form:
* __echo__ - echo out to browser immediately.
  - Default: _FALSE_ (print to page).


* __redirect__ - Page to redirect to after login.
    - Default: current page. `$_REQUEST['redirect_to']` | `$_SERVER['REQUEST_URI']`


* __form_id__
    - Default: '_loginform_'


* __label_username__
    - Default: '_Username_'


* __label_password__
    - Default: '_Password_'


* __label_remember__
    - Default: '_Remember Me_'


* __label_log_in__
    - Default: '_Log In_'


* __id_username__
    - Default: '_user_login_'


* __id_password__
    - Default: '_user_pass_'


* __id_remember__
    - Default: '_rememberme_'


* __id_submit__
    - Default: '_wp-submit_'


* __remember__
    - Default: TRUE


* __value_username__
    - Default: NULL


* __value_remember__
    - Default: FALSE

It also add some extra functionality:
* __logged_in_msg__ - Message to display if the user is already logged in
    - Default: '_You are already logged in!_'


* __login_form_top__ - This is text that goes above the form
    - Default: '_Login_'


* __login_form_top_tag__ - This is the HTML tag that wraps the _login_form_top_
    - Default: _`h2`_
    - Ex: _h3_


* __login_form_middle__ - This is text that goes between 'password' and 'remember_me'
    - Default: ''


* __login_form_bottom__ - This is text that goes below the 'submit' button
    - Default: ''

* __form_top_class__ - Class to add to the `<span>` tag that wraps element
    - Default: ''

* __form_middle_class__ - Class to add to the `<span>` tag that wraps element
    - Default: ''

* __form_bottom_class__ - Class to add to the `<span>` tag that wraps element
    - Default: ''

## Logout ##
`[jcg-logout]`

This shortcode talkes the following arguments:

* __id__ - id attribute for the `<a>` tag
    - Default: ''


* __class__ - class attribute for the `<a>` tag
    - Default: ''


* __style__ - style attribute for the `<a>` tag
    - Default: ''


* __text__ - Text to put inside of the `<a>` tag
    - Default: ''

* __xattr__ - Extra attributes for the `<a>` tag. 
    - Default: ''
    - Useful for mobile/responsive attributes.

## Installation ##

This section describes how to install the plugin and get it working.

1. Upload: Unzip `jgrundner_login_form_shortcode.zip` file, and upload the `jgrundner_login_form_shortcode` folder to your WordPress installation's `/wp-content/plugins/` directory

2. Activate: In the admin panel, goto `Plugins -> Installed Plugins`, active **'JCG Login Form Anywhere'**.

3. Use it two ways: 

    A. You will see a new button in the TinyMCE Editor in post and pages, use this button to add a login form.
    
    B. Or: Place `[jcg-login-form]` shortcode anywhere that accepts shortcodes.

## Frequently Asked Questions ##

### Why isn't there any questions ###

No one has asked any yet.

## Changelog ##

### 1.2 ###
* Add TinyMCE button for login form

### 1.1 ###
* Objectify code
* Add uninstaller

### 1.0 ###
* This is the initial version of the plugin.
