<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/xhp/init.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/authentication.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/UI/general.php';

class :hc:simple_msg_panel extends :x:element {
	attribute
		string id,
		string url,
		string message;
	protected function render() {
		$root = <div id={$this->getAttribute('id')} class="panel"></div>;
		$root->appendChild(
				<hc:image_div>
					<div>{$this->getAttribute('message')}</div>
					<img src={$this->getAttribute('url')} />
				</hc:image_div>);
		return $root;
	}

}

class :hc:user_meta_panel extends :x:element {
	protected function render() {
		global $user;
		global $user_profile;
		$panel = 
			<div id="user_meta_panel" class="panel">
			</div>;
		$imgSrc = "https://graph.facebook.com/".$user."/picture";
		$fbInfo =
			<div id="fb_info">
				<img src={$imgSrc} id="fb_img" />
				<div id="fb_name">
					{$user_profile["name"]}
				</div>
				<div id="fb_city">
					{$user_profile["location"]["name"]}
				</div>
			</div>;
		$panel->appendChild($fbInfo);
		return $panel;
	}	
}


class :hc:featured_panel extends :x:element {
	protected function render() {
			$panel = 
				<div id="featured_panel" class="panel">
				</div>;
			$featured_list =
				<div id="featured_list">
					<h2>Featured Webcomics</h2>
					<div class="featured_webcomic">xkcd</div>
					<div class="featured_webcomic">Dinosaur Comics</div>
					<div class="featured_webcomic">Cyanide and Happiness</div>
				
				</div>;
			$panel->appendChild($featured_list);
			return $panel;
		}
}


?>
