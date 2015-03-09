<?php
	require_once 'Mandrill.php'; //Not required with Composer

	function send_email($email, $name, $subject, $contents) {
		try {
		    $mandrill = new Mandrill('8pSaWkxsVLTZNsDszNsGsA');
		    $template_name = 'crewconnect-transactional-template';
		    $template_content = array(
		        array(
		            'name' => 'content',
		            'content' => $contents
		        )
		    );
		    $message = array(
		        'html' => null,
		        'text' => null,
		        'subject' => $subject,
		        'from_email' => 'zach.walsh@powerreviews.com',
		        'from_name' => 'CrewConnect',
		        'to' => array(
		            array(
		                'email' => $email,
		                'name' => $name,
		                'type' => 'to'
		            )
		        ),
		        'headers' => array('Reply-To' => 'zach@crewconnectonline.com'),
		        'important' => false,
		        'track_opens' => null,
		        'track_clicks' => null,
		        'auto_text' => null,
		        'auto_html' => null,
		        'inline_css' => null,
		        'url_strip_qs' => null,
		        'preserve_recipients' => null,
		        'view_content_link' => null,
		        'bcc_address' => null,
		        'tracking_domain' => null,
		        'signing_domain' => null,
		        'return_path_domain' => null,
		        'merge' => true,
		        'merge_language' => 'mailchimp',
		        'global_merge_vars' => array(
		            array(
		                'name' => 'merge1',
		                'content' => 'merge1 content'
		            )
		        )
		    );
		    $async = false;
		    $ip_pool = 'Main Pool';
		    $send_at = false;
		    $result = $mandrill->messages->sendTemplate($template_name, $template_content, $message, $async, $ip_pool, $send_at);
		    print_r($result);
		    /*
		    Array
		    (
		        [0] => Array
		            (
		                [email] => recipient.email@example.com
		                [status] => sent
		                [reject_reason] => hard-bounce
		                [_id] => abc123abc123abc123abc123abc123
		            )
		    
		    )
		    */
		} catch(Mandrill_Error $e) {
		    // Mandrill errors are thrown as exceptions
		    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
		    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
		    throw $e;
		}
	}

	if($_POST) {
		$email 		= 	'ztwalsh@gmail.com';
		$name 		= 	'Zach';
		$subject 	= 	'Holy schnikies bro!';
		$contents 	= 	'<h1 style="color: #343e48;font-weight: normal;line-height: 110%;">You have been invited to this event</h1>';
		$contents 	.= 	'<p>kjsfdbskd cbsdkc jbd ckjsbdc akjbca kjcba kjsbd ckjbds kjsfdbskd cbsdkc jbd ckjsbdc akjbca kjcba kjsbd ckjbds kjsfdbskd cbsdkc jbd ckjsbdc akjbca kjcba kjsbd ckjbds kjsfdbskd cbsdkc jbd ckjsbdc akjbca kjcba kjsbd ckjbds kjsfdbskd cbsdkc jbd ckjsbdc akjbca kjcba kjsbd ckjbds kjsfdbskd cbsdkc jbd ckjsbdc akjbca kjcba kjsbd ckjbds kjsfdbskd cbsdkc jbd ckjsbdc akjbca kjcba kjsbd ckjbds </p>';
		$contents 	.= 	'<p><a href="" style="background: #ce5637;border-bottom: 2px solid #822912;border-radius: 3px;color: #ffffff;display: inline-block;font-size: 16px;padding: 10px 20px 8px 20px;text-decoration: none;">Yes I am Going</a>';

		send_email($email, $name, $subject, $contents);
	}
?>

<form action="index.php" method="post">
	<input type="submit" name="submit" value="Send Email" />
</form>