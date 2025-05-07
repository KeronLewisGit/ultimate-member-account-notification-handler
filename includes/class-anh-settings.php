<?php
/**
 * Settings API integration.
 */
class ANH_Settings {
    public static function register_settings() {
        // Register options
        register_setting('anh_settings', 'anh_from_email', 'sanitize_email');
        register_setting('anh_settings', 'anh_cash_subject', 'sanitize_text_field');
        register_setting('anh_settings', 'anh_cash_body', 'wp_kses_post');
        register_setting('anh_settings', 'anh_charge_subject', 'sanitize_text_field');
        register_setting('anh_settings', 'anh_charge_body', 'wp_kses_post');
        register_setting('anh_settings', 'anh_attachment_id', 'absint');
        // Section
        add_settings_section('anh_section', __('Email Templates','account-notifications'), function(){}, 'anh_settings');
        // Fields
        self::add_field('anh_from_email', 'From Email', 'email');
        self::add_field('anh_cash_subject', 'Cash Subject', 'text');
        self::add_field('anh_cash_body', 'Cash Body', 'textarea');
        self::add_field('anh_charge_subject', 'Charge Subject', 'text');
        self::add_field('anh_charge_body', 'Charge Body', 'textarea');
        add_settings_field('anh_attachment_id', __('Attachment','account-notifications'), ['self','field_attachment_cb'], 'anh_settings','anh_section');
    }

    private static function add_field($name,$title,$type){
        add_settings_field($name,__($title,'account-notifications'),[self,'field_cb'],$name,'anh_section',['type'=>$type]);
    }

    public static function field_cb($args){
        $name=$args['id']; $val=get_option($name);
        if($args['type']==='textarea') printf('<textarea name="%1$s" rows="5" class="large-text">%2$s</textarea>',$name,esc_textarea($val));
        else printf('<input type="%1$s" name="%2$s" value="%3$s" class="regular-text" />',$args['type'],$name,esc_attr($val));
    }

    public static function field_attachment_cb(){
        $id=get_option('anh_attachment_id'); $url=$id?wp_get_attachment_url($id):'';
        echo '<input type="hidden" id="anh_attachment_id" name="anh_attachment_id" value="'.esc_attr($id).'"/>'; 
        echo '<button id="anh_upload_button" class="button">'.__('Select Attachment','account-notifications').'</button>';
        echo '<div id="anh_attachment_preview">'.($url?'<a href="'.$url.'" target="_blank">'.basename($url).'</a>':'').'</div>';
    }

    public static function add_settings_page(){
        add_options_page(__('Account Notifications','account-notifications'),__('Account Notifications','account-notifications'),'manage_options','anh_settings',[self,'render_page']);
    }

    public static function enqueue_assets($hook){
        if($hook!=='settings_page_anh_settings') return;
        wp_enqueue_media(); wp_enqueue_script('anh-admin-js',plugins_url('../assets/js/admin.js',__FILE__),['jquery']);
        wp_enqueue_style('anh-admin-css',plugins_url('../assets/css/admin.css',__FILE__));
    }

    public static function render_page(){
        echo '<div class="wrap"><h1>'.__('Account Notifications','account-notifications').'</h1>';
        echo '<form method="post" action="options.php">'; settings_fields('anh_settings'); do_settings_sections('anh_settings'); submit_button();
        echo '</form></div>';
    }
}
