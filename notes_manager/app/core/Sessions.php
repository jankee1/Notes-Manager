<?php
class Sessions {
    
    private $pascodeLength = 40;
    
    public function assing_session_credentials($login, $id) {
        $_SESSION['username'] = $login;
        $_SESSION['userid'] = $id;
        $_SESSION['passcode'] = $this->generatePasscode();
    }
    
    public function stop_session() {
        session_destroy();
    }
    
    private function generatePasscode() {
        
        $passcode = "";
        $alphaNumericCharacters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $max = strlen($alphaNumericCharacters);
        
        for ($i=0; $i < $this->pascodeLength ; $i++) {
            $passcode .= $alphaNumericCharacters[random_int(0, $max-1)];
        }
        
        return $passcode;
    }
}
