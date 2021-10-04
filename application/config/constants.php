<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|-------------------------------------------------------------------------
| Twilio Constants
|-------------------------------------------------------------------------
*/
// TODO Replace values as needed
defined('TWILIO_ACCOUNT_SID')	OR define('TWILIO_ACCOUNT_SID',	'AC10b15200b4ad8de1f35d0c18e3ba7657');
defined('TWILIO_AUTH_TOKEN')	OR define('TWILIO_AUTH_TOKEN',	'1164e4fca1a19fc3388627ee3deb86a3');
defined('TWILIO_API_VERSION')	OR define('TWILIO_API_VERSION',	'2010-04-01');
defined('TWILIO_NUMBER')		OR define('TWILIO_NUMBER',		'9105448323');

/*
|-------------------------------------------------------------------------
| Email Constants
|-------------------------------------------------------------------------
*/
// TODO Replace values as needed
defined('SMTP_HOST') OR define('SMTP_HOST', 'smtp.sparkpostmail.com');
defined('SMTP_USER') OR define('SMTP_USER', 'SMTP_Injection');
defined('SMTP_PASS') OR define('SMTP_PASS', '3c72f548-d579-4c56-a04c-5126990ae253');
defined('SMTP_PORT') OR define('SMTP_PORT', '587');

defined('NOREPLY_EMAIL')	OR define('NOREPLY_EMAIL',	'noreply@kreativ.com');
defined('EMAIL_AUTHOR')		OR define('EMAIL_AUTHOR',	'Kreativ');

/*
|-------------------------------------------------------------------------
| Website Naming Constants
|-------------------------------------------------------------------------
*/
defined('WEBSITE_TITLE')	OR define('WEBSITE_TITLE',		'All American Poker Club');
defined('COPYRIGHT_TITLE')	OR define('COPYRIGHT_TITLE',	'All American Poker Club');

/*
|-------------------------------------------------------------------------
| Default Group Constants
|-------------------------------------------------------------------------
*/
defined('ADMINISTRATION')	OR define('ADMINISTRATION',	1);
defined('UNASSIGNED')		OR define('UNASSIGNED',		2);

/*
|-------------------------------------------------------------------------
| Random Constants
|-------------------------------------------------------------------------
*/
defined('FORM_NAME_MAX_LENGTH')			OR define('FORM_NAME_MAX_LENGTH',			100);

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
