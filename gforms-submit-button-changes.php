<?php
/*
Plugin Name: Gforms submit button changes
Plugin URI: http://russellaaron.vegas
Description: Change the submit button text on a gravity form
Version: 1.0.0
Author: Russell Aaron
Author URI: http://russellaaron.vegas
License: GPLv2 or later
Text Domain: gforms-submit
*/

// create custom plugin settings menu
add_action('admin_menu', 'my_cool_plugin_create_menu');

function my_cool_plugin_create_menu() {

    //create new top-level menu
    add_menu_page('Gforms Submit Button Hack', 'Gforms Submit Button Hack', 'administrator', __FILE__, 'gforms_submit_button_hack' , plugins_url('/images/icon.png', __FILE__) );

    //call register settings function
    add_action( 'admin_init', 'register_gfroms_hack_submit_plugin_settings' );
}


function register_gfroms_hack_submit_plugin_settings() {
    //register our settings
    register_setting( 'my-cool-plugin-settings-group', 'new_option_name' );
    register_setting( 'my-cool-plugin-settings-group', 'some_other_option' );
}

function gforms_submit_button_hack() {
    ?>
    <div class="wrap">
        <h2>GForms Submit Button Hack</h2>

        <form method="post" action="options.php">
            <?php settings_fields( 'my-cool-plugin-settings-group' ); ?>
            <?php do_settings_sections( 'my-cool-plugin-settings-group' ); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">What is the form Id?</th>
                    <td><input type="text" name="new_option_name" size="35" value="<?php echo esc_attr( get_option('new_option_name') ); ?>" /></td>
                    <td>example: <b>gform_submit_button_1</b> - change the 1 to match your form ID #. If you are changing gravity form id #5, you would change this to gform_submit_button_5</td>
                </tr>

                <tr valign="top">
                    <th scope="row">Some Other Option</th>
                    <td><input type="text" name="some_other_option" size="35" value="<?php echo esc_attr( get_option('some_other_option') ); ?>" /></td>
                    <td>Enter in the text that you would like to change the submit button to say</td>
                </tr>
            </table>

            <?php submit_button(); ?>

        </form>
    </div>
<?php }

$gforms_submit_russ = get_option( 'new_option_name' );

add_filter( $gforms_submit_russ, 'change_the_submit_button_for_me', 10, 2 );
function change_the_submit_button_for_me( $button, $form, $kyle ) {
    $kyle = get_option( 'some_other_option' );
    return "<button class='button' id='gchange_the_submit_button_for_me_{$form['id']}'><span>$kyle</span></button>";
}

?>