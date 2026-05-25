<?php
/**
 * Handle Job Application Form Submission
 */

function handle_job_application_submission() {
    try {
        // Only verify nonce for logged-in users to prevent caching issues for guests.
        // Public/guest submissions shouldn't fail due to cached/expired nonces.
        if (is_user_logged_in()) {
            if (!isset($_POST['job_application_nonce']) || !wp_verify_nonce($_POST['job_application_nonce'], 'submit_job_application')) {
                wp_send_json_error(array('message' => __('Security check failed.', 'limadia-entity-foundation-v1')));
            }
        }

        $name      = sanitize_text_field($_POST['form_name']);
        $email     = sanitize_email($_POST['form_email']);
        $phone     = sanitize_text_field($_POST['form_phone']);
        
        $portfolio_raw = isset($_POST['form_portfolio']) ? trim($_POST['form_portfolio']) : '';
        $portfolio = '';
        if ($portfolio_raw !== '') {
            if (!preg_match('/^(https?|ftp):\/\//i', $portfolio_raw)) {
                $portfolio = esc_url_raw('http://' . $portfolio_raw);
            } else {
                $portfolio = esc_url_raw($portfolio_raw);
            }
            if (!$portfolio) {
                $portfolio = sanitize_text_field($portfolio_raw);
            }
        }

        $job_id    = intval($_POST['job_id']);

        if (empty($name) || empty($email) || empty($phone) || empty($job_id)) {
            wp_send_json_error(array('message' => __('Please fill all required fields.', 'limadia-entity-foundation-v1')));
        }

    // Create the application post
    $application_id = wp_insert_post(array(
        'post_title'   => $name . ' - ' . get_the_title($job_id),
        'post_type'    => 'job_application',
        'post_status'  => 'private', // Keep applications private
    ));

    if (is_wp_error($application_id)) {
        wp_send_json_error(array('message' => __('Something went wrong. Please try again.', 'limadia-entity-foundation-v1')));
    }

    // Save meta data
    update_post_meta($application_id, '_applicant_email', $email);
    update_post_meta($application_id, '_applicant_phone', $phone);
    update_post_meta($application_id, '_applicant_portfolio', $portfolio);
    update_post_meta($application_id, '_job_id', $job_id);
    update_post_meta($application_id, '_application_read_status', '0'); // 0 = Unread, 1 = Read

    // Handle File uploads
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');

    $allowed_mimes = array('application/pdf');

    // Validate that files are uploaded
    if (empty($_FILES['form_attachment']['name'])) {
        wp_delete_post($application_id, true); // Cleanup
        wp_send_json_error(array('message' => __('C/V (PDF) is required.', 'limadia-entity-foundation-v1')));
    }
    if (empty($_FILES['form_cover_letter']['name'])) {
        wp_delete_post($application_id, true); // Cleanup
        wp_send_json_error(array('message' => __('Cover Letter (PDF) is required.', 'limadia-entity-foundation-v1')));
    }

    // Check for upload error codes for CV
    if ($_FILES['form_attachment']['error'] !== UPLOAD_ERR_OK) {
        wp_delete_post($application_id, true); // Cleanup
        $err_msg = __('An error occurred while uploading your C/V.', 'limadia-entity-foundation-v1');
        if ($_FILES['form_attachment']['error'] === UPLOAD_ERR_INI_SIZE || $_FILES['form_attachment']['error'] === UPLOAD_ERR_FORM_SIZE) {
            $err_msg = __('Your C/V exceeds the maximum upload file size.', 'limadia-entity-foundation-v1');
        }
        wp_send_json_error(array('message' => $err_msg));
    }

    // Check for upload error codes for Cover Letter
    if ($_FILES['form_cover_letter']['error'] !== UPLOAD_ERR_OK) {
        wp_delete_post($application_id, true); // Cleanup
        $err_msg = __('An error occurred while uploading your Cover Letter.', 'limadia-entity-foundation-v1');
        if ($_FILES['form_cover_letter']['error'] === UPLOAD_ERR_INI_SIZE || $_FILES['form_cover_letter']['error'] === UPLOAD_ERR_FORM_SIZE) {
            $err_msg = __('Your Cover Letter exceeds the maximum upload file size.', 'limadia-entity-foundation-v1');
        }
        wp_send_json_error(array('message' => $err_msg));
    }

    // Handle CV upload
    $file_type = wp_check_filetype($_FILES['form_attachment']['name']);
    if (!in_array($file_type['type'], $allowed_mimes)) {
        wp_delete_post($application_id, true); // Cleanup
        wp_send_json_error(array('message' => __('Only PDF files are allowed for the CV.', 'limadia-entity-foundation-v1')));
    }
    $attachment_id = media_handle_upload('form_attachment', $application_id);
    if (is_wp_error($attachment_id)) {
        wp_delete_post($application_id, true); // Cleanup
        wp_send_json_error(array('message' => __('Failed to upload CV: ', 'limadia-entity-foundation-v1') . $attachment_id->get_error_message()));
    }
    update_post_meta($application_id, '_applicant_cv_id', $attachment_id);

    // Handle Cover Letter upload
    $file_type = wp_check_filetype($_FILES['form_cover_letter']['name']);
    if (!in_array($file_type['type'], $allowed_mimes)) {
        wp_delete_post($application_id, true); // Cleanup
        wp_send_json_error(array('message' => __('Only PDF files are allowed for the Cover Letter.', 'limadia-entity-foundation-v1')));
    }
    $cover_letter_id = media_handle_upload('form_cover_letter', $application_id);
    if (is_wp_error($cover_letter_id)) {
        wp_delete_post($application_id, true); // Cleanup
        wp_send_json_error(array('message' => __('Failed to upload Cover Letter: ', 'limadia-entity-foundation-v1') . $cover_letter_id->get_error_message()));
    }
    update_post_meta($application_id, '_applicant_cover_letter_id', $cover_letter_id);


    // Send email to admin with attachments
    $to = 'info@limadiafoundation.org';
    $subject = 'New Job Application: ' . get_the_title($job_id) . ' - ' . $name;
    
    $headers = array('Content-Type: text/html; charset=UTF-8');
    
    $body = "<h2>New Job Application Received</h2>";
    $body .= "<p><strong>Job Position:</strong> " . get_the_title($job_id) . "</p>";
    $body .= "<p><strong>Applicant Name:</strong> $name</p>";
    $body .= "<p><strong>Email:</strong> $email</p>";
    $body .= "<p><strong>Phone:</strong> $phone</p>";
    if ($portfolio) {
        $body .= "<p><strong>Portfolio/Website:</strong> <a href='$portfolio'>$portfolio</a></p>";
    }
    $body .= "<p><em>The CV and Cover Letter are attached to this email. You can also view this application in the WordPress dashboard.</em></p>";

    $attachments = array();
    if (isset($attachment_id) && !is_wp_error($attachment_id)) {
        $file_path = get_attached_file($attachment_id);
        if ($file_path) $attachments[] = $file_path;
    }
    if (isset($cover_letter_id) && !is_wp_error($cover_letter_id)) {
        $file_path = get_attached_file($cover_letter_id);
        if ($file_path) $attachments[] = $file_path;
    }

    // Attempt to send email to admin
    $mail_sent = wp_mail($to, $subject, $body, $headers, $attachments);

    // Send confirmation/acknowledgement email to the applicant
    $applicant_to      = $email;
    $applicant_subject = __('Application Received: ', 'limadia-entity-foundation-v1') . get_the_title($job_id);
    
    $applicant_headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: Limadia Foundation <info@limadiafoundation.org>'
    );
    
    $applicant_body = "<p>" . sprintf(__('Dear %s,', 'limadia-entity-foundation-v1'), $name) . "</p>";
    $applicant_body .= "<p>" . sprintf(__('Thank you for submitting your application for the <strong>%s</strong> position at Limadia Foundation.', 'limadia-entity-foundation-v1'), get_the_title($job_id)) . "</p>";
    $applicant_body .= "<p>" . __('We have successfully received your application, including your C/V and Cover Letter. Our hiring team will review your qualifications against the requirements for this role.', 'limadia-entity-foundation-v1') . "</p>";
    $applicant_body .= "<p>" . __('If your background and skills align with what we are looking for, we will contact you directly to discuss the next steps in the selection process.', 'limadia-entity-foundation-v1') . "</p>";
    $applicant_body .= "<p>" . __('We appreciate your interest in Limadia Foundation and the time you took to apply. We wish you the very best in your job search.', 'limadia-entity-foundation-v1') . "</p>";
    $applicant_body .= "<br>";
    $applicant_body .= "<p>" . __('Sincerely,', 'limadia-entity-foundation-v1') . "<br>";
    $applicant_body .= "<strong>" . __('Limadia Foundation Hiring Team', 'limadia-entity-foundation-v1') . "</strong><br>";
    $applicant_body .= "<a href='https://limadiafoundation.org'>limadiafoundation.org</a></p>";

    wp_mail($applicant_to, $applicant_subject, $applicant_body, $applicant_headers);

    if (!$mail_sent) {
        $error_msg = isset($GLOBALS['wp_mail_error']) ? $GLOBALS['wp_mail_error'] : 'Mail server rejected the connection.';
        wp_send_json_success(array('message' => __('Your application was submitted, but there was an error sending the notification email: ', 'limadia-entity-foundation-v1') . $error_msg));
    }

    wp_send_json_success(array('message' => __('Your application has been submitted successfully!', 'limadia-entity-foundation-v1')));
    } catch (Throwable $e) {
        wp_send_json_error(array('message' => 'System Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine()));
    }
}

add_action('wp_ajax_submit_job_application', 'handle_job_application_submission');
add_action('wp_ajax_nopriv_submit_job_application', 'handle_job_application_submission');
