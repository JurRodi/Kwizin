<?php 

    class Location{
        protected $name;
        protected $city;
        protected $distance;

        public static function getVisIpAddr() {
        
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                return $_SERVER['HTTP_CLIENT_IP'];
            }
            else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            else if (!empty($_SERVER['HTTP_X_FORWARDED'])) {
                return $_SERVER['HTTP_X_FORWARDED'];
            }
            else if (!empty($_SERVER['HTTP_FORWARDED'])) {
                return $_SERVER['HTTP_FORWARDED'];
            }
            else if (!empty($_SERVER['HTTP_X_REAL_IP'])) {
                return $_SERVER['HTTP_X_REAL_IP'];
            }
            else {
                return $_SERVER['REMOTE_ADDR'];
            }
        }
    }