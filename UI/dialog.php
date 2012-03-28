<?php
require_once 'xhp/init.php';
require_once 'lib/authentication.php';

class :hc:sign_in_dialog extends :x:element {
	attribute
		string loginUrl = "";
	protected function render() {
		$dialog = 
			<div id="sign_in_dialog" class="dialog">
			</div>;
		$heartIcon =
			<img src="/UI/resources/images/header_heart_pink.png" id="dialog_image"/>;
		$signinButton = 
			<div id="sign_in_buttons">
				<a href={$this->getAttribute('loginUrl')} class="login_button_wrapper"><div id="fb_login_button" class="login_button">Sign in with Facebook</div></a>
				
			</div>;
		$dialog->appendChild($heartIcon);
		$dialog->appendChild($signinButton);
		return $dialog;
	}
}



?>
