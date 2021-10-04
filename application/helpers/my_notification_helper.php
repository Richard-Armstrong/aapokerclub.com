<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('notify_account')) {
	function notify_account($alert, $user, $subject, $message, $secondary = NULL) {
		$instance =& get_instance();
		$email_sent = TRUE;

		if (!$user->notify_email && !$user->notify_sms) // Nothing will be sent, notification failed already
			return FALSE;

		if ($user->notify_email) {
			$instance->load->library('email');

			$config['protocol'] = 'SMTP';
			$config['smtp_host'] = SMTP_HOST;
			$config['smtp_user'] = SMTP_USER;
			$config['smtp_pass'] = SMTP_PASS;
			$config['smtp_crypto'] = 'tls';
			$config['smtp_port'] = SMTP_PORT;
			$instance->email->initialize($config);
			$instance->email->set_newline("\r\n");

			$instance->email->from(NOREPLY_EMAIL, EMAIL_AUTHOR);
			$instance->email->to($user->email);
			$instance->email->subject($subject);
			$instance->email->message($message);

			$email_sent = $instance->email->send();
		}

		if ($user->notify_sms) {
			$instance->load->library('twilio');

			$from = '+' . TWILIO_NUMBER;
			$to = '+1' . $user->phone; // sms recipient number
			// Attempt to send the SMS and return the error if one occurs
			$response = $instance->twilio->sms($from, $to, $message);
			if (isset($response->IsError))
				return $response->ErrorMessage;
		}
		// Print email errors if they are present
		if (!$email_sent)
			return $instance->email->print_debugger();
		// Return TRUE if no errors occurred
		return TRUE;
	}
}
