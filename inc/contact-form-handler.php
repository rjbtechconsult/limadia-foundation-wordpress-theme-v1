<?php
/**
 * Handle Contact Form Submission
 */

function handle_contact_form_submission() {
    try {
        // Verify Nonce (I'll add this to the form)
        if (!isset($_POST['contact_form_nonce']) || !wp_verify_nonce($_POST['contact_form_nonce'], 'submit_contact_form')) {
            echo json_encode(array('status' => 'false', 'message' => __('Security check failed.', 'limadia-entity-foundation-v1')));
            die();
        }

        // Verify reCAPTCHA
        $recaptcha_response = isset($_POST['g-recaptcha-response']) ? sanitize_text_field($_POST['g-recaptcha-response']) : '';
        if (empty($recaptcha_response)) {
            echo json_encode(array('status' => 'false', 'message' => __('Please complete the reCAPTCHA verification (check the box to prove you are human).', 'limadia-entity-foundation-v1')));
            die();
        }

        $recaptcha_secret = '6Lei5vEsAAAAAL87f1ERomJRwikJL9QMp3sGsxHo';
        $verify_response = wp_remote_post('https://www.google.com/recaptcha/api/siteverify', array(
            'body' => array(
                'secret'   => $recaptcha_secret,
                'response' => $recaptcha_response,
                'remoteip' => $_SERVER['REMOTE_ADDR']
            )
        ));

        if (is_wp_error($verify_response)) {
            echo json_encode(array('status' => 'false', 'message' => __('Could not connect to reCAPTCHA service. Please try again later.', 'limadia-entity-foundation-v1')));
            die();
        }

        $verify_data = json_decode(wp_remote_retrieve_body($verify_response));
        if (!$verify_data->success) {
            echo json_encode(array('status' => 'false', 'message' => __('reCAPTCHA verification failed. Please try again.', 'limadia-entity-foundation-v1')));
            die();
        }

        $name    = sanitize_text_field($_POST['form_name']);
        $email   = sanitize_email($_POST['form_email']);
        $subject = sanitize_text_field($_POST['form_subject']);
        $phone   = sanitize_text_field($_POST['form_phone']);
        $message = sanitize_textarea_field($_POST['form_message']);

        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            echo json_encode(array('status' => 'false', 'message' => __('Please fill all required fields.', 'limadia-entity-foundation-v1')));
            die();
        }

        // Create the Inquiry post
        $inquiry_id = wp_insert_post(array(
            'post_title'   => $subject . ' - ' . $name,
            'post_type'    => 'inquiry',
            'post_status'  => 'private',
        ));

        if (is_wp_error($inquiry_id)) {
            echo json_encode(array('status' => 'false', 'message' => __('Something went wrong. Please try again.', 'limadia-entity-foundation-v1')));
            die();
        }

        // Save meta data
        update_post_meta($inquiry_id, '_inquiry_name', $name);
        update_post_meta($inquiry_id, '_inquiry_email', $email);
        update_post_meta($inquiry_id, '_inquiry_phone', $phone);
        update_post_meta($inquiry_id, '_inquiry_subject', $subject);
        update_post_meta($inquiry_id, '_inquiry_message', $message);
        update_post_meta($inquiry_id, '_inquiry_read_status', '0'); // 0 = Unread

        // Send email to admin
        $to = 'info@limadiafoundation.org';
        $email_subject = 'New Website Inquiry: ' . $subject;
        $headers = array('Content-Type: text/html; charset=UTF-8', 'Reply-To: ' . $name . ' <' . $email . '>');
        
        // Override the default From Name for this specific email
        add_action('phpmailer_init', function($phpmailer) {
            $phpmailer->FromName = 'Limadia Entity Foundation Inquiries';
        }, 20);
        
        $body = "<h2>New Website Inquiry Received</h2>";
        $body .= "<p><strong>Name:</strong> $name</p>";
        $body .= "<p><strong>Email:</strong> $email</p>";
        $body .= "<p><strong>Phone:</strong> $phone</p>";
        $body .= "<p><strong>Subject:</strong> $subject</p>";
        $body .= "<p><strong>Message:</strong><br>" . nl2br($message) . "</p>";
        $body .= "<p><em>This message has been saved in the WordPress dashboard under 'Inquiries'.</em></p>";

        wp_mail($to, $email_subject, $body, $headers);

        echo json_encode(array('status' => 'true', 'message' => __('We have successfully received your message and will get back to you soon.', 'limadia-entity-foundation-v1')));
        die();

    } catch (Exception $e) {
        echo json_encode(array('status' => 'false', 'message' => 'System Error: ' . $e->getMessage()));
        die();
    }
}

add_action('wp_ajax_submit_contact_form', 'handle_contact_form_submission');
add_action('wp_ajax_nopriv_submit_contact_form', 'handle_contact_form_submission');
