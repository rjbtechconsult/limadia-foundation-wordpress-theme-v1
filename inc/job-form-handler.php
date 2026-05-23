<?php
/**
 * Handle Job Application Form Submission
 */

function handle_job_application_submission() {
    try {
        if (!isset($_POST['job_application_nonce']) || !wp_verify_nonce($_POST['job_application_nonce'], 'submit_job_application')) {
            wp_send_json_error(array('message' => __('Security check failed.', 'limadia-entity-foundation-v1')));
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

    // Handle CV upload
    if (!empty($_FILES['form_attachment']['name'])) {
        $file_type = wp_check_filetype($_FILES['form_attachment']['name']);
        if (!in_array($file_type['type'], $allowed_mimes)) {
            wp_delete_post($application_id, true); // Cleanup
            wp_send_json_error(array('message' => __('Only PDF files are allowed for the CV.', 'limadia-entity-foundation-v1')));
        }
        $attachment_id = media_handle_upload('form_attachment', $application_id);
        if (!is_wp_error($attachment_id)) {
            update_post_meta($application_id, '_applicant_cv_id', $attachment_id);
        }
    }

    // Handle Cover Letter upload
    if (!empty($_FILES['form_cover_letter']['name'])) {
        $file_type = wp_check_filetype($_FILES['form_cover_letter']['name']);
        if (!in_array($file_type['type'], $allowed_mimes)) {
            wp_delete_post($application_id, true); // Cleanup
            wp_send_json_error(array('message' => __('Only PDF files are allowed for the Cover Letter.', 'limadia-entity-foundation-v1')));
        }
        $cover_letter_id = media_handle_upload('form_cover_letter', $application_id);
        if (!is_wp_error($cover_letter_id)) {
            update_post_meta($application_id, '_applicant_cover_letter_id', $cover_letter_id);
        }
    }


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

    // Attempt to send email
    $mail_sent = wp_mail($to, $subject, $body, $headers, $attachments);

    if (!$mail_sent) {
        $error_msg = isset($GLOBALS['wp_mail_error']) ? $GLOBALS['wp_mail_error'] : 'Mail server rejected the connection.';
        wp_send_json_success(array('message' => __('Your application was submitted, but there was an error sending the email: ', 'limadia-entity-foundation-v1') . $error_msg));
    }

    wp_send_json_success(array('message' => __('Your application has been submitted successfully!', 'limadia-entity-foundation-v1')));
    } catch (Throwable $e) {
        wp_send_json_error(array('message' => 'System Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine()));
    }
}

add_action('wp_ajax_submit_job_application', 'handle_job_application_submission');
add_action('wp_ajax_nopriv_submit_job_application', 'handle_job_application_submission');
