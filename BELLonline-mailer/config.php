<?php
/* 
	BELLonline PHP MAILER SCRIPT v1.5
	Copyright 2006 Gavin Bell 
	http://www.bellonline.co.uk 
	gavin@bellonline.co.uk

	Set up an email form on your website within minutes.
	Very simple to install and use, and fully customisable.

	All you need to edit to get the script working is $sendto_email
	but there are other options so that you can further customise the script.
*/

// Edit the following with the email address that you want the form to send to

$sendto_email = "changeme@example.com";


// The settings below should be fine but you can edit them anyway

// Disable email addresses from the same domain as your email from being sent? 
// This will often reduce spam but will not allow antone to send from anything@yourdomain. 
$checkdomain = "yes";
// Language variables
$lang_title = "Send an email";
$lang_notice = "Fill in the form to contact us by email. All fields are required";
$lang_name = "Your name";
$lang_youremail = "Your email";
$lang_subject = "Subject";
$lang_message = "Message";
$lang_confirmation = "Enter validation code";
$lang_submit = "Send email";
// Error messages
$lang_error = "Your email has not been sent, the following errors were found:";
$lang_noname = "You did not enter your name";
$lang_noemail = "You did not enter your email address";
$lang_nosubject = "You did not enter a subject";
$lang_nomessage = "You did not enter a message";
$lang_nocode = "You did not the validation code";
$lang_wrongcode = "You entered the validation code incorrectly. Please note that it is case sensitive";
$lang_invalidemail = "The email address that you entered appears to be invalid";
// Success
$lang_sent = "Your email has been sent. The following message was submitted:";
// Width of form inputs. Must include unites, e.g px 
$input_width = "300px";
// How do you want the title aligned?
$title_align = "left"; // Can be left, center or right
// To format the title text. If you are not confident with css then probably best left as it is
$title_css = "font-weight: bold; font-size: 120%;";
// Colour of error message
$error_colour = "red"; // Must use HTML compatible colour
// You can choose whether to display Powered by BELLonline PHP mailer script at the bottom of the mail form
// I understand that some peopme might not want to show our link, but we would appreciate it if you could 
// Possible options are yes or no
$showlink = "yes";
// Thanks for using the PHP mailer script, I hope you find it useful!
?>