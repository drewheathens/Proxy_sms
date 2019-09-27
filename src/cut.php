<?php
// require 'class.phpmailer.php';
class stri
{
    private $truncated;
    private $end = '...';

    public function substrwords()
    { #returns a string truncated at the first space after specified characters.
        $longString = "In this talk, we will show how to leverage InfluxDB to implement some solutions to tackle on the issues of time series forecasting at scale, including continuous accuracy evaluation and algorithm hyperparameters optimization.";
        // echo strlen($longString);
        if (strlen($longString) > 160) {

            $this->truncated = substr($longString, 0, strpos(wordwrap($longString, 160), "\n"));

            $this->truncated .=  $this->end;
            echo $this->truncated;
            echo "\n";

            $nd = $this->truncated = substr($longString, strpos(wordwrap($longString, 160), "\n"));

            echo $this->end . $nd;

            #################
             # evans
    // $w = urldecode($MESSAGE);// remove special Characters
    // echo strlen($w);
    // $chars = 157;
    // while($w){
    //     if (strlen($w) > $chars) {

    //         // $chars += $chars;        
            
    //         $TruncMESSAGE = substr($w, 0, strpos($w, ' ', $chars)) . '...';// truncate from position 0-157
    //         // $TruncMES = '...' . substr($w, strpos($w, ' ', 157));// truncate from position 157-...
         
    //         $mes  = array($TruncMESSAGE); // array with cut messages
    //         foreach ($mes as $key) {
    //             $encoded = urlencode($key);
    //             $smsUrl = $emgUrl . "&SOURCEADDR=" . $SOURCEADDR . "&DESTADDR=" . $DESTADDR . "&MESSAGE=" . $encoded . "&DLR=" . $DLR . "&USERNAME=" . $smsuser . "&PASSWORD=" . $smspassword;
    //             $smsResults = join('', file($smsUrl)); 
    //             echo $smsUrl; 
    //             echo "\n";  
                          
    //         }
    
    //     } else {
    
    //         $smsUrl = $emgUrl . "&SOURCEADDR=" . $SOURCEADDR . "&DESTADDR=" . $DESTADDR . "&MESSAGE=" . $MESSAGE . "&DLR=" . $DLR . "&USERNAME=" . $smsuser . "&PASSWORD=" . $smspassword;
            
    //     }
        #evans#
        #################################3
        }

        return $this->truncated;
    }

    // public function sendText()
    // {
    //     $to = "+254706390023@vtext.com";
    //     $from = "mudavadie@gmail.com";
    //     $message = $this->truncated;
    //     $headers = "from : $from\n";
    //     mail("$to", ' ', "$message");

    // // Instantiate Class
    // $mail = new PHPMailer();

    // // Set up SMTP
    // $mail->IsSMTP();                // Sets up a SMTP connection
    // $mail->SMTPDebug  = 2;          // This will print debugging info
    // $mail->SMTPAuth = true;         // Connection with the SMTP does require authorization
    // $mail->SMTPSecure = "tls";      // Connect using a TLS connection
    // $mail->Host = "smtp.gmail.com";
    // $mail->Port = 587;
    // $mail->Encoding = '7bit';       // SMS uses 7-bit encoding

    // // Authentication
    // $mail->Username   = "email.address@gmail.com"; // Login
    // $mail->Password   = "password"; // Password

    // // Compose
    // $mail->Subject = "Testing";     // Subject (which isn't required)
    // $mail->Body = "Testing";        // Body of our message

    // // Send To
    // $mail->AddAddress("##########@vtext.com"); // Where to send it
    // var_dump($mail->send());      // Send!

    // }

}
$newClass = new stri();
$newClass->substrwords();
// $newClass->sendText();
