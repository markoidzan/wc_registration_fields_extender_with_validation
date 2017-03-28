<?php
/**
 * Plugin Name: WooCommerce Registration Fields
 * Plugin URI: https://idzan.com.hr
 * Description: My Custom registration fields.
 * Version: 1.0
 * Author: Marko Idzan
 * Author URI: https://idzan.com.hr
 * License: GPL2
 */

/**
 * Add new register fields for WooCommerce registration.
 *
 * @return string Register fields HTML.
 */
function wooc_extra_register_fields() {
    ?>

    <p class="form-row form-row-first">
    <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
    </p>

    <p class="form-row form-row-last">
    <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
    </p>

    <div class="clear"></div>

    <p class="form-row form-row-wide">
    <label for="reg_billing_phone"><?php _e( 'Phone', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_phone" id="reg_billing_phone" value="<?php if ( ! empty( $_POST['billing_phone'] ) ) esc_attr_e( $_POST['billing_phone'] ); ?>" />
    </p>
	
	

    <?php
}

add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );

function wooc_extra_register_fields_checkbox() {
    ?>
	
	

    <?php
}

add_action( 'woocommerce_register_form', 'wooc_extra_register_fields_checkbox' );

/**
 * Validate the extra register fields.
 *
 * @param  string $username          Current username.
 * @param  string $email             Current email.
 * @param  object $validation_errors WP_Error object.
 *
 * @return void
 */
function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {
    if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
        $validation_errors->add( 'billing_first_name_error', __( 'Molimo unesite Vaše ime!', 'woocommerce' ) );
    }

    if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
        $validation_errors->add( 'billing_last_name_error', __( 'Molimo unesite Vaše prezime!', 'woocommerce' ) );
    }


    if ( isset( $_POST['billing_phone'] ) && empty( $_POST['billing_phone'] ) ) {
        $validation_errors->add( 'billing_phone_error', __( 'Molimo unesite Vaš broj telefona ili mobitela!', 'woocommerce' ) );
    }
	
	
}

add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );

/**
 * Save the extra register fields.
 *
 * @param  int  $customer_id Current customer ID.
 *
 * @return void
 */
function wooc_save_extra_register_fields( $customer_id ) {
    if ( isset( $_POST['billing_first_name'] ) ) {
        // WordPress default first name field.
        update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );

        // WooCommerce billing first name.
        update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
    }

    if ( isset( $_POST['billing_last_name'] ) ) {
        // WordPress default last name field.
        update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );

        // WooCommerce billing last name.
        update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
    }

    if ( isset( $_POST['billing_phone'] ) ) {
        // WooCommerce billing phone
        update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
    }
}

add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );

$digit1 = mt_rand(1,20);
$digit2 = mt_rand(1,20);
if( mt_rand(0,1) === 1 ) {
    $math = "$digit1 + $digit2";
    $_SESSION['answer'] = $digit1 + $digit2;
} else {
    $math = "$digit1 - $digit2";
    $_SESSION['answer'] = $digit1 - $digit2;
}

if ($_SESSION['answer'] == $_POST['answer'] ) {
    // value entered is correct
}
else {
    // value is incorrect, kindly try again
}