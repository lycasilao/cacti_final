<?php
use \PhpPot\Service\StripePayment;

require_once "config.php";

if (!empty($_POST["token"])) {
    require_once 'StripePayment.php';
    $stripePayment = new StripePayment();
    
    $stripeResponse = $stripePayment->chargeAmountFromCard($_POST);
    
    require_once "DBController.php";
    $dbController = new DBController();
    
    $amount = $stripeResponse["amount"] /100;
    
    $param_type = 'ssdssss';
    $param_value_array = array(
        $_POST['email'],
        $_POST['item_number'],
        $amount,
        $stripeResponse["currency"],
        $stripeResponse["balance_transaction"],
        $stripeResponse["status"],
        json_encode($stripeResponse)
    );
    $query = "INSERT INTO tbl_payment (email, item_number, amount, currency_code, txn_id, payment_status, payment_response) values (?, ?, ?, ?, ?, ?, ?)";
    $id = $dbController->insert($query, $param_type, $param_value_array);
    
    if ($stripeResponse['amount_refunded'] == 0 && empty($stripeResponse['failure_code']) && $stripeResponse['paid'] == 1 && $stripeResponse['captured'] == 1 && $stripeResponse['status'] == 'succeeded') {
        $successMessage = "Stripe payment is completed successfully. The TXN ID is " . $stripeResponse["balance_transaction"];
        echo "Stripe payment is completed successfully.";
    }
}
?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css"/ >
</head>
<body>
    <?php if(!empty($successMessage)) { ?>
    <div id="success-message"><?php echo $successMessage; ?></div>
    <?php  } ?>
    <div id="error-message"></div>
                
            <form id="frmStripePayment" action=""
                method="post">
                <div class="field-row">
                    <H1>Pay Here</H1> 
                </div>
                <div class="field-row">
                    <label>Card Holder Name</label> <span
                        id="card-holder-name-info" class="info"></span><br>
                    <input type="text" id="name" name="name"
                        class="demoInputBox">
                </div>
                <div class="field-row">
                    <label>Email</label> <span id="email-info"
                        class="info"></span><br> <input type="text"
                        id="email" name="email" class="demoInputBox">
                </div>
                <div class="field-row">
                    <label>Card Number</label> <span
                        id="card-number-info" class="info"></span><br> <input
                        type="text" id="card-number" name="card-number"
                        class="demoInputBox">
                </div>
                <div class="field-row">
                    <div class="contact-row column-right">
                        <label>Expiry Month / Year</label> <span
                            id="userEmail-info" class="info"></span><br>
                        <select name="month" id="month"
                            class="demoSelectBox">
                            <option value="08">08</option>
                            <option value="09">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select> <select name="year" id="year"
                            class="demoSelectBox">
                            <option value="20">2020</option>
                            <option value="21">2021</option>
                            <option value="22">2022</option>
                            <option value="23">2023</option>
                            <option value="24">2024</option>
                            <option value="25">2025</option>
                            <option value="26">2026</option>
                            <option value="27">2027</option>
                            <option value="28">2028</option>
                            <option value="29">2029</option>
                            <option value="30">2030</option>
                        </select>
                    </div>
                    <div class="contact-row cvv-box">
                        <label>CVC</label> <span id="cvv-info"
                            class="info"></span><br> <input type="text"
                            name="cvc" id="cvc"
                            class="demoInputBox cvv-input">
                    </div>
                </div>
                <div>
                    <input type="submit" name="pay_now" value="Submit"
                        id="submit-btn" class="btnAction"
                        onClick="stripePay(event);">

                    <div id="loader">
                        <img alt="loader" src="LoaderIcon.gif">
                    </div>
                </div>
                <input type='hidden' name='amount' value='0.5'> <input
                    type='hidden' name='currency_code' value='USD'> <input
                    type='hidden' name='item_name' value='Test Product'>
                <input type='hidden' name='item_number'
                    value='PHPPOTEG#1'>
            </form>
    
    
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"> </script>
     <script src="http://code.jquery.com/jquery-1.11.1.min.js">  </script>
	 <script src="http://housingmilitary1st.com/js/jquery.bpopup.js"> 
   
    <script>
    function cardValidation () {
    var valid = true;
    var name = $('#name').val();
    var email = $('#email').val();
    var cardNumber = $('#card-number').val();
    var month = $('#month').val();
    var year = $('#year').val();
    var cvc = $('#cvc').val();

    $("#error-message").html("").hide();

    if (name.trim() == "") {
        valid = false;
    }
    if (email.trim() == "") {
    	   valid = false;
    }
    if (cardNumber.trim() == "") {
    	   valid = false;
    }

    if (month.trim() == "") {
    	    valid = false;
    }
    if (year.trim() == "") {
        valid = false;
    }
    if (cvc.trim() == "") {
        valid = false;
    }

    if(valid == false) {
        $("#error-message").html("All Fields are required").show();
        echo "All Fields are required";
    }

    return valid;
}
//set your publishable key
Stripe.setPublishableKey("<?php echo STRIPE_PUBLISHABLE_KEY; ?>");

//callback to handle the response from stripe
function stripeResponseHandler(status, response) {
    if (response.error) {
        //enable the submit button
        $("#submit-btn").show();
        $( "#loader" ).css("display", "none");
        //display the errors on the form
        $("#error-message").html(response.error.message).show();
    } else {
        //get token id
        var token = response['id'];
        //insert the token into the form
        $("#frmStripePayment").append("<input type='hidden' name='token' value='" + token + "' />");
        //submit form to the server
        $("#frmStripePayment").submit();
    }
}
function stripePay(e) {
    e.preventDefault();
    var valid = cardValidation();

    if(valid == true) {
        $("#submit-btn").hide();
        $( "#loader" ).css("display", "inline-block");
        Stripe.createToken({
            number: $('#card-number').val(),
            cvc: $('#cvc').val(),
            exp_month: $('#month').val(),
            exp_year: $('#year').val()
        }, stripeResponseHandler);

        //submit from callback
        return false;
    }
}
</script>
</body>
</html>