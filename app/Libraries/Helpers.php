<?php

class Helpers {

    public static function assets_path($strPath) {
        return url('/') . '/resources/assets/' . $strPath;
    }

    public static function views_path($strPath) {
        return url('/') . '/resources/views/' . $strPath;
    }
    
    public static function site_url($strPath) {
        return url('/') . $strPath;
    }

}
