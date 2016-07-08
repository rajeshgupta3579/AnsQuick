<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

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
define('SHOW_DEBUG_BACKTRACE', TRUE);

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
define('EXIT_SUCCESS', 0); // no errors
define('EXIT_ERROR', 1); // generic error
define('EXIT_CONFIG', 3); // configuration error
define('EXIT_UNKNOWN_FILE', 4); // file not found
define('EXIT_UNKNOWN_CLASS', 5); // unknown class
define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
define('EXIT_USER_INPUT', 7); // invalid user input
define('EXIT_DATABASE', 8); // database error
define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code



define ("Pagination_links",serialize(Array(
								'full_tag_open'   => '<ul class="pagination">',
								'full_tag_close'  => '</ul>',
								'first_link'      => false,
								'last_link'       => false,
								'first_tag_open'  => '<li>',
								'first_tag_close' => '</li>',
								'prev_link'       => '«',
								'prev_tag_open'   => '<li class="prev">',
								'prev_tag_close'  => '</li>',
								'next_link'       => '»',
								'next_tag_open'   => '<li>',
								'next_tag_close'  => '</li>',
								'last_tag_open'   => '<li>',
								'last_tag_close'  => '</li>',
								'cur_tag_open'    => '<li class="active"><a href="#">',
								'cur_tag_close'   => '</a></li>',
								'num_tag_open'    => '<li>',
								'num_tag_close'   => '</li>',
)));

define ("imageConfig",serialize(Array(

                'upload_path'   => './Uploads/Profile/',
                'allowed_types' => 'gif|jpg|jpeg|png',
                'max_size'      => 12000,
                'max_width'     => 5000,
                'max_height'    => 5000,
                'overwrite'     => TRUE,
)));


/********MAILER CONSTANTS***********/
define ("EMAIL_CONFIG", serialize (Array(
  'protocol'  => 'smtp',
  'smtp_host' => 'ssl://smtp.googlemail.com',
  'smtp_port' =>  465,
  'smtp_user' => 'quickanswer16@gmail.com',
  'smtp_pass' => 'Jindal9@',
  'mailtype'  => 'html',
  'charset'   => 'iso-8859-1'
)));
define ("EMAIL_ADDRESS",'quickanswer16@gmail.com');
define ("HOST_NAME",'AnsQuick');
define ("DELIMITER",'-|::|-');
define ("FORGOT_PASSWORD_MAIL_MESSAGE","Follow the link to change your Password : ");
define ("SUGGESTOR_METHOD","sql");
define ("MAILER_LOG","mailers.log");
define ("QUESTION_QUERY_METHOD","solr");
define ("TAG_DETAIL_PAGE_URL","index.php/Tag/recent/");
define ("TOP_FEED_PAGE_URL","index.php/AnsQuick/top");
define("TAG_DETAIL_PAGE_PER_PAGE","1");
define("TAG_DETAIL_PAGE_URI_SEGMENT","1");
