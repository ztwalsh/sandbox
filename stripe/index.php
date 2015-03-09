<?php
	include('init.php');

	if($_POST) {
		$stripe = array(
			"secret_key"      => "EX6LbZthD3lDeeh7owZJyavXByV3HDBx",
			"publishable_key" => "pk_IVu3pjFeVzsbTjvruVqQ0mEkBtNS5"
		);

		\Stripe\Stripe::setApiKey("EX6LbZthD3lDeeh7owZJyavXByV3HDBx");

		// Get the credit card details submitted by the form
		$token = $_POST['stripeToken'];

		// Create the charge on Stripe's servers - this will charge the user's card
		try {
		$charge = \Stripe\Charge::create(array(
		  "amount" => 1000, // amount in cents, again
		  "currency" => "usd",
		  "source" => $token,
		  "description" => "payinguser@example.com")
		);
		} catch(\Stripe\Error\Card $e) {
		  // The card has been declined
		}
	}
?>
 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title>Stripe Getting Started Form</title>
 
  <!-- The required Stripe lib -->
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
 
  <!-- jQuery is used only for this example; it isn't required to use Stripe -->
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 
  <script type="text/javascript">
    // This identifies your website in the createToken call below
    Stripe.setPublishableKey('pk_IVu3pjFeVzsbTjvruVqQ0mEkBtNS5');

    var stripeResponseHandler = function(status, response) {
      var $form = $('#payment-form');

      if (response.error) {
        // Show the errors on the form
        $form.find('.payment-errors').text(response.error.message);
        $form.find('button').prop('disabled', false);
      } else {
        // token contains id, last4, and card type
        var token = response.id;
        // Insert the token into the form so it gets submitted to the server
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));
        // and re-submit
        //alert('success');
        $form.get(0).submit();
      }
    };

    jQuery(function($) {
      $('#payment-form').submit(function(e) {
        var $form = $(this);

        // Disable the submit button to prevent repeated clicks
        $form.find('button').prop('disabled', true);

        Stripe.card.createToken($form, stripeResponseHandler);

        // Prevent the form from submitting with the default action
        return false;
      });
    });
  </script>
</head>
<body>
  <h1>Charge $10 with Stripe</h1>
 
  <form action="index.php" method="POST" id="payment-form">
    <span class="payment-errors"></span>
 
    <div class="form-row">
      <label>
        <span>Card Number</span>
        <input type="text" size="20" data-stripe="number"/>
      </label>
    </div>
 
    <div class="form-row">
      <label>
        <span>CVC</span>
        <input type="text" size="4" data-stripe="cvc"/>
      </label>
    </div>
 
    <div class="form-row">
      <label>
        <span>Expiration (MM/YYYY)</span>
        <input type="text" size="2" data-stripe="exp-month"/>
      </label>
      <span> / </span>
      <input type="text" size="4" data-stripe="exp-year"/>
    </div>
 
    <button type="submit">Submit Payment</button>
  </form>
</body>
</html>