<?php defined('ABSPATH') or die("Direct access is not allowed, GOOD BYE!");
/**
 * Plugin Name: jGrundner Login Form
 * Plugin URI: http://jgrundner.com
 * Description: Drop a login form anywhere youcan put a shortcode
 * Version: 1.0
 * Author: James Grundner
 * Author URI: URI: http://jgrundner.com
 * License: GPLv2
 *
 * @package Login Form Shortcode
 * @version 1.0
 */
/**
 * Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)
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

/**
 * Add a login form anywhere you can put a shortcode
 *
 * @author  James Grundner
 * @param   array $atts WordPress Parameters
 * @return  string WordPress Login Form
 */
function jgrundner_login_form_shortcode( $atts ) {

    // Original Attributes, for filters
    $original_atts = $atts;

    // Pull in shortcode attributes and set defaults
    $atts = shortcode_atts(array(
        'echo'              => false,/* Set 'echo' to 'false' because we want it to always return instead of print for shortcodes. */
        'redirect'          => site_url( $_SERVER['REQUEST_URI'] ),
        'form_id'           => 'loginform',
        'label_username'    => __( 'Username' ),
        'label_password'    => __( 'Password' ),
        'label_remember'    => __( 'Password' ),
        'label_log_in'      => 'Log In',
        'id_username'       => 'user_login',
        'id_password'       => 'user_pass',
        'id_remember'       => 'rememberme',
        'id_submit'         => 'wp-submit',
        'remember'          => TRUE,
        'value_username'    => NULL,
        'value_remember'    => FALSE,
        'logged_in_msg'     => 'You are already logged in!',
        'login_form_top'    => 'Login',
        'login_form_middle' => '',
        'login_form_bottom' => ''
    ), $atts );

    if ( is_user_logged_in() ){
        //return '<p>' . $atts['logged_in_msg'] . '</p>';
    }

    /* Set the sredirect page based on redirect_to query parameter if set */
    if(!empty($_REQUEST['redirect_to'])){
        $atts['redirect'] = site_url( $_REQUEST['redirect_to'] );
    }

    add_filter( 'login_form_top', 'jgrundner_login_form_top', 10 , 2);
    function jgrundner_login_form_top( $top, $atts ){
        $top = '<h2>' . $atts['login_form_top'] . '</h2>';
        return $top;
    }

    add_filter( 'login_form_middle', 'jgrundner_login_form_middle', 10 , 2);
    function jgrundner_login_form_middle( $middle, $atts ){
        return  $atts['login_form_middle'] ;
    }

    add_filter( 'login_form_bottom', 'jgrundner_login_form_bottom', 10 , 2);
    function jgrundner_login_form_bottom( $bottom, $atts ){
        return $atts['login_form_bottom'];
    }

    return wp_login_form( $atts );
}
add_shortcode( 'jcg-login-form', 'jgrundner_login_form_shortcode' );

/**
* Add a logout link anywhere you can put a shortcode
*
* @author  James Grundner
* @param   array $atts WordPress Parameters
* @return  string WordPress Logout link
*/
function jgrundner_logout_shortcode( $arrs ) {
    extract( shortcode_atts(
        array(
            'id'    => '',
            'class' => '',
            'style' => '',
            'text'  => ''
        ), $atts )
    );

    $output = '';
    $id     = ( $id    != '' ) ? esc_attr( $id ) : 'jcg-logout';
    $class  = ( $class != '' ) ? esc_attr( $class ) . ' jcg-logout' : 'jcg-logout';
    $style  = ( $style != '' ) ? 'style="' . esc_attr( $style ) . '"' : '';
    $text   = ( $text  != '' ) ? esc_attr( $text ) : 'Logout';

    $output = '<a  href="'.wp_logout_url( home_url() ).'" title="Logout" id="'.$id.'" class="'.$class.$type.'" '.$style.'>'.$text.'</a>';

    return $output;
}
add_shortcode( 'jcg-logout', 'jgrundner_logout_shortcode' );