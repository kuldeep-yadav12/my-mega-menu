<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class MMM_Storage {
    public static function save_template_id( $item_id, $template_id ) {
        $data = get_post_meta( $item_id, '_mmm_data', true );
        if ( ! is_array( $data ) ) { $data = array(); }
        $data['template_id'] = intval( $template_id );
        update_post_meta( $item_id, '_mmm_data', $data );
    }

    public static function get_template_id( $item_id ) {
        $data = get_post_meta( $item_id, '_mmm_data', true );
        return isset( $data['template_id'] ) ? intval( $data['template_id'] ) : 0;
    }


    private static function key( $item_id ) {
        return 'mmm_item_' . intval( $item_id );
    }

    public static function get( $item_id ) {
        $default = array( 'enabled' => false, 'content' => '' );
        $data = get_option( self::key( $item_id ), $default );
        if ( ! is_array( $data ) ) {
            return $default;
        }
        return wp_parse_args( $data, $default );
    }

    public static function save( $item_id, $data ) {
        return update_option( self::key( $item_id ), $data, false );
    }

    public static function is_enabled( $item_id ) {
        $data = self::get( $item_id );
        return ! empty( $data['enabled'] );
    }

    public static function get_content( $item_id ) {
        $data = self::get( $item_id );
        return isset( $data['content'] ) ? $data['content'] : '';
    }

    public static function toggle( $item_id, $enabled ) {
        $data = self::get( $item_id );
        $data['enabled'] = (bool) $enabled;
        return self::save( $item_id, $data );
    }
}
