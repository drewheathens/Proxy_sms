


Skip to content
Using Cellulant Mail with screen readers

10 of 104
USSD Menu
Inbox
x

Barnabas Katakwa <barnabas.katakwa@cellulant.com>
Attachments
Sep 25, 2019, 12:22 PM (2 days ago)
to Eugene, Vic, me

Emulator URL
http://197.159.100.247:9000/ussd-emulator/index.php 


.28 Database
mysql -u hubUI_ke -p -h KE-Hub4-DB -A hub_ke 


Sample USSD and dev guide
2 Attachments

<?php

include 'DynamicMenuController.php';

class CalculatorMenu extends DynamicMenuController {

    function startPage() {
        $this->displayText = "Welcome to calculator service.Please input \n *  for product \n + for sum \n - for difference \n / for division \n";
        $this->sessionState = "CONTINUE";
        $this->nextFunction = "processOperators";
        $this->serviceDescription = "Calculator";
    }

    function processOperators($input) {
        $tempdisplaytext = "";
        $this->serviceDescription = "Calculator";
        //if blank input was given
        if ($input == NULL) {
            $this->displayText = "Wrong Input.Please input \n *  for product \n + for sum \n - for difference \n / for division \n";
            $this->sessionState = "CONTINUE";
            $this->nextFunction = "processOperators";
            return;
        }

        switch ($input) {
            case "+":
                $tempdisplaytext.=' add';
                $this->nextFunction = "sum";
                break;
            case "-":
                $tempdisplaytext.=' subtract';
                $this->nextFunction = "difference";
                break;
            case "/":
                $tempdisplaytext.=' divide';
                $this->nextFunction = "division";
                break;
            case "*":
                $tempdisplaytext.=' multiply';
                $this->nextFunction = "product";
                break;
            default:
                $this->displayText = "Wrong Input.Please input \n *  for product \n + for sum \n - for difference \n / for division \n";
                $this->sessionState = "CONTINUE";
                $this->nextFunction = "processOperators";
                return;
                break;
        }
        $this->displayText = "Please input the number of operands you wish to" . $tempdisplaytext;
        $this->sessionState = "CONTINUE";
    }

    function sum($input) {
        if ($this->previousPage == "sumprocess") {
            //get total number of operands from session
            $maxoperands = $this->getSessionVar('maxOperands');
            $currentoperand = $this->getSessionVar('currentOperand');

            $sumtemp = $this->getSessionVar('totalsum');
            $newsum = $sumtemp + $input;
            //we've reached total number of operands
            if ($maxoperands == $currentoperand) {
                $this->displayText = "Your total sum of $maxoperands operands is $newsum . Bye";
                $this->sessionState = "END";
                return;
            }
            $currentoperand++;

            $this->saveSessionVar('currentOperand', $currentoperand); //save where we are at the moment
            $this->saveSessionVar('totalsum', $newsum);
            $this->displayText = "Please input operand $currentoperand to sum";
            $this->previousPage = "sumprocess";
            $this->nextFunction = "sum";
            $this->sessionState = "CONTINUE";
        } else {
            //we know this is the first time so init current operand to 1
            //save total number of operands expected to session
            $this->saveSessionVar('maxOperands', $input);
            $this->saveSessionVar('currentOperand', 1);

            $this->sessionState = "CONTINUE";
			            $this->previousPage = "sumprocess";
            $this->nextFunction = "sum";
            $this->displayText = "Please input operand 1 to sum";
        }
    }

    function product($input) {
        if ($this->previousPage == "productprocess") {
            //get total number of operands from session
            $maxoperands = $this->getSessionVar('maxOperands');
            $currentoperand = $this->getSessionVar('currentOperand');

            $producttemp = $this->getSessionVar('totalproduct');
            if ($producttemp == "") {
                $producttemp = 1;
            }
            $newproduct = $producttemp * $input;
            //we've reached total number of operands
            if ($maxoperands == $currentoperand) {
                $this->displayText = "Your total product of $maxoperands operands is $newproduct . Bye";
                $this->sessionState = "END";
                return;
            }
            $currentoperand++;

            $this->saveSessionVar('currentOperand', $currentoperand); //save where we are at the moment
            $this->saveSessionVar('totalproduct', $newproduct);
            $this->displayText = "Please input operand $currentoperand to multiply";
            $this->sessionState = "CONTINUE";

            $this->previousPage = "productprocess";
            $this->nextFunction = "product";
        } else {
            //we know this is the first time so init current operand to 1
            //save total number of operands expected to session
            $this->saveSessionVar('maxOperands', $input);
            $this->saveSessionVar('currentOperand', 1);

            $this->sessionState = "CONTINUE";

            $this->previousPage = "productprocess";
            $this->nextFunction = "product";
            $this->displayText = "Please input operand 1 to multiply";
        }
    }

    function division($input) {
        if ($this->previousPage == "divisionprocess") {
            //get total number of operands from session
            $maxoperands = $this->getSessionVar('maxOperands');
            $currentoperand = $this->getSessionVar('currentOperand');


            $divisiontemp = $this->getSessionVar('totaldivision');

            if ($divisiontemp == "") {
                $divisiontemp = 1;
            }
            $newdivision = $divisiontemp / $input;

            //we've reached total number of operands
            if ($maxoperands == $currentoperand) {
                $this->displayText = "Total division of $maxoperands operands is $newdivision . Bye";
                $this->sessionState = "END";
                return;
            }
            $currentoperand++;

            $this->saveSessionVar('currentOperand', $currentoperand); //save where we are at the moment
            $this->saveSessionVar('totaldivision', $newdivision);
            $this->displayText = "Please input operand $currentoperand to divide";
            $this->previousPage = "divisionprocess";
            $this->nextFunction = "division";
            $this->sessionState = "CONTINUE";
        } else {
            //we know this is the first time so init current operand to 1
            //save total number of operands expected to session
            $this->saveSessionVar('maxOperands', $input);
            $this->saveSessionVar('currentOperand', 1);


            $this->previousPage = "divisionprocess";
            $this->nextFunction = "division";
            $this->displayText = "Please input operand 1 to divide";
            $this->sessionState = "CONTINUE";
        }
    }

    function difference($input) {
        if ($this->previousPage == "diffprocess") {
            //get total number of operands from session
            $maxoperands = $this->getSessionVar('maxOperands');
            $currentoperand = $this->getSessionVar('currentOperand');


				
				
				            $maxoperands = $this->getSessionVar('maxOperands');
            $currentoperand = $this->getSessionVar('currentOperand');


            $difftemp = $this->getSessionVar('totaldiff');
            $newdiff = $difftemp - $input;
            //we've reached total number of operands
            if ($maxoperands == $currentoperand) {
                $this->displayText = "Your total difference of $maxoperands operands is $newdiff . Bye";
                $this->sessionState = "END";
                return;
            }
            $currentoperand++;

            $this->saveSessionVar('currentOperand', $currentoperand); //save where we are at the moment
            $this->saveSessionVar('totaldiff', $newdiff);
            $this->displayText = "Please input operand $currentoperand to subtract";
            $this->previousPage = "diffprocess";
            $this->nextFunction = "difference";
            $this->sessionState = "CONTINUE";
        } else {
            //we know this is the first time so init current operand to 1
            //save total number of operands expected to session
            $this->saveSessionVar('maxOperands', $input);
            $this->saveSessionVar('currentOperand', 1);
            $this->previousPage = "diffprocess";
            $this->nextFunction = "difference";
            $this->displayText = "Please input operand 1 to subtract";
            $this->sessionState = "CONTINUE";
        }
    }

}

$calc = new CalculatorMenu;
echo $calc->navigate();
?>
how to build ussd menu cellulant.php
Displaying how to build ussd menu cellulant.php.