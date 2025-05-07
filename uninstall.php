<?php
/**
 * Fired when plugin is uninstalled.
 */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit;

// Delete plugin options
$options = [
    'anh_from_email',
    'anh_cash_subject',
    'anh_cash_body',
    'anh_charge_subject',
    'anh_charge_body',
    'anh_attachment_id',
];
foreach ( $options as $opt ) {
    delete_option( $opt );
}
