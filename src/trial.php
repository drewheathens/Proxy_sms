Last account activity: 38 minutes ago
Details

<?php
/*
  ==============================
  Send messages automatic
  ==============================
 */


$emgUrl = "http://KENBOISSE1:1010/bin/send?ROUTE=smpp-RW-MTN-SMS-TRX";
if (isset($_GET['SOURCEADDR']) and isset($_GET['DESTADDR']) and isset($_GET['MESSAGE'])) {
    $SOURCEADDR = rawurlencode($_GET['SOURCEADDR']);
    $DESTADDR = rawurlencode($_GET['DESTADDR']);
    $MESSAGE = rawurlencode($_GET['MESSAGE']);
    $MESSAGEID = 0;
    $smsuser = "smsuser";
    $smspassword = "smspass";

    if (isset($_GET['MESSAGEID'])) {
        $MESSAGEID = rawurlencode($_GET['MESSAGEID']);
    }

    if (stristr($MESSAGE, '%2520')) // remove double encoding
        $MESSAGE = rawurldecode($MESSAGE);

    if (isset($_GET['DLR']))
        $DLR = $_GET['DLR'];
    else
        $DLR = 1;

    if (isset($_GET['UDHI']))
        $UDHI = $_GET['UDHI'];
    else
        $UDHI = 0;

    if (isset($_GET['CHARCODE']))
        $CHARCODE = $_GET['CHARCODE'];
    else
        $CHARCODE = 0;

    if (isset($_GET['SERVICETYPE']))
        $SERVICETYPE = $_GET['SERVICETYPE'];
    else
        //		$SERVICETYPE = 0;
        $SERVICETYPE = $SOURCEADDR;
    $hex = '';
    if (isset($_GET['HEX']))
        $hex = "&HEX=" . $_GET['HEX'];

    $ports = '';

    if (isset($_GET['SOURCEPORT']) and isset($_GET['DESTPORT']))
        $ports = "&SOURCEPORT=" . $_GET['SOURCEPORT'] . "&DESTPORT=" . $_GET['DESTPORT'];
    ### evans
    $w = urldecode($MESSAGE); // remove special Characters  

    echo strlen($w);
    echo "\n";
    if (strlen($w) > 160 && strlen($w) < 640) {
        $start = 0;
        $count = 0;
        $end = 157;        
        for ($i = 0; $i < strlen($w); $i += $end) {            

            $TruncMESSAGE = substr($w, $start, strpos(wordwrap($w, $end), "\n"));
            $count = strlen($TruncMESSAGE);
            echo $TruncMESSAGE;
            echo "\n";
            echo "count is -> ". $count;
            echo "\n";
            $mes  = array($TruncMESSAGE); // array with cut messages
            foreach ($mes as $key) {
                $encoded = urlencode($key);
                $smsUrl = $emgUrl . "&SOURCEADDR=" . $SOURCEADDR . "&DESTADDR=" . $DESTADDR . "&MESSAGE=" . $encoded . "&DLR=" . $DLR . "&USERNAME=" . $smsuser . "&PASSWORD=" . $smspassword;
                $smsResults = join('', file($smsUrl));
                // echo $smsUrl;
                echo "\n";
                $start += $count;                          

                echo "start is -> " . $start;
                echo "\n";        
            }
        }
    } elseif (strlen($w) > 640) {
        echo "0\n0\nNULL";
    } else {

        $smsUrl = $emgUrl . "&SOURCEADDR=" . $SOURCEADDR . "&DESTADDR=" . $DESTADDR . "&MESSAGE=" . $MESSAGE . "&DLR=" . $DLR . "&USERNAME=" . $smsuser . "&PASSWORD=" . $smspassword;
    }
    ##evans##



    $smsResults = join('', file($smsUrl));

    echo trim("$smsResults");
} else {
    echo "0\n0\nNULL";
}
?>
