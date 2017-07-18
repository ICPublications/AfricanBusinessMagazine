<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>BELLonline simple PHP email form</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #003366;
}
-->
</style></head>

<body>
<h1>Simple PHP email form </h1>
<p>This is a demo for the simple email form.</p>
<p><?php include "BELLmailer.php"; ?></p>
<p>&copy; BELLonline.co.uk 2006 </p>
<pre>

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
BELLonline PHP mailer script v1.5
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Copyright 2006 Gavin Bell
Web: http://www.bellonline.co.uk 
Email: gavin@bellonline.co.uk
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
v1.0 Initial release
v1.1 Added stripslashes to avoid " being replaced by \" in emails
v1.2 Added extract($_POST);
v1.3 Added optional feature to disable emails sent from same domain as recipient (avoid spam)
v1.4 Extra security features to avoid spammer abusing email form.
v1.5 Fixed bug that replaces "-" with space.


~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
About
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

This simple to set up PHP mailer for your website allows you add an email form to your 
web page within seconds so that people can contact you without having to log in to 
their email account.

This script is free to use and modify.

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Files included
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

* readme.txt - You're reading it
* config.php - The configuration file. Use this to customise the script
* BELLmailer.php - The actual script. You will not normally need to edit this file unless 
* demo.php - Example template for the script

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Installation
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

1. Unzip folder
2. Edit config.php (See below for variables)
3. Upload BELLmailer.php and config.php to your directory.
4. Create a template page (the page that the form will appear on)
5. Put the following line of code into your template page
(page must have a .php extension and be in the same directory as the script and config file)

 &lt;?php include "BELLmailer.php"; ?&gt;

If you are unsure, see demo.php

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

$sendto_email = "changeme@example.com";
	Change this to your email address. Script will not work until you have edited this.

$lang_title = "Send an email";
	The title that will appear above the form

$lang_notice = "Fill in the form to contact us by email. All fields are required";
	The text that will appear above the form then  user goes onto the page.

$lang_name = "Your name";
	Text that appears next to the name field

$lang_youremail = "Your email";
	Text that appears next to the email field

$lang_subject = "Subject";
	Text that appears next to the subject field

$lang_message = "Message";
	Text that appears next to the message field

$lang_confirmation = "Enter validation code";
	Text that appears next to the validation code

$lang_submit = "Send email";
	Text that appears in the submit button

$lang_error = "Your email has not been sent, the following errors were found:";
	Notifies the user that their email has not been sent due to error in the submission

$lang_noname = "You did not enter your name";
	User did not enter their name

$lang_noemail = "You did not enter your email address";
	User did not enter their email address

$lang_nosubject = "You did not enter a subject";
	User did not enter a subject for their email

$lang_nomessage = "You did not enter a message";
	User did not enter a message

$lang_nocode = "You did not the validation code";
	User did not enter the validation code

$lang_wrongcode = "You entered the validation code incorrectly. Please note that it is case sensitive";
	User entered the validation code incorrectly

$lang_invalidemail = "The email address that you entered appears to be invalid";
	User did not enter a valid email

$lang_sent = "Your email has been sent. The following message was submitted:";
	Confirmation that the email was sent

$input_width = "300px";
	Width of form inputs. Must include unites, e.g px 

$title_align = "left";
	Align title to left, center or right

$title_css = "font-weight: bold; font-size: 120%;";
	To format the title text using css. Best left alone

$error_colour = "red";
	Sets the colour of $lang_error. Uses HTML colour codes

$showlink = "yes";
	If set to yes will show the Powered by link in small text. You can disable this if you like

</pre>
</body>
</html>
