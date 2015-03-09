<?php
	require_once('lib/Braintree.php');
	Braintree_Configuration::environment('sandbox');
	Braintree_Configuration::merchantId('2ggxt598gppy9kv2');
	Braintree_Configuration::publicKey('4c66774b5zsdbzn6');
	Braintree_Configuration::privateKey('393531ddf7b78ae77f3d10e2c64eff02');

	$client_token = Braintree_ClientToken::generate();

	if($_POST) {
		$nonce = $_POST['payment_method_nonce'];
		$customer = Braintree_Customer::create(array(
		    'firstName' => 'Mike'.date('h:m:s'),
		    'lastName' => 'Jones2'.date('h:m:s'),
		    'paymentMethodNonce' => $nonce
		));

		try {
			$customer = Braintree_Customer::find($customer->customer->id);
		    $payment_method_token = $customer->creditCards[0]->token;

		    $subscription = Braintree_Subscription::create(array(
		        'paymentMethodToken' => $payment_method_token,
		        'planId' => 'v8db'
		    ));

		    if ($subscription->success) {
		        echo("Success! Subscription " . $subscription->subscription->id . " is " . $subscription->subscription->status);
		    } else {
		        echo("Validation errors:");
		        foreach (($subscription->errors->deepAll()) as $error) {
		            echo("- " . $error->message);
		        }
		    }
		} catch (Braintree_Exception_NotFound $e) {
		    echo("Failure: no customer found with ID " . $customer->customer->id);
		}
	}
?>
<html>
	<head>
		<title>Braintree</title>
	</head>
	<body>
		<h1>Braintree</h1>
		<form id="checkout" action="index.php" method="post">
			<input data-braintree-name="number" placeholder='xxxxxxxxxxxxxxxx' value="4111111111111111">
			<input data-braintree-name="cvv" placeholder="123" value="100">
			<input data-braintree-name="expiration_month" placeholder="10" value="10">
			<input data-braintree-name="expiration_year" placeholder="16" value="16">
			<input type="submit" id="submit" value="Pay">
		</form>
		<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
		<script>
			braintree.setup("<?php echo $client_token; ?>", "custom", {id: "checkout"});
		</script>
	</body>
</html>