<?php
if( !defined( 'ABSPATH')) die("Direct access is not allowed, GOOD BYE!");
if(!defined('WP_UNINSTALL_PLUGIN') ) die("No uninstaller defined");

class UNINSTALL_JCG_Login_Form_Anywhere
{
    /**
     * Constructor
     */
    function __construct()
    {
        $this->uninstall_jcg_login_form_anywhere();
    }

    /**
     * Uninstaller
     */
    function uninstall_jcg_login_form_anywhere()
    {
        global $wpdb;

        $shortcodes = array('jcg-login-form', 'jcg-logout');
        $codes      = implode("|", $shortcodes);

        $posts = $wpdb->get_results("
            SELECT ID, post_content, post_title
            FROM {$wpdb->posts}
            WHERE post_content REGEXP '[[.left-square-bracket.]]({$codes})(.)*[[.right-square-bracket.]]'
            ORDER BY ID
            ");
        if (count($posts) > 0)
        {
            foreach ($posts AS $post)
            {
                $content = preg_replace('#\[(' . $codes . ')(.)*\]#im', '', $post->post_content);
                if (!is_null($content))
                {
                    $wpdb->query($wpdb->prepare("UPDATE {$wpdb->posts} SET post_content=%s WHERE ID=%d", $content, $post->ID));
                }
            }
        }
    }
}

$Uninstall_JCG_Login_Form_Anywhere = new UNINSTALL_JCG_Login_Form_Anywhere();