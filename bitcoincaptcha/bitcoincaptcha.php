<?php
	/*
	Plugin Name: Bitcoin CAPTCHA
	Plugin URI: https://bitcoincaptcha.com/apis/wordpress
	Description: Hide parts of the content of your posts or pages until bitcoinCAPTCHA challenge is completed by surrounding it with <code>[bitcoinCAPTCHA]</code> and <code>[/bitcoinCAPTCHA]</code> shortcode.
	Version: 1.0
	Author: Kris
	Author URI: https://walletbit.com/
	*/

	$bitcoinaddress = '1AfsKC8cDoTstkqNd6WksL967NroarKdko';

	// Load jQuery
	wp_enqueue_script('jquery');

	// Load Hide This Part JS
	add_action('init', 'bitcoincaptcha_init');
	function bitcoincaptcha_init()
	{
		wp_register_script('bitcoincaptcha-js', WP_PLUGIN_URL . '/bitcoincaptcha/js.js');
		wp_enqueue_script('bitcoincaptcha-js');
	}

	// Add styling
	add_action('wp_head', 'bitcoincaptcha_head');
	function bitcoincaptcha_head()
	{
		$str_css_url = WP_PLUGIN_URL . "/bitcoincaptcha/style.css";
		echo '<link rel="stylesheet" href="' . $str_css_url . '" type="text/css" media="screen" />'."\n";
	}

	// Main functionality
	$int_conter = 0;
	add_shortcode('bitcoinCAPTCHA', 'bitcoincaptcha');
	function bitcoincaptcha($atts, $content = null)
	{
		global $int_conter;
		global $bitcoinaddress;

		if ($atts['unlocklink'] != '')
		{
			$str_unlock_link = $atts['unlocklink'];
		}
		else
		{
			$str_unlock_link = 'Unlock Content';
		}

		$str_return = '';

		$resp = bitcoincaptcha_check($bitcoinaddress, $_SERVER['REMOTE_ADDR'], $_POST['bitcoincaptcha_challenge']);
		if ($resp->isvalid)
		{
			$str_return .= do_shortcode($content);
		}
		else
		{
			$str_return .= '<div class="bitcoincaptcha-wrap">';
			$str_return .= '<div class="bitcoincaptcha-unlock" id="bitcoincaptcha-' . $int_conter . '" unlocklink-text="' . $str_unlock_link.'">' . $str_unlock_link . ' »</div>';
			$str_return .= '<div class="bitcoincaptcha" status="invisible">';
			$str_return.=<<<EOT
<script type="text/javascript" src="https://bitcoincaptcha.com/api/0/{$bitcoinaddress}"></script>
<a id="bitcoinCAPTCHA" href="https://bitcoincaptcha.com">bitcoinCAPTCHA</a>
EOT;
			$str_return .= '</div>';
			$str_return .= '</div>';
		}

		$int_conter++;

		return $str_return;
	}

	// bitcoincaptchalib

	function bitcoincaptcha_http_post($uri, $data)
	{
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $uri,
			CURLOPT_USERAGENT => 'bitcoinCAPTCHA/PHP',
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => http_build_query($data)
		));

		return curl_exec($ch);
	}

	function bitcoincaptcha_check($privkey, $remoteip, $challenge)
	{
		if ($privkey == null || $privkey == '' || $privkey == 'your_bitcoin_address') {
			die('To use bitcoinCAPTCHA you must get an bitcoin address from <a href="https://walletbit.com/">https://walletbit.com/</a>');
		}

		if ($remoteip == null || $remoteip == '') {
			die('For security reasons, you must pass the remote ip to bitcoinCAPTCHA');
		}

		$response = bitcoincaptcha_http_post('https://bitcoincaptcha.com/api/verify',
			array(
				'privatekey' => $privkey,
				'remoteip' => $remoteip,
				'challenge' => $challenge
			)
		);

		$response = explode("\r\n", $response);

		if ($response[0] == 1)
		{
			$bitcoincaptcha_response->isvalid = true;
		}
		else
		{
			$bitcoincaptcha_response->isvalid = false;
			$bitcoincaptcha_response->error = $response[1];
		}

		return $bitcoincaptcha_response;
	}
?>