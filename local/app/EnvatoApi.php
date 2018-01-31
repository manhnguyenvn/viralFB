<?php namespace viralfb;

use DB;

class EnvatoApi{


   public function checkLicense(){
   	
   	    /**
   	     * License check for Auto-Updates to external server and return response from envatoApi
   	     *
   	     * @Return response
   	     */

        $secretkey = DB::table('configs')->where('nume', 'secr')->pluck('valoare');
        $tokenapp = DB::table('configs')->where('nume', 'tokenapp')->pluck('valoare');


        $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';

                if ($secretkey == "") {
                    DB::table('configs')->where('nume', 'secr')->update(array('valoare' => ''));
                    DB::table('configs')->where('nume', 'tokenapp')->update(array('valoare' => ''));
                    //Return true if license is empty
                    return true;
                } else {

                    $configs = DB::table('configs')
                        ->where('nume', 'basic')
                        ->pluck('valoare');

                    $configs = json_decode($configs, true);


                    $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
                    if(!empty($configs['tokenapp'])){
                    $url = "http://yalayolo.me/vapi/api/api.php?license=".$secretkey."&domain=".$root."&product=viralfb&token=".$tokenapp;
                     }else{
                    $url = "http://yalayolo.me/vapi/api/api.php?license=".$secretkey."&domain=".$root."&product=viralfb";
                     }


                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_HEADER, false);
                    $data = curl_exec($curl);
                    curl_close($curl);
                    $json = $data;
                    if (strpos($json, 'Wrong license key')!==false) {
                        DB::table('configs')->where('nume', 'secr')->update(array('valoare' => ''));
                        DB::table('configs')->where('nume', 'tokenapp')->update(array('valoare' => ''));
                        //Return true if license is invalid
                        return true;
                    }
                }
        

   }//End checkLicense()

   public function compareKey($pkhash, $pk)
    {
        $given_hash = $pkhash;
        $test_pw = $pk;

            // extract the hashing method, number of rounds, and salt from the stored hash
            // and hash the password string accordingly
            $parts = explode('$', $given_hash);
        $test_hash = crypt($test_pw, sprintf('$%s$%s$%s$', $parts[1], $parts[2], $parts[3]));

            // compare
            return var_export($given_hash === $test_hash, true);
    }//End compareKey()

    public function genSecretKey($pk)
    {
        $salt = substr(str_replace('+', '.', base64_encode(md5(mt_rand(), true))), 0, 16);
        // how many times the string will be hashed
        $rounds = 10000;
        // pass in the password, the number of rounds, and the salt
        // $5$ specifies SHA256-CRYPT, use $6$ if you really want SHA512
        return crypt('password123', sprintf('$5$rounds=%d$%s$', $rounds, $salt));
    }//End genSecretKey()

}
