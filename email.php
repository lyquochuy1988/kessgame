<?php

header("Content-Type: application/json");
$v = json_decode(stripslashes(file_get_contents("php://input")));

if (!empty($v)) {
	/*
	* GET user inputs.
	*/
	$subject = 'New Mail Recieved';
	$name = filter_var($v->name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	$email = filter_var($v->email, FILTER_SANITIZE_EMAIL);
	$message = filter_var($v->message, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

	/*
	* GET user information
	* make use of DOM Elements
	*/
	$ip = getenv('REMOTE_ADDR');
	$hostname = gethostbyaddr($ip);
	$userag = $_SERVER['HTTP_USER_AGENT'];
	$ip_api = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip));
	$user_country = $ip_api['country'];

	/*
	* Current Time
	*/
	$date = date('F jS, Y', time());
	$time = date('H:i', time());


	$sub = ' ' . $subject . ' ';
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'To: service@kessgame.com' . "\r\n";
	$headers .= 'From: noreply@kessgame.com' . "\r\n";
	$mail_to = 'service@kessgame.com';

	/*
	* Message Styling
	* Custom Styling for Responsiveness
	*/
	$msg = '<style>
	@import url(https://fonts.googleapis.com/css?family=Roboto:400,700,400italic,700italic&subset=latin,cyrillic);
	@media only screen and (min-width: 0) {
		.wrapper {
			text-rendering: optimizeLegibility;
		}
	}
	@media only screen and (max-width: 620px) {
		[class=wrapper] {
			min-width: 302px !important;
			width: 100% !important;
		}
		[class=wrapper] .block {
			display: block !important;
		}
		[class=wrapper] .hide {
			display: none !important;
		}
		[class=wrapper] .top-panel,
		[class=wrapper] .header,
		[class=wrapper] .main,
		[class=wrapper] .footer {
			width: 302px !important;
		}
		[class=wrapper] .website,
		[class=wrapper] .url,
		[class=wrapper] .techinal-details,
		[class=wrapper] .developer {
			display: block;
			float: left;
			width: 300px !important;
			text-align: center !important;
		}
		[class=wrapper] .techinal-details {
			padding-bottom: 0 !important;
		}
		[class=wrapper] .developer {
			padding-top: 0 !important;
		}
	}
	</style>
	';

	/*
	* Message Header
	* Includes the Sitename (Kess Game) & Website Link
	*/
	$msg .= '
	<center class="wrapper" style="display: table;table-layout: fixed;width: 100%;min-width: 620px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;background-color: #ffffff;">
		<table class="top-panel center" width="602" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;border-spacing: 0;margin: 0 auto;width: 602px;">
			<tbody>
				<tr>
					<td class="website" width="300" style="padding: 8px 0;vertical-align: top;text-align: left;width: 300px;color: #616161;font-family: Roboto, Helvetica, sans-serif;font-weight: 400;font-size: 12px;line-height: 14px;">Kess Game</td>
					<td class="url" width="300" style="padding: 8px 0;vertical-align: top;text-align: right;width: 300px;color: #616161;font-family: Roboto, Helvetica, sans-serif;font-weight: 400;font-size: 12px;line-height: 14px;"><a class="strong" href="http://kessgame.com" target="_blank" style="text-decoration: none;color: #616161;font-weight: 700;">www.kessgame.com</a></td>
				</tr>
				<tr>
					<td class="border" colspan="2" style="padding: 0;vertical-align: top;font-size: 1px;line-height: 1px;background-color: #e0e0e0;width: 1px;">&nbsp;</td>
				</tr>
			</tbody>
		</table>
		<div class="hr" style="font-size: 1px;line-height: 16px;width: 100%;">&nbsp;</div>
	';

	/*
* Message Body
* Includes the Sender Name, Email, and Message Content
*/
	$msg .= '
	<table class="main center" width="602" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;border-spacing: 0;background-color: lightgreen;border: 1px solid lightgray;margin: 0 auto;width: 602px;">
		<tbody>
			<tr>
				<td class="column" style="padding: 0;vertical-align: top;text-align: left;background-color: #ffffff;font-size: 14px;">
					<div class="column-top" style="font-size: 24px;line-height: 24px;">&nbsp;</div>
					<table class="content" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;border-spacing: 0;width: 100%;">
						<tbody>
							<tr>
								<td class="padded" style="padding: 0 24px;vertical-align: top;">
									<h1 style="margin-top: 0; margin-bottom: 0; color: #212121;font-family: Roboto, Helvetica, sans-serif;font-weight: 400; font-size: 20px;">You received new mail.</h1><p class="caption" style="margin-top: 0;margin-bottom: 16px;color: #616161;font-family: Roboto, Helvetica, sans-serif;font-weight: 400;font-size: 10px;"><strong style="font-weight: 700;">via</strong> website contact form.</p>
									<p class="contact-details" style="margin-top: 0;margin-bottom: 16px;color: #8d8d8d;font-family: Roboto, Helvetica, sans-serif;font-weight: 400;font-size: 12px;line-height: 14px;">
										From: <strong style="font-weight: 700;">' . $name . '</strong><br>
										Email:
										<strong style="font-weight: 700;">' . $email . '</strong>
									</p>
									<p style="margin-top: 0;margin-bottom: 16px;color: #212121;font-family: Roboto, Helvetica, sans-serif;font-weight: 400;font-size: 16px;line-height: 24px;">' . $message . '</p>
									<p class="message-time" style="margin-top: 0;margin-bottom: 16px;color: #8d8d8d;font-family: Roboto, Helvetica, sans-serif;font-weight: 400;font-size: 12px;line-height: 14px;text-align: right;">
										Sent: <strong style="font-weight: 700;">' . $date . '</strong><br>
										At: <strong style="font-weight: 700;">' . $time . ' GMT</strong>
									</p>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="column-bottom" style="font-size: 8px;line-height: 8px;">&nbsp;</div>
				</td>
			</tr>
		</tbody>
	</table>
	<div class="hr" style="font-size: 1px;line-height: 16px;width: 100%;">&nbsp;</div>
	';

	/*
* Message Footer
* Includes User Information, Site Logo, & Developer
*/
	$msg .= '
		<table class="footer center" width="602" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;border-spacing: 0;margin: 0 auto;width: 602px;">
		<tbody>
			<tr>
				<td class="border" colspan="2" style="padding: 0;vertical-align: top;font-size: 1px;line-height: 1px;background-color: #e0e0e0;width: 1px;">&nbsp;</td>
			</tr>
			<tr>
				<td class="techinal-details" width="300" style="padding: 0;vertical-align: bottom;width: 300px;padding-top: 8px;margin-bottom: 16px;opacity: 0.5;text-align: left;">
					<p style="margin-top: 0;margin-bottom: 8px;color: #616161;font-family: Roboto, Helvetica, sans-serif;font-weight: 400;font-size: 12px;line-height: 18px;">
						<strong style="font-weight: 700;">Sender Information :</strong><br>
						<strong style="font-weight: 700;">Host Name:</strong> ' . $hostname . '<br>
						<strong style="font-weight: 700;">IP:</strong><a href="http://www.geoiptool.com/?IP=' . $ip . '" target="_blank"> ' . $ip . ' (Click for more information)</a><br>
						' . ((!is_null($user_country) && !empty($user_country)) ? '<strong style="font-weight: 700;">Country:</strong> ' . $user_country . '<br>' : "") . '
						<strong style="font-weight: 700;">User Agent:</strong> ' . $userag . '<br>
					</p>
					<p style="margin-top: 0;margin-bottom: 8px;color: #616161;font-family: Roboto, Helvetica, sans-serif;font-weight: 400;font-size: 12px;line-height: 18px;">
						Developer: <a class="strong" href="https://www.freelancer.com/u/madsaaeq" target="_blank" style="text-decoration: none;color: #616161;font-weight: 700;">Mohamed Aae</a>
					</p>
				</td>
				<td class="developer" width="300" style="padding: 0;vertical-align: bottom;width: 300px;padding-top: 8px;margin-bottom: 16px;opacity: 0.5;text-align: right;">
					<div class="logo-image">
						<a href="http://kessgame.com" target="_blank" style="text-decoration: none;color: #616161;"><img src="http://kessgame.com/assets/img/logo.png" alt="logo-alt" width="70" height="70" style="border: 0;-ms-interpolation-mode: bicubic;width: 75px;height: auto;"></a>
					</div>
					<p style="margin-top: 0;margin-bottom: 8px;color: #616161;font-family: Roboto, Helvetica, sans-serif;font-weight: 400;font-size: 12px;line-height: 18px;">
						<a class="strong block" href="https://github.com/mohamedaae" target="_blank" style="text-decoration: none;color: #616161;font-weight: 700;">
							GitHub
						</a>
						<span class="hide">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
						<a class="strong block" href="mailto:madsaaeq@gmail.com" target="_blank" style="text-decoration: none;color: #616161;font-weight: 700;">
							Email
						</a>
					</p>
				</td>
			</tr>
		</tbody>
	</table>
	</center>
	';

	$validationOK = true;

	if (!$validationOK) {
		print "<meta http-equiv=\"refresh\" content=\"0;URL=index.html\">";
		exit;
	}

	$success = mail($mail_to, $sub, $msg, $headers);
};