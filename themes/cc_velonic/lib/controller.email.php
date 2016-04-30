<?php
	require_once('Mandrill.php'); //Not required with Composer

	function send_email($email, $subject, $contents) {
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
		        'from_email' => 'updates@crewconnectonline.com',
		        'from_name' => 'CrewConnect',
		        'to' => array(
		            array(
		                'email' => $email,
		                'name' => null,
		                'type' => 'to'
		            )
		        ),
		        'headers' => array('Reply-To' => 'updates@crewconnectonline.com'),
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
		    //print_r($result);
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

	function subscribe_member() {
		try {
            $this->mc = new Mailchimp('c4784f1c6b1d3130c3a6d4bbbd264723-us1'); //your api key here
        } catch (Mailchimp_Error $e) {
            $this->Session->setFlash('You have not set an API key. Set it in Controller/AppController.php', 'flash_error');
        }

        $email = $this->request->data['email'];
        
        try {
            $this->mc->lists->subscribe($id, array('email'=>$email));
            $this->Session->setFlash('User subscribed successfully!', 'flash_success');
        } catch (Mailchimp_Error $e) {
            if ($e->getMessage()) {
                $this->Session->setFlash($e->getMessage(), 'flash_error');
            } else {
                $this->Session->setFlash('An unknown error occurred', 'flash_error');
            }
        }
	}
?>