<?php defined('ABSPATH') or die("Direct access is not allowed, GOOD BYE!");
/**
 * Plugin Name: JCG Login Form Anywhere
 * Plugin URI: http://jgrundner.com
 * Description: Drop a login form anywhere you can put a shortcode
 * Version: 1.0
 * Author: James Grundner
 * Author URI: URI: http://jgrundner.com
 * License: GPLv2
 *
 * @package Login Form Shortcode
 * @version 1.0
 */
/**
 * Copyright 2014  James Grundner  (email : James@jgrundner.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

define( 'JCG_LOGIN_FORM_ANYWHERE_VERSION', '1.0' );

class JCG_Login_Form_Anywhere
{
    /**
     * Constructor
     */
    function __construct()
    {
        add_shortcode('jcg-login-form', array($this,'jcg_login_form_shortcode'));
        add_shortcode('jcg-logout', array($this,'jcg_logout_shortcode'));
        register_activation_hook( __FILE__, array($this,'jcg_set_default_options') );

    }

    function jcg_set_default_options()
    {
        if ( get_option( 'jcg_login_form_anywhere_version' ) === false )
        {
            add_option( 'jcg_login_form_anywhere_version', '1.0' );
        }
    }

    /**
     * Add a login form anywhere you can put a shortcode
     *
     * @author  James Grundner
     *
     * @param   array $atts WordPress Parameters
     *
     * @return  string WordPress Login Form
     */
    function jcg_login_form_shortcode($atts)
    {
        // Pull in shortcode attributes and set defaults
        $atts = shortcode_atts(array(
            'echo'                => FALSE,/* Set 'echo' to 'false' because we want it to always return instead of print for shortcodes. */
            'redirect'            => site_url($_SERVER['REQUEST_URI']),
            'form_id'             => 'loginform',
            'label_username'      => __('Username'),
            'label_password'      => __('Password'),
            'label_remember'      => __('Password'),
            'label_log_in'        => 'Log In',
            'id_username'         => 'user_login',
            'id_password'         => 'user_pass',
            'id_remember'         => 'rememberme',
            'id_submit'           => 'wp-submit',
            'remember'            => TRUE,
            'value_username'      => NULL,
            'value_remember'      => FALSE,
            'logged_in_msg'       => '',
            'login_form_top'      => 'Login',
            'login_form_middle'   => '',
            'login_form_bottom'   => '',
            'form_top_class'      => '',
            'form_middle_class'   => '',
            'form_bottom_class'   => ''
        ), $atts);

        if (is_user_logged_in())
        {
            return $atts['logged_in_msg'];
        }

        /* Set the sredirect page based on redirect_to query parameter if set */
        if (!empty($_REQUEST['redirect_to']))
        {
            $atts['redirect'] = site_url($_REQUEST['redirect_to']);
        }

        add_filter('login_form_top', 'jcg_login_form_top', 10, 2);
        function jcg_login_form_top($top, $atts)
        {
            return '<span class="'.$atts['form_top_class'].'">' . $atts['login_form_top'] . '</span>';
        }

        add_filter('login_form_middle', 'jcg_login_form_middle', 10, 2);
        function jcg_login_form_middle($middle, $atts)
        {
            return '<span class="'.$atts['form_middle_class'].'">' . $atts['login_form_middle'] . '</span>';
        }

        add_filter('login_form_bottom', 'jcg_login_form_bottom', 10, 2);
        function jcg_login_form_bottom($bottom, $atts)
        {
            return '<span class="'.$atts['form_bottom_class'].'">' . $atts['login_form_bottom'] . '</span>';
        }

        return wp_login_form($atts);
    }

    /**
     * Add a logout link anywhere you can put a shortcode
     *
     * @author   James Grundner
     *
     * @param $args
     *
     * @return  string WordPress Logout link
     */
    function jcg_logout_shortcode($args)
    {
        extract(shortcode_atts(
                array(
                    'id'    => '',
                    'class' => '',
                    'style' => '',
                    'text'  => '',
                    'xattr' => ''
                ), $args)
        );

        $id      = ( $id != ''    ) ? esc_attr($id)                      : 'jcg-logout';
        $class   = ( $class != '' ) ? esc_attr($class) . ' jcg-logout'   : 'jcg-logout';
        $style   = ( $style != '' ) ? 'style="' . esc_attr($style) . '"' : '';
        $text    = ( $text != ''  ) ? esc_attr($text)                    : 'Logout';
        $xattr   = ( $xattr != '' ) ? esc_attr($xattr)                   : '';

        $output = '<a href="'.wp_logout_url(home_url()).'" title="Logout" id="'.$id.'" class="'.$class.'" '.$style.' '.$xattr.'>'.$text.'</a>';

        return $output;
    }
}

$jcg_login_form_anywhere = new JCG_Login_Form_Anywhere();
