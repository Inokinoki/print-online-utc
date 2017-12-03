<?php
/**
 * Do Login Model
 */
class DoLoginModel extends Model 
{
    private $_username;
    private $_password;
    private $_birthday;
    private $_uid;
    private $_login_result;

    /**
     * @return bool
     */
    private function hasUser(){
        $this->_table = "Account";
        if (isset(Model::$_params[POST]["username"]))
            $this->_username = Model::$_params[POST]["username"];
        if (isset(Model::$_params[POST]["password"]))
            $this->_password = Model::$_params[POST]["password"];
        if (isset(Model::$_params[POST]["birthday"]))
            $this->_birthday = Model::$_params[POST]["birthday"];
        if (!empty($this->_username)) {
            $this->_login_result = $this->where($where = array("username='".$this->_username."'"))->selectAll();
            if (count($this->_login_result)>0){
                $this->_uid = $this->_login_result[0]["id"];
                return true;
            }
        }
        return false;
    }

    private function validPassword(){
        if (count($this->_login_result)>0){
            if ($this->_password == $this->_login_result[0]["password"])
                return true;
        }
        return false;
    }


    private function activate(){
        $logger = new LogModel();
        $logger->logWithOperation("Activate", "username=".$this->_username." birthday=".$this->_birthday);
        $url = "https://neptune.utc.fr/etu/login.cgi";
        $post_data = "birthday=".$this->_birthday."&username=".$this->_username."&passwd=".$this->_password;
        $passport_curl = curl_init();
        curl_setopt($passport_curl, CURLOPT_URL, $url);
        curl_setopt($passport_curl, CURLOPT_RETURNTRANSFER, 1);
        // Post
        curl_setopt($passport_curl, CURLOPT_POST, 1);
        curl_setopt($passport_curl, CURLOPT_POSTFIELDS, $post_data);
        $passport_result = curl_exec($passport_curl);
        // Get code
        $passport_code = curl_getinfo($passport_curl, CURLINFO_HTTP_CODE); 
        curl_close($passport_curl);
        $this->_table = "Account";
        if (strstr($passport_result, "<a href=\"index.cgi\">here</a>.")){
            // Activate successfully, save user info into database, and login in
            if (APP_DEBUG === true)
                echo $url."+ args:".$post_data. " OK<br/>";
            // Generate uuid
            $uuid = uniqid("Temp-");

            $datas['id'] = "NULL";
            $datas['username'] = $this->_username;
            $datas['password'] = $this->_password;
            $datas['uuid'] = $uuid;
            $datas['solde'] = '0';
            $datas['level'] = '0';
            $datas['birthday'] = $this->_birthday;
            
            setcookie("print-uuid", $uuid, 0, View::$dirConfig['root']);

            $result = $this->add($datas);

            $logger->logWithOperation("Activated", "username=".$this->_username." birthday=".$this->_birthday);
            $logger->logWithOperation("Login", "username=".$this->_username." birthday=".$this->_birthday);

            return 0;
        } else {
            $logger->logWithOperation("Activate Fail", "username=".$this->_username." birthday=".$this->_birthday);
            if (APP_DEBUG === true)
                echo $url."+ args:".$post_data. " L'authentification a échoué!<br/>";
            // L'authentification a échoué!
            return 8;
        }
    }

    public function anotherActivate(){
        $logger = new LogModel();
        $logger->logWithOperation("Activate", "username=".$this->_username);
        $url = "https://cas.utc.fr/cas/login";

        $token = "b8fe522e-2424-4fde-8afc-8872bb7e12bc_ZXlKaGJHY2lPaUpJVXpVeE1pSjkuVUdGMGVtd3lhM1V5WVV3d1lWSXlXV2d2YlhjdmRHSnVRVlo0UkVwNVJsVlJNVzVpYVU1WVFqUTVURVJzZDNoSlYxVmFWalI2VUZSWGFVcGlLM0ZWVmtkQ2JtZG9OMmhaTjJGNlNIaG5SbmR1YjJWSE1USndRM05qWkZsSlJHNUNWRUZpV1VSRFRUSkxZMEU1V0U5Uk5tRTBTbFpuZDJkdFREaFdWR2swTm5KaGMweG9jRTFEVldwNFJWUnhhekl2UVRGV0wwVTJOMVZDVEhWdFpEZDJTWEp6Y0ZaWlVYVnJkMWxVUkd0V1ptSTJabEJOVjA4eFNsRXlSa1oyV210UFVWSnNhazVyVkZSSlYzYzFaMHRsVFZabFkzSmtRVVU0TnprMmNsaFdjRlU1VHpGcFFYTkRWMjlwZUdKQlZUUXhiMlJvWkd3dmFIaEpZMFprZDFONFpFdzJhemt3UkVGSFltZHplVFk1Y0ZncmFtOTJUUzlzWmtkMFNVdHlabUpFY3pBMVdqUjVRMnhvUlhWaVVFMVRXRkJCSzJ0T1ZsRnNaVVpOWlVFMVNscFVVbVpIZDJoSlRXVlZNMUF4TVVRMlUySTRjMFZTVW5wWmJrUlVLM0phYlZwa09HeDZVVkJ0VG5aNVVHZEtVbVp4VDJRMVdUSnhVMFpzYTJoT09ITTBPVlZJUkVzemFWWkZaM1pFTW05TWJHWlViQ3N4WW1WR2JVSkdNMFJNWTNRelN6bG5RV05oVkVacGMwMWlRM0ZrWjFad1ZXWlVjSEk0ZWpjNGVIZHRjSEpXWWpsSGFteHpNR2RXVmtjNGJYQTRaa1JuVEhkNE1EVTVOV2RQVUhOT2RWWXdRVTlaWWpVdlJESmhjVFZwV0ROcU0zUTBkRTFKVW5oYVEybHRUREZzVDFjNEsyeFNWeXN2ZERsU1VtRlFTV0ZpVFRCc2JXaDFMM2hKVmxRNVJHWlBkbGs1TDNFeGFXZFNOMWw2V0RCTldXOXRaME5qYm5SMVIxRkJRbEJVYkZkV2FXRjRTa1U1ZVdWWFpsaDNhMXBEVXpWaFNuZ3paRFk1T1VVM1ZVSldVR1p0WWpaaWNqbEVTM3BJVEdWTFF5OWtSak4zVVZkdmIwOTJaVGhrVFhVMGFXWlNiblJyVDBSUGRrZEVOaXRRZVc1M1praG1SamtyTUVsU09XWlNaa2R3UTA5QlNsaEdUa01yUjJkd1JFNHljSEZxTUVKbU4zUk9USGQzYkUwMlYyTnhSSFIwY2xkSlFWTkxVbVI2WlVNeGNtSjJObkZUYVc5Vk9ETkVhbEpEVFhNM2RGUlhka1JhZW5rMUwwRTVkazFtU0hkbFF6UnphbkJDZUROUmNsaHhjRkF4V1hOck9URkRWeXRhT0hnckwxWktZWFkwY2xwb2JYcE9RVzB5ZUhkVmNHMVBTa2Q0VmxCYVlpdGtSMFZKZFU1UFMydERia2s1WmxsdlRXVlVjV0pqWWtkUlZuaFdhbGx6SzFOYVJYQnJUMWR0YlU5c1VGcHpPR2xOWTNvM01ERkZiR1ZZWVhOVGNrZzBWRXhzYkdoTU5VcFpaRmhKTjJzM1kzbHdXV1ZzTDJoT1JqSlBMM2tyU25jNGRrRnZVa0ZMV2paWldVbGhaemc1WnpOVGIxQmhlWGd5TDFKeVdITTJTRXRETVVGRmEyNWpVMmRDYkdSVk1WTlFkWFo1S3k5MVVWY3JaazlXV1RsU1RWWk9PVFZXWkhwelNWcEJhRnBTYTFsSWNqaHdhRVZHYzNnMll6VjJVa2xaVUV4dGNsZEtkMlUxUlZCc2VtaElaR1ptZFd0Q01HbERXWFp4ZEVoU1ZVSnBlWFJQY25jOVBRLldXOUhRUDUwWDl0OGN0NmVPcXBtbVNrbFpjdUVwWFhSby1CbENfdEFFZFhSZDJBdlE2Q3hZaUEtQnBtRDN0WnpnYlVQbWFGcXZnU1V2OWR3RWJ0bFhB";

        $post_data = "_eventId=submit&username=".$this->_username."&password=".$this->_password."&execution=".$token;
        $passport_curl = curl_init();
        curl_setopt($passport_curl, CURLOPT_URL, $url);
        curl_setopt($passport_curl, CURLOPT_RETURNTRANSFER, 1);
        // Post
        curl_setopt($passport_curl, CURLOPT_POST, 1);
        curl_setopt($passport_curl, CURLOPT_POSTFIELDS, $post_data);
        $passport_result = curl_exec($passport_curl);
        // Get code
        $passport_code = curl_getinfo($passport_curl, CURLINFO_HTTP_CODE); 
        //echo $passport_code;
        curl_close($passport_curl);
        $this->_table = "Account";
        if ($passport_code!=401){
            // Activate successfully, save user info into database, and login in
            if (APP_DEBUG === true)
                echo $url."+ args:".$post_data. " OK<br/>";
            // Generate uuid
            $uuid = uniqid("Temp-");

            $datas['id'] = "NULL";
            $datas['username'] = $this->_username;
            $datas['password'] = $this->_password;
            $datas['uuid'] = $uuid;
            $datas['solde'] = '50';
            $datas['level'] = '0';
            $datas['birthday'] = '0';
            
            setcookie("print-uuid", $uuid, 0, View::$dirConfig['root']);

            $result = $this->add($datas);

            $logger->logWithOperation("Activated", "username=".$this->_username." birthday=".$this->_birthday);
            $logger->logWithOperation("Login", "username=".$this->_username." birthday=".$this->_birthday);

            return 0;
        } else {
            $logger->logWithOperation("Activate Fail", "username=".$this->_username." birthday=".$this->_birthday);
            if (APP_DEBUG === true)
                echo $url." + args:".$post_data. " L'authentification a échoué!<br/>";
            // L'authentification a échoué!
            return 8;
        }
    }

        /**
     * @return int code of login
     */
    public function doalogin()
    {
        if ($this->hasUser()){
            $logger = new LogModel();
            $logger->logWithOperation("Login", "username=".$this->_username);
            if ($this->validPassword()){
                $uuid = uniqid($this->_uid."-");
                $data["uuid"] = $uuid;
                $this->update($this->_uid, $data);
                $logger->logWithOperation("Logined", "username=".$this->_username);
                setcookie("print-uuid", $uuid, 0, "/");
                return 0;
            }
            $logger->logWithOperation("Login Failed", "username=".$this->_username." password=".$this->_password);
            return 16;
        } else {
            // No such user ?
            return $this->anotherActivate();
        }
    }

    /**
     * @return int code of login
     */
    public function dologin()
    {
        if ($this->hasUser()){
            $logger = new LogModel();
            $logger->logWithOperation("Login", "username=".$this->_username." birthday=".$this->_birthday);
            if ($this->validPassword()){
                $uuid = uniqid($this->_uid."-");
                $data["uuid"] = $uuid;
                $this->update($this->_uid, $data);
                $logger->logWithOperation("Logined", "username=".$this->_username." birthday=".$this->_birthday);
                setcookie("print-uuid", $uuid, 0, View::$dirConfig['root']);
                return 0;
            }
            $logger->logWithOperation("Login Failed", "username=".$this->_username." password=".$this->_password." birthday=".$this->_birthday);
            return 16;
        } else {
            // No such user ?
            return $this->activate();
        }
    }
}