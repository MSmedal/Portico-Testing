<?php
    include 'includes/globals.php';
    
    $today = date("F j, Y, g:i:s");
    echo <<<EOT
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="SecureSubmit PHP end-to-end payment example using tokenization.">
        <meta name="author" content="Mark Smedal">
        <title>Simple Payment Form Demo</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="styles/form.css">
    </head>
    <body>
        <div class="container">
            <h1>PHP SecureSubmit Example</h1>
            <p>$today</p>
            <form class="payment_form form-horizontal" id="payment_form" method="post" action="charge.php">
                <h2>Billing Information</h2>
                <div class="form-group">
                    <label for="FirstName" class="col-sm-2 control-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="FirstName" id="FirstName" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="LastName" class="col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="LastName" id="LastName" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="PhoneNumber" class="col-sm-2 control-label">Phone Number</label>
                    <div class="col-sm-10">
                        <input type="text" name="PhoneNumber" id="PhoneNumber" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="Email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" name="Email" id="Email" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="Address" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" name="Address" id="Address" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="City" class="col-sm-2 control-label">City</label>
                    <div class="col-sm-10">
                        <input type="text" name="City" id="City"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="State" class="col-sm-2 control-label">State</label>
                    <div class="col-sm-10">
                        <select name="State" id="State">
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="DC">District Of Columbia</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Zip" class="col-sm-2 control-label">Zip</label>
                    <div class="col-sm-10">
                        <input type="text" name="Zip" id="Zip" />
                    </div>
                </div>
                <h2>Payment Information</h2>
                <div class="form-group">
                    <label for="payment_amount" class="col-sm-2 control-label">Payment Amount</label>
                    <div class="col-sm-10">
                        <input type="text" name="payment_amount" id="payment_amount" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="invoice_number" class="col-sm-2 control-label">Invoice Number</label>
                    <div class="col-sm-10">
                        <input type="text" name="invoice_number" id="invoice_number" />
                    </div>
                </div>
                <h2>Card Information</h2>
                <div class="form-group">
                    <div class="form-wrapper">
                        <div id="ss-banner"></div>
                        <br />
                        <div id="credit-card"></div>
                    </div>
                </div>
                <br />
                <input type="hidden" id="token_value" name="token_value" />
                <input type="hidden" id="cardholder_name" name="cardholder_name" />
                <br />
            </form>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://api2.heartlandportico.com/SecureSubmit.v1/token/gp-1.6.0/globalpayments.js"></script>
        <script>
// Configure account
GlobalPayments.configure({
    publicApiKey: "$gHeartlandPublicKey"
});
        </script>
        <script src="assets/credit-card.js"></script>
    </body>
</html>
EOT;