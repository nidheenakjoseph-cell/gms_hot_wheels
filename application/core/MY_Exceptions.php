<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY_Exceptions
 *
 * Extends CI_Exceptions to intercept RuntimeException business-rule failures
 * and display a clean, user-friendly error page
 * instead of a raw PHP exception dump.
 *
 * Business-rule exceptions not handled by individual controllers are caught here.
 */
class MY_Exceptions extends CI_Exceptions
{
    /**
     * Override show_exception to render a proper page for RuntimeExceptions
    * that represent business-rule violations
     * rather than real system errors.
     */
    public function show_exception($exception)
    {
        // For RuntimeException business-rule violations, set HTTP 422 instead
        // of 500 so browsers/proxies treat it differently, and render our
        // custom error page which has a "Go Back" button and clear message.
        if ($exception instanceof RuntimeException) {
            set_status_header(422);
            $message   = $exception->getMessage();
            $templates_path = config_item('error_views_path');
            if (empty($templates_path)) {
                $templates_path = VIEWPATH . 'errors' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR;
            } else {
                $templates_path .= 'html' . DIRECTORY_SEPARATOR;
            }

            if (ob_get_level() > $this->ob_level + 1) {
                ob_end_flush();
            }
            ob_start();
            include($templates_path . 'error_exception.php');
            $buffer = ob_get_contents();
            ob_end_clean();
            echo $buffer;
            return;
        }

        // For all other exception types, fall back to default CI behaviour
        parent::show_exception($exception);
    }
}
