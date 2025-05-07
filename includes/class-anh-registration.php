<?php
/**
 * Registration & email processing.
 */
class ANH_Registration {
    public static function process_registration($user_id,$form_values){
        $type=strtolower(sanitize_text_field($form_values['account_type']??''));
        $site=['name'=>get_bloginfo('name'),'url'=>home_url()];
        if(in_array($type,['cash','cash account'],true)){
            if(function_exists('UM')){UM()->common()->users()->approve($user_id,true);UM()->user()->auto_login($user_id);}  
            self::send_email($user_id,'cash',$site);wp_safe_redirect($site['url']);exit;
        }
        self::send_email($user_id,'charge',$site);
    }

    protected static function send_email($user_id,$type,$site){
        $user=get_userdata($user_id);if(!$user)return;
        $to=$user->user_email;$first=get_user_meta($user_id,'first_name',true);
        $last=get_user_meta($user_id,'last_name',true);
        $from=get_option('anh_from_email',get_bloginfo('admin_email'));
        $subject=get_option($type==='charge'?'anh_charge_subject':'anh_cash_subject');
        $body=get_option($type==='charge'?'anh_charge_body':'anh_cash_body');
        $vars=['{first_name}'=>$first,'{last_name}'=>$last,'{site_name}'=>$site['name'],'{site_url}'=>$site['url']];
        $subject=strtr($subject,$vars);$body=strtr($body,$vars);
        $headers=["Content-Type: text/html; charset=UTF-8","From: ".sanitize_email($from)];
        $attachments=[];
        if($type==='charge'){ $aid=get_option('anh_attachment_id'); if($aid && ($file=get_attached_file($aid)))$attachments[]=$file; }
        wp_mail($to,wp_strip_all_tags($subject),$body,$headers,$attachments);
    }
}
