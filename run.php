<?php
/**	
 * Notifikasi prakerja
 * 
 * @release 2020
 * @author eco.nxn
 */
date_default_timezone_set("Asia/Jakarta"); //WIB
error_reporting(0);

/**
 * Config
 */
define("BOT_TOKEN", "ISI DISINI");
define("SLEEP_IN_MINUTES", 3); //looping setiap 3 menit

class curl {
	private $ch, $result, $error;
	
	/**	
	 * HTTP request
	 * 
	 * @param string $method HTTP request method
	 * @param string $url API request URL
	 * @param array $param API request data
     	 * @param array $header API request header
	 */
	public function request ($method, $url, $param, $header) {
		curl:
        $this->ch = curl_init();
        switch ($method){
            case "GET":
                curl_setopt($this->ch, CURLOPT_POST, false);
                break;
            case "POST":               
                curl_setopt($this->ch, CURLOPT_POST, true);
                curl_setopt($this->ch, CURLOPT_POSTFIELDS, $param);
                break;
        }
        curl_setopt($this->ch, CURLOPT_URL, 'https://api.prakerja.go.id'.$url);
        curl_setopt($this->ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:80.0) Gecko/20100101 Firefox/80.0');
        curl_setopt($this->ch, CURLOPT_HEADER, false);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 20);
        $this->result = curl_exec($this->ch);
        $this->error = curl_error($this->ch);
        if($this->error) {
            echo "[!] ".date('H:i:s')." | Connection Timeout\n";
            sleep(2);
            goto curl;
        }
        curl_close($this->ch);
        return $this->result;
    }   
}

class prakerja extends curl{

    /**
     * Login akun
     */
    function login($email, $pass) { 

        $method   = 'POST';
        $header[] = 'Content-Type: application/json';
        $header[] = 'Origin: https://dashboard.prakerja.go.id';
        $header[] = 'Referer: https://dashboard.prakerja.go.id/';
        $header[] = 'Authorization: null';

        $endpoint = '/api/v1/user/login';

        $param = json_encode([
            "email" => $email,
            "password" => $pass
        ]);
        
        $login = $this->request ($method, $endpoint, $param, $header); 

        $json = json_decode($login);
        if(isset($json->message)){
            echo "[i] ".date('H:i:s')." Login Msg: ".$json->message."\n";
        }
        return $json;         
    }

    /**
     * detail akun
     */
    function user_details($auth_token) { 

        $method   = 'GET';
        $header[] = 'Origin: https://dashboard.prakerja.go.id';
        $header[] = 'Referer: https://dashboard.prakerja.go.id/';
        $header[] = 'Authorization: '.$auth_token;

        $endpoint = '/api/v1/user/details';
        
        $detail = $this->request ($method, $endpoint, $param=NULL, $header); 

        $json = json_decode($detail);
        if(isset($json->message)){
            echo "[i] ".date('H:i:s')." userDetails Msg: ".$json->message."\n";
        }
        return $json;         
    }

    /**
     * saldo
     */
    function balance($auth_token) { 

        $method   = 'GET';
        $header[] = 'Origin: https://dashboard.prakerja.go.id';
        $header[] = 'Referer: https://dashboard.prakerja.go.id/';
        $header[] = 'Authorization: '.$auth_token;

        $endpoint = '/api/v1/tr/transaction/balance';
        
        $balance = $this->request ($method, $endpoint, $param=NULL, $header); 

        $json = json_decode($balance);
        if(isset($json->message)){
            echo "[i] ".date('H:i:s')." Balance Msg: ".$json->message."\n";
        }
        return $json;         
    }
    
    /**
     * survey
     */
    function survey($auth_token) { 

        $method   = 'GET';
        $header[] = 'Origin: https://dashboard.prakerja.go.id';
        $header[] = 'Referer: https://dashboard.prakerja.go.id/';
        $header[] = 'Authorization: '.$auth_token;

        $endpoint = '/api/v1/survey-incentive/check';
        
        $survey = $this->request ($method, $endpoint, $param=NULL, $header); 

        $json = json_decode($survey);
        if(isset($json->message)){
            echo "[i] ".date('H:i:s')." Survey Msg: ".$json->message."\n";
        }
        return $json;         
    }
    /**
     * list gelombang
     */
    function batch($auth_token) { 

        $method   = 'GET';
        $header[] = 'Origin: https://dashboard.prakerja.go.id';
        $header[] = 'Referer: https://dashboard.prakerja.go.id/';
        $header[] = 'Authorization: '.$auth_token;

        $endpoint = '/api/v1/batch/pool/list';
        
        $batch = $this->request ($method, $endpoint, $param=NULL, $header); 

        $json = json_decode($batch);
        if(isset($json->message)){
            echo "[i] ".date('H:i:s')." BatchList Msg: ".$json->message."\n";
        }
        return $json;         
    }

    /**
     * Sertifikat
     */
    function certificate($auth_token) { 

        $method   = 'POST';
        $header[] = 'Content-Type: application/json';
        $header[] = 'Origin: https://dashboard.prakerja.go.id';
        $header[] = 'Referer: https://dashboard.prakerja.go.id/';
        $header[] = 'Authorization: '.$auth_token;

        $endpoint = '/api/v1/certificate/certificate';

        $param = json_encode([
            "limit" => 99,
            "offset" => 0
        ]);
        
        $cert = $this->request ($method, $endpoint, $param, $header); 

        $json = json_decode($cert);
        if(isset($json->message)){
            echo "[i] ".date('H:i:s')." Certificate Msg: ".$json->message."\n";
        }
        return $json;         
    }

    /**
     * insentif
     */
    function incentive($auth_token) { 

        $method   = 'GET';
        $header[] = 'Origin: https://dashboard.prakerja.go.id';
        $header[] = 'Referer: https://dashboard.prakerja.go.id/';
        $header[] = 'Authorization: '.$auth_token;

        $endpoint = '/api/v1/tr/transaction/incentive/user';
        
        $incentive = $this->request ($method, $endpoint, $param=NULL, $header); 

        $json = json_decode($incentive);
        if(isset($json->message)){
            echo "[i] ".date('H:i:s')." Incentive Msg: ".$json->message."\n";
        }
        return $json;         
    }

    /**
     * Telegram Notifications
     */
    function send_message($token, $chat_id_array, $text) {

        $endpoint = 'https://api.telegram.org/bot'.$token.'/sendMessage';

        foreach ($chat_id_array as $chat_id) {
            $param = http_build_query(['chat_id' => $chat_id, 'text' => $text]);
            $opts = array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-Type: application/x-www-form-urlencoded',
                    'content' => $param
                )
            );
            
            $context  = stream_context_create($opts);
            send_again:
            $send_message = file_get_contents($endpoint, false, $context);
    
            $json = json_decode($send_message);
            if($json->ok==true) {
                echo "(i) ".date('H:i:s')." Message has been sent to ".$chat_id."\n";
            } else {
                echo "(!) ".date('H:i:s')." Message hasn't sent to ".$chat_id."\n";
                sleep(5);
                goto send_again;
            }
        }
    }
}

$prakerja = new prakerja();
$token = BOT_TOKEN;

/**
 * Running
 */
echo "Checking for Updates...";
$version = '1.7';
check_update:
$json_ver = json_decode(file_get_contents('https://bangeko.com/app_ver/prakerja.json'));
echo "\r\r                       ";
if(isset($json_ver->version)) {
    if($version != $json_ver->version) {
        echo "\n".$json_ver->msg."\n\n";
        die();
    }
	echo "\n";
} else {
    goto check_update;
}

start:
if(file_exists("all_akun.CSV")) {
    $list = explode("\n",str_replace("\r","",file_get_contents("all_akun.CSV")));
} else {
    echo "(!) Belum ada list akun\n\n";
    die();
}

$no=1;
foreach ($list as $value) {
    if(empty($value)) {
        if(count($list) == 1){
            die();
        }
        continue;
    }

    $exp_acc = explode(";", $value);

    $chat_id = $exp_acc[0];
    $chat_id_array = explode("-", $chat_id);
    $email = $exp_acc[1];
    $password = $exp_acc[2];
    $auth_token = $exp_acc[3];

    echo "[".$no++."] ".date('H:i:s')." | Email: ".$email."\n";

    $user_details = $prakerja->user_details($auth_token);
    if($user_details->success == false){
        $login = $prakerja->login($email, $password);
        if(isset($login->data->token)){
            $auth_token = $login->data->token;
            detail_again:
            $user_details = $prakerja->user_details($auth_token);
            if($user_details->success == false){
                sleep(5);
                goto detail_again; 
            }
        } else {
            if(is_numeric(strpos($login->message, 'Anda melakukan kesalahan terlalu banyak'))){
                $fh = fopen('archived_akun.CSV', 'a');
                fwrite($fh, $chat_id.';'.$email.';'.$password."\n");
                fclose($fh);
            } elseif(is_numeric(strpos($login->message, 'invalid email or password'))){
                $text = "Program Prakerja\n\nMaaf, Akses login kamu salah, mohon login kembali!";
                $prakerja->send_message($token, $chat_id_array, $text);
                $fh = fopen('archived_akun.CSV', 'a');
                fwrite($fh, $chat_id.';'.$email.';'.$password."\n");
                fclose($fh);
            } else {
                $fh = fopen('akun.CSV', 'a');
                fwrite($fh, $chat_id.';'.$email.';'.$password.';'.$auth_token."\n");
                fclose($fh);
            }
            continue;
        }
    }
    
    $user_id = $user_details->data->id;
    $user_fullname = $user_details->data->name;
    $isJoinBatch = $user_details->data->isJoinBatch;    

    batch_again:
    $batch = $prakerja->batch($auth_token);
    if($batch->success == false){
        sleep(5);
        goto batch_again;
    }

    $already_join_batch = $batch->data->already_join_batch;

    if(!empty($user_id) && $isJoinBatch == 0 && $already_join_batch == "X"){
        if(!isset($status_lolos[$user_id]) || $status_lolos[$user_id] != "gagal"){
            $text = "Program Prakerja\n\nHi ".$user_fullname.",\nMaaf! Kamu BELUM LOLOS Pendaftaran Prakerja pada gelombang pilihanmu.";
            $prakerja->send_message($token, $chat_id_array, $text);
        }
        $status_lolos[$user_id] = "gagal";
        
        $fh = fopen('akun.CSV', 'a');
        fwrite($fh, $chat_id.';'.$email.';'.$password.';'.$auth_token."\n");
        fclose($fh);
    } elseif(!empty($user_id) && $isJoinBatch == 0 && !isset($batch->data->items) && $already_join_batch == "Y"){
        if(!isset($status_lolos[$user_id]) || $status_lolos[$user_id] != "calon_lolos"){
            $text = "Program Prakerja\n\nHi ".$user_fullname.",\nYay! Pendaftaran Prakerja pada gelombang pilihanmu SEDANG DI EVALUASI namun kemungkinan besar kamu AKAN LOLOS. Tunggu info selanjutnya ya!";
            $prakerja->send_message($token, $chat_id_array, $text);
        }
        $status_lolos[$user_id] = "calon_lolos";
        
        $fh = fopen('akun.CSV', 'a');
        fwrite($fh, $chat_id.';'.$email.';'.$password.';'.$auth_token."\n");
        fclose($fh);
    } elseif(!empty($user_id) && $isJoinBatch == 1 && $already_join_batch == "Y"){
        if(!isset($status_lolos[$user_id]) || $status_lolos[$user_id] != "lolos"){
            $text = "Program Prakerja\n\nHi ".$user_fullname.",\nYay! Kamu LOLOS Pendaftaran Prakerja pada gelombang pilihanmu.";
            $prakerja->send_message($token, $chat_id_array, $text);
        }
        $status_lolos[$user_id] = "lolos";

        //Nomor Prakerja
        if(!empty($user_details->data->noPrakerja)){
            if($noPrakerja[$user_id] != $user_details->data->noPrakerja){
                $text = "Program Prakerja\n\nHi ".$user_fullname.",\nNomor Prakerja kamu adalah ".$user_details->data->noPrakerja."\n";
                $prakerja->send_message($token, $chat_id_array, $text);
                $noPrakerja[$user_id] = $user_details->data->noPrakerja;
            }

            //Saldo
            balance_again:
            $balance = $prakerja->balance($auth_token);
            if($balance->success == false){
                sleep(5);
                goto balance_again;
            }
            
            if(isset($balance->data->balance) && $saldo[$user_id] != $balance->data->balance){
                $text = "Program Prakerja\n\nHi ".$user_fullname.",\nSaldo Prakerja kamu sekarang adalah Rp. ".number_format($balance->data->balance)."\n";
                $prakerja->send_message($token, $chat_id_array, $text);
                $saldo[$user_id] = $balance->data->balance;
            }
        }

        //Survey check
        survey_again:
        $survey = $prakerja->survey($auth_token);
        if($survey->success == false){
            sleep(5);
            goto survey_again;
        }
        if(isset($survey->data->scheme_id)){
            if($survey[$user_id] != $survey->data->status){
                $prakerja->send_message($token, $chat_id_array, "Program Prakerja:\n\nHi ".$user_fullname.",\nSurvei Evaluasi Program Kartu Prakerja telah Tersedia untuk Diisi untuk mendapatkan Insentif Rp.50.000.");
                $survey[$user_id] = false;
            }   
        } else {
            $survey[$user_id] = false;
        }

        // Sertifikat
        cert_again:
        $cert = $prakerja->certificate($auth_token);
        if($cert->success == false){
            sleep(5);
            goto cert_again;
        }
        if(count($cert->data->certification) >= 1 && $cert_user_count[$user_id] <> count($cert->data->certification)){
            $no_cert=1;$text ="Program Prakerja:\n\nHi ".$user_fullname.",\nBerikut daftar sertifikat kamu pada dashboard prakerja:\n";
            foreach ($cert->data->certification as $certification) {
                $text = $text."[".$no_cert++."] ".$certification->course_name." (".$certification->institute_name.")\n";
            }
            $prakerja->send_message($token, $chat_id_array, $text);
        }
        $cert_user_count[$user_id] = count($cert->data->certification);

        // Insentif 
        incent_again:
        $incentive = $prakerja->incentive($auth_token);
        if($incentive->success == false){
            sleep(5);
            goto incent_again;
        }
        if(count($incentive->data->items) >=1){
            
            $no_jd=1; 
            unset($text);
            if($incentive_user[$user_id] != count($incentive->data->items)){
                $text = "Program Prakerja:\n\nHi ".$user_fullname.",\nBerikut informasi jadwal insentif kamu:\n";
            }
            foreach ($incentive->data->items as $all_incentive) {
                switch($all_incentive->status){
                    case"1":
                        $incentive_status = "Menunggu Diproses";
                    break;
                    case"2":
                        $incentive_status = "Dijadwalkan";
                    break;
                    case"3":
                        $incentive_status = "Berhasil Ditransfer";
                    break;
                    case"4":
                        $incentive_status = "Dana Tertahan";
                    break;
                    case"5":
                        $incentive_status = "Sedang Diproses";
                    break;
                    case"6":
                        $incentive_status = "Rekening Tidak Ditemukan";
                    break;
                    case"7":
                        $incentive_status = "E-wallet Belum KYC";
                    break;
                    case"8":
                        $incentive_status = "Membutuhkan Ulasan Pelatihan";
                    break;
                    case"9":
                        $incentive_status = "Dalam Pengecekan";
                    break;
                }
                if(isset($status_incentive[$user_id][$all_incentive->code]) && $status_incentive[$user_id][$all_incentive->code] != $incentive_status){
                    $prakerja->send_message($token, $chat_id_array, "Program Prakerja:\n\nHi ".$user_fullname.",\nStatus Insentif Rp. ".number_format($all_incentive->amount)." yang dijadwalkan pada ".date_format(date_create($all_incentive->due_date), 'd M Y')." dengan kode ".$all_incentive->code." telah berubah status dari ".strtoupper($status_incentive[$user_id][$all_incentive->code])." menjadi ".strtoupper($incentive_status)."\nAyo cek sekarang!");
                }
                $status_incentive[$user_id][$all_incentive->code] = $incentive_status;

                if($incentive_user[$user_id] != count($incentive->data->items)){
                    $text = $text."[".$no_jd++."] Rp. ".number_format($all_incentive->amount)." - ".date_format(date_create($all_incentive->due_date), 'd M Y')." - ".$incentive_status."\n";
                }  
            }
            $incentive_user[$user_id] = count($incentive->data->items);
            if(isset($text)){
                $prakerja->send_message($token, $chat_id_array, $text);
            }
        }
        
        $fh = fopen('akun.CSV', 'a');
        fwrite($fh, $chat_id.';'.$email.';'.$password.';'.$auth_token."\n");
        fclose($fh);
    } else {        
        $fh = fopen('akun.CSV', 'a');
        fwrite($fh, $chat_id.';'.$email.';'.$password.';'.$auth_token."\n");
        fclose($fh);
    }
}

if(file_exists('akun.CSV')){
    unlink('all_akun.CSV');
    sleep(2);
    rename('akun.CSV', 'all_akun.CSV');
}

if(date('G') <= 6) { //rule jam 12 malam - 6 pagi
    $minutes = SLEEP_IN_MINUTES*3; //jeda = 3 x SLEEP_IN_MINUTES
} elseif(date('G') <= 17) { //rule jam 6 pagi - 3 sore
    $minutes = SLEEP_IN_MINUTES; //jeda = normal SLEEP_IN_MINUTES
} else { //rule jam 3 sore - 12 malam
    $minutes = SLEEP_IN_MINUTES*2; //jeda = 2 x SLEEP_IN_MINUTES
}
echo "\nSleep ".$minutes." minutes..";
sleep(60*$minutes);
print "\n\n".chr(27).chr(91).'H'.chr(27).chr(91).'J'."\n";
goto start;
