(function(){
    // creates the plugin
    tinymce.PluginManager.add('jcg_mce_button', function( editor, url ) {
        editor.addButton('jcg_mce_button', {
            title: 'Login Form',
            icon: 'icon dashicons-admin-network',
            onclick: function() { //console.log(this);
                // triggers the thickbox
                var width = jQuery(window).width(), W = ( 720 < width ) ? 720 : width;
                var H = jQuery(window).height();
                W = W + 30;
                H = H + 40;
                tb_show( 'Login Form Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=jcg-login-form&class=jcgWrap' );
            }
        });
    });

    // executes this when the DOM is ready
    jQuery(function(){
        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this
        var form = jQuery('\
        <div id="jcg-login-form"><div id="jcg-login-form-form">\
            <table id="jcg-login-form-table" class="form-table">\
                <tr>\
                    <th><label for="label_log_in">Button Text</label></th>\
                    <td><input type="text" id="label_log_in" name="label_log_in" value="Log In" /><br />\
                    <small>Submit button text.</small></td>\
                </tr>\
                <tr>\
                    <th><label for="label_username">Username Label</label></th>\
                    <td><input type="text" name="label_username" id="label_username" value="Username" /><br />\
                    <small>Label for the username field.</small>\
                </tr>\
                <tr>\
                    <th><label for="label_password">Password Label</label></th>\
                    <td><input type="text" name="label_password" id="label_password" value="Password" /><br />\
                    <small>Label for the Password field.</small></td>\
                </tr>\
                <tr>\
                    <th><label for="label_remember">Remember Label</label></th>\
                    <td><input type="text" name="label_remember" id="label_remember" value="Remember Me" /><br />\
                    <small>Label for the Remember field.</small></td>\
                </tr>\
                <tr>\
                    <th><label for="remember">Show Remember Me Field</label></th>\
                    <td><select name="remember" id="remember">\
                    <option value="1" selected="selected">True</option> \
                    <option value="0">False</option> \
                    <br />\
                    <small>Show Me Remember checkbox in the login form.</small></td>\
                </tr>\
                <tr>\
                    <th><label for="value_remember">Remember Me Default Value</label></th>\
                    <td><select name="value_remember" id="value_remember">\
                    <option value="1">True</option> \
                    <option value="0" selected="selected">False</option> \
                    <br />\
                    <small>Whether Remember Me is checked by default.</small></td>\
                </tr>\
                <tr>\
                    <th><label for="logged_in_msg">Logged In Message</label></th>\
                    <td><input type="text" name="logged_in_msg" id="logged_in_msg" value="" /><br />\
                    <small>Optional message to display of user is already logged in.</small></td>\
                </tr>\
                <tr>\
                    <th><label for="login_form_top">Text Top</label></th>\
                    <td><input type="text" name="login_form_top" id="login_form_top" value="Login" /><br />\
                    <small>Optional Text to display at the top of the form.</small></td>\
                </tr>\
                <tr>\
                    <th><label for="login_form_middle">Text Middle</label></th>\
                    <td><input type="text" name="login_form_middle" id="login_form_middle" value="" /><br />\
                    <small>Optional Text to display in the middle of the form.</small></td>\
                </tr>\
                <tr>\
                    <th><label for="login_form_bottom">Text Bottom</label></th>\
                    <td><input type="text" name="login_form_bottom" id="login_form_bottom" value="" /><br />\
                    <small>Optional Text to display at the bottom of the form.</small></td>\
                </tr>\
                <tr>\
                    <th><label for="form_top_class">CSS Top</label></th>\
                    <td><input type="text" name="form_top_class" id="form_top_class" value="" /><br />\
                    <small>Extra CSS class for top of form text.</small></td>\
                </tr>\
                <tr>\
                    <th><label for="form_middle_class">CSS Middle</label></th>\
                    <td><input type="text" name="form_middle_class" id="form_middle_class" value="" /><br />\
                    <small>Extra CSS class for middle fo form text.</small></td>\
                </tr>\
                <tr>\
                    <th><label for="form_bottom_class">CSS Bottom</label></th>\
                    <td><input type="text" name="form_bottom_class" id="form_bottom_class" value="" /><br />\
                    <small>Extra CSS form for bottom of form text.</small></td>\
                </tr>\
            </table>\
            <p class="submit">\
                <input type="button" id="jcg-login-form-submit" class="button-primary" value="Insert Login" name="submit" />\
            </p>\
		</div></div>');

        var table = form.find('table');
        form.appendTo('body').hide();

        // handles the click event of the submit button
        form.find('#jcg-login-form-submit').click(function(){
            // defines the options and their default values
            // again, this is not the most elegant way to do this
            // but well, this gets the job done nonetheless
            var options = {
                'label_log_in'        : 'Log In',
                'label_username'      : 'Username',
                'label_password'      : 'Password',
                'label_remember'      : 'Remember Me',
                'remember'            : '1', // TRUE
                'value_remember'      : '0', // FALSE
                'logged_in_msg'       : '',
                'login_form_top'      : 'Login',
                'login_form_middle'   : '',
                'login_form_bottom'   : '',
                'form_top_class'      : '',
                'form_middle_class'   : '',
                'form_bottom_class'   : ''
            };
            var shortcode = '[jcg-login-form';

            for( var index in options) {
                var value = table.find('#' + index).val();

                // attaches the attribute to the shortcode only if it's different from the default value
                if ( value !== options[index] )
                    shortcode += ' ' + index + '="' + value + '"';
            }

            shortcode += ']';

            // inserts the shortcode into the active editor
            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

            // closes Thickbox
            tb_remove();
        });
    });
})()