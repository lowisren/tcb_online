<?php
add_action( 'init', 'wrranty_db_table', 1 );
add_action( 'switch_blog', 'wrranty_db_table' );

function wrranty_db_table() {
    global $wpdb;
    $wpdb->wrranty_db_table = "{$wpdb->prefix}wrranty_db_table";
}

function template_create_tables() {
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    global $wpdb;
    global $charset_collate;
// Call this manually as we may have missed the init hook
    wrranty_db_table();
    $sql_create_table = "CREATE TABLE {$wpdb->wrranty_db_table} (
          invoiceId varchar(100),
          address text NULL,
          contact varchar(100) NULL,
          date_of_installation text NULL,
          wrranty_date text NULL,
          user_id int(10) NULL,
          PRIMARY KEY  (invoiceId, user_id)
     ) CHARACTER SET utf8 COLLATE utf8_general_ci; ";
    dbDelta( $sql_create_table);
}

// Create tables on plugin activation
//register_activation_hook( __FILE__, 'journal_create_tables' );
template_create_tables();