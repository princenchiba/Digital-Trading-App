<?php  namespace App\Libraries;
use App\Models\Cmmon_model;

/* 
|--------------------------------------------------------
| SEND SMS API (SMSRank, Nexmo, Twilio, BudgetSMS, Infobip)
| @author : Md. Tareq Rahman
| @email  : <tareq7500@gmail.com>
| @created at: 11 May 2018
|--------------------------------------------------------
| $this->load->library('sms_lib');
| $this->sms_lib->send(array(
|     'to'       => +8801746406801, 
|     'template' => 'Hello %x%', 
|     'template_config' => array('x'=>'Mr. X'), 
| ));
|--------------------------------------------------------
*/

class Sms_lib
{
    public function __construct()
    {
        $this->session    = session();
        $this->db         = db_connect();
    }

    public function send($config = array())
    {    
        $sms = $this->db->table('email_sms_gateway')->select('*')->where('es_id', 1)->get()->getRow();
        $url      = $sms->host;
        $api      = $sms->api;
        $username = $sms->user;
        $userid   = $sms->userid;
        $password = $sms->password;
        $from     = $sms->title;

        $message = $config['template'];
        
        if ($sms->gatewayname=='budgetsms') {
            /****************************
            * budgetsms Gateway Setup
            ****************************/
            // URL https://api.budgetsms.net/sendsms/?

            $data = array(
                'handle'   => $api,
                'username' => $username,
                'userid'   => $userid,
                'from'     => $from,
                'msg'      => $message,
                'to'       => $config['to']
            );


            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($curl);    

            if(curl_errno($curl)) 
            {      
                return json_encode(array(
                    'status'      => false,
                    'message'     => 'Curl error: ' . curl_error($curl)
                ));
            } else {    
                return json_encode(array(
                    'status'      => true,
                    'message'     => "success: ". $response
                ));  
            }   

            curl_close($curl);

        }else if ($sms->gatewayname=='infobip') {
            /****************************
            * Infobip Gateway Setup
            ****************************/
            // https://api.infobip.com/sms/1/text/single
            // $username
            // $password

            $data = array(
                'from'     => $from,
                'text'     => $message,
                'to'       => $config['to']
            );

            $username = $username;
            $password = $userid;
            $header = "Basic " . base64_encode($username . ":" . $password);


            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "$url",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "accept: application/json",
                    "authorization: $header",
                    "content-type: application/json"
                ),
            ));

            $response = curl_exec($curl);    
            if(curl_errno($curl)) 
            {      
                return json_encode(array(
                    'status'      => false,
                    'message'     => 'Curl error: ' . curl_error($curl)
                ));
            } else {    
                return json_encode(array(
                    'status'      => true,
                    'message'     => "success: ". $response
                ));  
            }
            curl_close($curl);


        }else if ($sms->gatewayname == 'smsrank') {
            /****************************
            * SMSRank Gateway Setup
            ****************************/
            // http://api.smsrank.com/sms/1/text/singles
            // $username
            // $password

            $password=base64_encode($password); 
            $message=base64_encode($message);
            $recipients = $config['to'];
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, "$url?username=$username&password=$password&to=$recipients&text=$message");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
            curl_setopt($curl, CURLOPT_USERAGENT, $agent);
            $output = json_decode(curl_exec($curl), true);
            
            return  true;

            curl_close($curl);


        }else if ($sms->gatewayname=='nexmo') {
            /****************************
            * NEXMO Gateway Setup
            ****************************/
            // # Linux/MacOS
            // curl.cainfo = "/etc/pki/tls/cacert.pem"
            // # Windows
            // curl.cainfo = "C:\php\extras\ssl\cacert.pem"

            // NEXMO_API_KEY =f19c49c5
            // NEXMO_API_SECRET =t43ZQoQqxmQpq7lQ

            /*$data = array(
                'from'     => $from,
                'text'     => $message,
                'to'       => $config['to']
            );

            require APPPATH.'Libraries/sms-sdk/nexmo/vendor/autoload.php';

            $basic  = new \Nexmo\Client\Credentials\Basic($api, $password);
            $client = new \Nexmo\Client($basic);

            $message = $client->message()->send($data);

            if(!$message) 
            {      
                return json_encode(array(
                    'status'      => false,
                    'message'     => 'Curl error: '
                ));
            } else {    
                return json_encode(array(
                    'status'      => true,
                    'message'     => "success: "
                ));  
            }*/


            $url = 'https://rest.nexmo.com/sms/json?' . http_build_query([

                'api_key'    =>$api,
                'api_secret' =>$password,
                'to'         =>$config['to'],
                'from'       =>$from,
                'text'       =>$message

            ]);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $data = json_decode($response);

            if($data->messages[0]->status==0){
                return json_encode(array(
                    'status'      => true,
                    'message'     => "success: "
                ));
            }
            else{
                return json_encode(array(
                    'status'      => false,
                    'message'     => 'Send Fail: '
                ));
            }
        }
    }

    private function _template($template = null, $data = array())
    {

        $newStr = $template;
        foreach ($data as $key => $value) {
            $newStr = str_replace("%$key%", $value, $newStr);
        } 
        return $newStr; 
    }
}






