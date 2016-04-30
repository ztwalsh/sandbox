<?php
	require_once('Braintree/Braintree.php');
	
	if ($_SERVER['HTTP_HOST'] == 'localhost:8000') {
		Braintree_Configuration::environment('sandbox');
		Braintree_Configuration::merchantId('2ggxt598gppy9kv2');
		Braintree_Configuration::publicKey('4c66774b5zsdbzn6');
		Braintree_Configuration::privateKey('393531ddf7b78ae77f3d10e2c64eff02');
	} elseif ($_SERVER['HTTP_HOST'] == 'staging.crewconnectonline.com') {
		Braintree_Configuration::environment('sandbox');
		Braintree_Configuration::merchantId('2ggxt598gppy9kv2');
		Braintree_Configuration::publicKey('4c66774b5zsdbzn6');
		Braintree_Configuration::privateKey('393531ddf7b78ae77f3d10e2c64eff02');
		/*Braintree_Configuration::environment('production');
		Braintree_Configuration::merchantId('7n6mk4ymf3dmfqtm');
		Braintree_Configuration::publicKey('mtw7rgsp8m6c2r4k');
		Braintree_Configuration::privateKey('f0bbce06ddf9f2bc642c520b5ce960d7');*/
	} elseif ($_SERVER['HTTP_HOST'] == 'www.crewconnectonline.com') {
		Braintree_Configuration::environment('production');
		Braintree_Configuration::merchantId('7n6mk4ymf3dmfqtm');
		Braintree_Configuration::publicKey('mtw7rgsp8m6c2r4k');
		Braintree_Configuration::privateKey('f0bbce06ddf9f2bc642c520b5ce960d7');
	}

	function generate_client_token() {
		return Braintree_ClientToken::generate();
	}

	function subscription_plan_options() {
		$boat = display_boat_detail($_SESSION['boat_id']);

		echo '<input id="monthly" name="plan" type="radio" value="standard_monthly_sub" />';
		echo '<label for="monthly">';
			echo 'Monthly Recurring <span>$15/month</span>';
		echo '</label>';

		echo '<input id="annual" name="plan" type="radio" value="standard_annual_sub" />';
		echo '<label for="annual">';
			echo 'Annual Recurring <span>$100/year</span>';
		echo '</label>';

		echo '<input id="three-month" name="plan" type="radio" value="standard_3_month_sub" />';
		echo '<label for="three-month">';
			echo '3-Month Access<span>One-time $35 fee</span>';
		echo '</label>';
	}

	function add_subscription($firstname, $lastname, $boat_id) {
		global $root;

		if ($_POST) {
			$required_fields = array('plan');
			$errors = required_fields($required_fields, $_POST);
		    if(empty($errors)) {

				$nonce = $_POST['payment_method_nonce'];
				$boat = display_boat_detail($boat_id);

				$customer = Braintree_Customer::create(array(
				    'firstName' => $boat['name'],
				    'lastName' => '',
				    'paymentMethodNonce' => $nonce
				));

				if ($customer->success) {
    				try {
						$new_customer = Braintree_Customer::find($customer->customer->id);
					    $payment_method_token = $new_customer->creditCards[0]->token;

					    if (empty($_POST['discount'])) {
					    	$subscription = Braintree_Subscription::create(array(
						        'paymentMethodToken' => $payment_method_token,
						        'planId' => $_POST['plan']
						    ));
					    } else {
					    	$discounts = Braintree_Discount::all();
							$available_discounts = array();

							foreach($discounts as $discount) {
								$available_discounts[] = $discount->id;
							}

							if (in_array($_POST['discount'], $available_discounts)) {
								$subscription = Braintree_Subscription::create(array(
							        'paymentMethodToken' => $payment_method_token,
							        'planId' => $_POST['plan'],
							        'discounts' => array(
							        	'add' => array(array(
							        		'inheritedFromId' => $_POST['discount']
							        	))
							        )
							    ));
							} else {
								return 'error_invalid_code';
							}
					    }

					    if ($subscription->success) {
					    	update_billing($customer->customer->id, $subscription->subscription->id, $boat_id);
					    	$_SESSION['credit_card_success'] = true;
					    	admin_new_payment_email($boat['name']);
					        header('Location: '.$root.'dashboard/add-credit-card-confirmation.php');
					    } else {
					        foreach (($subscription->errors->deepAll()) as $error) {
					            echo("- " . $error->message);
					        }
					    }
					} catch (Braintree_Exception_NotFound $e) {
					    return("Failure: no customer found with ID " . $customer->customer->id);
					}
				} else {
					$exceptions = array();
    				foreach($customer->errors->deepAll() as $error) {
        				$exceptions[] = $error->message;
    				}

    				return $exceptions;
				}
			} else {
				return 'error_missing_fields';
			}
		}
	}

	function get_subscription($billing_key) {
		$subscription = Braintree_Subscription::find($billing_key);

		return $subscription;
	}

	function get_discounts($discounts) {
		if(empty($discounts)) {
			echo '';
		} else {
			foreach ($discounts as $discount) {
				echo 'Promo code: '.$discount->id;
			}
		}
	}

	function get_card($id) {
		$customer = Braintree_Customer::find($id);
		$card_token = $customer->creditCards[0]->token;

		$card = Braintree_CreditCard::find($card_token);
		echo $card->cardType.': '.$card->maskedNumber;
	}

	function update_subscription($boat_id) {
		if ($_POST) {
			$nonce = $_POST['payment_method_nonce'];
			$boat = display_boat_detail($boat_id);

			$customer = Braintree_Customer::update($boat['customer_id'], 
				array(
					'creditCard' => array(
			        	'paymentMethodNonce' => $nonce,
			        	'options' => array(
			            	'makeDefault' => true
			        	)
			        )
				)
			);

			if ($customer->success) {
				$updated_customer = Braintree_Customer::find($customer->customer->id);
			    $payment_method_token = $updated_customer->creditCards[0]->token;

			    $subscription = Braintree_Subscription::update($boat['billing_key'],
			    	array(
			        	'paymentMethodToken' => $payment_method_token
			    	)
			    );

			    if ($subscription->success) {
			    	return true;
			    } else {
			    	$exceptions = array();
	    			foreach($subscription->errors->deepAll() as $error) {
	        			$exceptions[] = $error->message;
	    			}

	    			return $exceptions;
			    }
			} else {
				$exceptions = array();
    			foreach($customer->errors->deepAll() as $error) {
        			$exceptions[] = $error->message;
    			}

    			return $exceptions;
			}
		}
	}

	function cancel_subscription($boat_id) {
		if ($_POST) {
			$required_fields = array('cancel');
			$errors = required_fields($required_fields, $_POST);

		    if(empty($errors)) {
				if ($_POST['cancel'] == 'cancel') {
					$boat = display_boat_detail($boat_id);

					$result = Braintree_Subscription::cancel($boat['billing_key']);

					if($result) {
						cancel_boat($boat_id);
						return true;
					} else {
						return 'error_cancel_failed';
					}
				} else {
					return 'error_not_cancelled';
				}
			} else {
				return 'error_missing_fields';
			}
		}
	}

	function boat_down_recover() {
		global $root;

		if($_SESSION['boat_count'] > 1) {
			echo '<p><a class="primary" href="'.$root.'dashboard/select-boat.php">Go to another boat</a></p>';
		}
		echo '<p><a class="primary" href="'.$root.'logout.php">Log out</a></p>';
	}

	function billing_status() {
		global $root;
		// Find the boat's creator skipper
		if (isset($_SESSION['boat_id'])) {
			$boat = display_boat_detail($_SESSION['boat_id']);

			if (isset($boat)) {
				if (empty($boat['billing_key'])) { // Check if the boat has a billing code
					if ($boat['created_date'] < strtotime(date('2015-05-24'))) {
						$trial_period = strtotime(date('2015-05-24')) + (86400 * 30);
					} else {
						$trial_period = $boat['created_date'] + (86400 * 30);
					}

					if (time() > $trial_period) {
						if($_SESSION['member_privilege'] == 99) {
							header('Location: '.$root.'dashboard/add-credit-card.php');
						} else {
							header('Location:  '.$root.'dashboard/account-unavailable.php');
						}
					} else {
						$days_difference = round(abs(time() - $trial_period)/60/60/24); 
						echo '<div class="free-trial-wrapper"><div class="free-trial">'.$boat['name'].' free trial: '.$days_difference.' days left. ';
						if ($_SESSION['member_privilege'] == 99) {
							echo '<a href="add-credit-card.php">Add a card <i class="fa fa-angle-right"></i></a>';
						}
						echo '</div></div>';
					}
				} elseif ($boat['billing_key'] == 1) { //check if it is a free account
					echo '';
				} else {
					$subscription = get_subscription($boat['billing_key']);

					if ($subscription->status != 'Active') {
						if($_SESSION['member_privilege'] == 99) {
							header('Location: '.$root.'dashboard/add-credit-card.php');
						} else {
							header('Location:  '.$root.'dashboard/account-unavailable.php');
						}
					}
				}
			}
		}
	}
?>