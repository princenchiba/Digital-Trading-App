<?php if(!defined('APPPATH')) exit('No direct script access allowed');
 if(!function_exists('display')) {

    function display($text = null)
    {
        $db  = db_connect();
        $ci  = session();

        $table  = 'language';
        $phrase = 'phrase';

        #---------------------------------------
        #   modify function 30-01-2018
        #--------------------------------------
        $user_id = $ci->get('user_id');
        if(!empty($user_id)){

            $default_lang  = 'english';
            $setting_table = 'dbt_user';
            $data = $db->table($setting_table)->select('*')->where('user_id', $user_id)->get()->getRow();

        } else {

            $default_lang  = 'english';
            $setting_table = 'setting';
            //set language  
            $data = $db->table($setting_table)->select('*')->get()->getRow();
            
        }#end

        /*if (!empty($ci->get('lang'))) {

            $language = $ci->get('lang'); 

        } else if(!empty($data->language)){

            $language = $data->language; 

        } else {

            $language = $default_lang; 
        }*/


        if(!empty($user_id)){

            $language = $data->language; 

        } else if (!empty($ci->get('lang'))) {

            $language = $ci->get('lang'); 

        } else {

            $language = $default_lang; 
        } 
 
        if (!empty($text)) {

            if ($db->tableExists($table)) { 

                if ($db->fieldExists($phrase, $table)) { 

                    if ($db->fieldExists($language, $table)) {

                        $row = $db->table($table)->select('*')->where($phrase, $text)->get()->getRow();

                        if (!empty($row->$language)) {
                            return esc($row->$language);
                        } else {
                            return false;
                        }

                    } else {
                        return false;
                    }

                } else {
                    return false;
                }

            } else {
                return false;
            }            
        } else {
            return false;
        }  

    }
 
}

function set_status_header($code = 200, $text = '')
{
        if (is_cli())
        {
            return;
        }

        if (empty($code) OR ! is_numeric($code))
        {
            show_error('Status codes must be numeric', 500);
        }

        if (empty($text))
        {
            is_int($code) OR $code = (int) $code;
            $stati = array(
                100 => 'Continue',
                101 => 'Switching Protocols',

                200 => 'OK',
                201 => 'Created',
                202 => 'Accepted',
                203 => 'Non-Authoritative Information',
                204 => 'No Content',
                205 => 'Reset Content',
                206 => 'Partial Content',

                300 => 'Multiple Choices',
                301 => 'Moved Permanently',
                302 => 'Found',
                303 => 'See Other',
                304 => 'Not Modified',
                305 => 'Use Proxy',
                307 => 'Temporary Redirect',

                400 => 'Bad Request',
                401 => 'Unauthorized',
                402 => 'Payment Required',
                403 => 'Forbidden',
                404 => 'Not Found',
                405 => 'Method Not Allowed',
                406 => 'Not Acceptable',
                407 => 'Proxy Authentication Required',
                408 => 'Request Timeout',
                409 => 'Conflict',
                410 => 'Gone',
                411 => 'Length Required',
                412 => 'Precondition Failed',
                413 => 'Request Entity Too Large',
                414 => 'Request-URI Too Long',
                415 => 'Unsupported Media Type',
                416 => 'Requested Range Not Satisfiable',
                417 => 'Expectation Failed',
                422 => 'Unprocessable Entity',
                426 => 'Upgrade Required',
                428 => 'Precondition Required',
                429 => 'Too Many Requests',
                431 => 'Request Header Fields Too Large',

                500 => 'Internal Server Error',
                501 => 'Not Implemented',
                502 => 'Bad Gateway',
                503 => 'Service Unavailable',
                504 => 'Gateway Timeout',
                505 => 'HTTP Version Not Supported',
                511 => 'Network Authentication Required',
            );

            if (isset($stati[$code]))
            {
                $text = $stati[$code];
            }
            else
            {
                show_error('No status text available. Please check your status code number or supply your own message text.', 500);
            }
        }

        if (strpos(PHP_SAPI, 'cgi') === 0)
        {
            header('Status: '.$code.' '.$text, TRUE);
            return;
        }

        $server_protocol = (isset($_SERVER['SERVER_PROTOCOL']) && in_array($_SERVER['SERVER_PROTOCOL'], array('HTTP/1.0', 'HTTP/1.1', 'HTTP/2'), TRUE))
            ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1';
        header($server_protocol.' '.$code.' '.$text, TRUE, $code);
}

