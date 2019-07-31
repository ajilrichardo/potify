<?php
error_reporting(0);
$headers = array();
$headers[] = 'User-Agent: Spotify/8.4.98 Android/25 (ASUS_X00HD)';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'Connection: Keep-Alive';
// CURL Register Spotify
echo "===========================\n";
echo "Auto Create Spotify Account\n";
echo "     By : Gidhan B.A\n";
echo "===========================\n";
echo "";
echo "Email Yang Mau Dipakai : "; $pakai = trim(fgets(STDIN)); 
echo "Banyak Akun Yang Ingin Dibuat : "; $banyak = trim(fgets(STDIN)); 
while (1) 
{
	for ($i=0; $i < $banyak ; $i++) {
		$mail = $pakai.$i."@official.com"; 
		$send = curl('https://spclient.wg.spotify.com:443/signup/public/v1/account/', 'iagree=true&birth_day=12&platform=Android-ARM&creation_point=client_mobile&password=12345678&key=142b583129b2df829de3656f9eb484e6&birth_year=2000&email='.$mail.'&gender=male&app_version=849800892&birth_month=12&password_repeat=12345678', $headers);
		$data = json_decode($send[0]);
		if ($data->status == 1) {
			echo "\nSukses | Email : ".$mail;
			$file = "spotify.html";
			$handle = fopen($file, 'a');
			fwrite($handle, $mail."<br>");
			fclose($handle);
		} else {
			die("\n\nPay Manual Ya Gan\n");
		}
	}
}
function random($length,$a) 
{
		$str = "";
		if ($a == 0) {
			$characters = array_merge(range('0','9'));
		}elseif ($a == 1) {
			$characters = array_merge(range('a','z'));
		}elseif ($a == 2) {
			$characters = array_merge(range('A','Z'));
		}elseif ($a == 3) {
			$characters = array_merge(range('0','9'),range('a','z'));
		}elseif ($a == 4) {
			$characters = array_merge(range('0','9'),range('A','Z'));
		}elseif ($a == 5) {
			$characters = array_merge(range('a','z'),range('A','Z'));
		}elseif ($a == 6) {
			$characters = array_merge(range('0','9'),range('a','z'),range('A','Z'));
		}
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
}
function curl($url, $fields = null, $headers = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if ($fields !== null) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        }
        if ($headers !== null) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $result   = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        return array(
            $result,
            $httpcode
        );
 }
?>
