<?php
/**
 * Handle Donation Form Submission
 */

function handle_donation_form_submission() {
    try {
        // Verify Nonce
        if (!isset($_POST['donation_form_nonce']) || !wp_verify_nonce($_POST['donation_form_nonce'], 'submit_donation_form')) {
            echo json_encode(array('success' => false, 'message' => __('Security check failed.', 'limadia-entity-foundation-v1')));
            die();
        }

        $name     = sanitize_text_field($_POST['donor_name']);
        $email    = sanitize_email($_POST['donor_email']);
        $purpose  = sanitize_text_field($_POST['item_name']);
        $currency = sanitize_text_field($_POST['currency_code']);
        $amount   = sanitize_text_field($_POST['amount']);
        $type     = sanitize_text_field($_POST['payment_type']);

        if (empty($name) || empty($email) || empty($amount)) {
            echo json_encode(array('success' => false, 'message' => __('Please fill all required fields.', 'limadia-entity-foundation-v1')));
            die();
        }

        // Create the Donation post
        $donation_id = wp_insert_post(array(
            'post_title'   => 'Donation Inquiry from ' . $name,
            'post_type'    => 'donation',
            'post_status'  => 'private',
        ));

        if (is_wp_error($donation_id)) {
            echo json_encode(array('success' => false, 'message' => __('Something went wrong. Please try again.', 'limadia-entity-foundation-v1')));
            die();
        }

        // Save meta data
        update_post_meta($donation_id, '_donation_name', $name);
        update_post_meta($donation_id, '_donation_email', $email);
        update_post_meta($donation_id, '_donation_purpose', $purpose);
        update_post_meta($donation_id, '_donation_amount', $amount);
        update_post_meta($donation_id, '_donation_currency', $currency);
        update_post_meta($donation_id, '_donation_payment_type', $type);

        // Send email to admin
        $to = 'info@limadiafoundation.org';
        $email_subject = 'New Donation Inquiry: ' . $purpose;
        $headers = array('Content-Type: text/html; charset=UTF-8', 'Reply-To: ' . $name . ' <' . $email . '>');
        
        // Override From Name
        add_filter('wp_mail_from_name', function() {
            return 'Limadia Entity Foundation Inquiries';
        });
        
        $body = "<h2>New Donation Inquiry Received</h2>";
        $body .= "<p><strong>Donor Name:</strong> $name</p>";
        $body .= "<p><strong>Email:</strong> $email</p>";
        $body .= "<p><strong>Purpose:</strong> $purpose</p>";
        $body .= "<p><strong>Amount:</strong> $amount $currency</p>";
        $body .= "<p><strong>Payment Type:</strong> " . ucfirst(str_replace('_', ' ', $type)) . "</p>";
        $body .= "<p><em>This inquiry has been saved in the WordPress dashboard under 'Donations'.</em></p>";

        wp_mail($to, $email_subject, $body, $headers);

        echo json_encode(array('success' => true, 'message' => __('Thank you! Your donation inquiry has been sent to our team. We will get back to you soon.', 'limadia-entity-foundation-v1')));
        die();

    } catch (Exception $e) {
        echo json_encode(array('success' => false, 'message' => 'System Error: ' . $e->getMessage()));
        die();
    }
}

add_action('wp_ajax_submit_donation_form', 'handle_donation_form_submission');
add_action('wp_ajax_nopriv_submit_donation_form', 'handle_donation_form_submission');
