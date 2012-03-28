<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/xhp/init.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/UI/dialog.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/authentication.php';

class :hc:page_button extends :x:element {
	attribute
		string buttonId,
		string pageName,
		bool pageActive = false,
		string url;

	protected function render() {
		$pageName = $this->getAttribute('pageName');
		$pageActive = $this->getAttribute('pageActive');
		$url = $this->getAttribute('url');
		$root = 
			<a  href={$url} id={$this->getAttribute('buttonId')} class="nav_button">
			<div>
				{$pageName}
			</div>
			</a>;

		if($pageActive) {
			$root->addClass('active_nav');
		}
		return $root;
	}
}

class :hc:top_nav extends :x:element {

	protected function render() {
		global $loginUrl;
		
		$user = $_SESSION["userData"];
	
		$currentPage = (isset($_GET["page"])) ? $_GET["page"] : "new";
	
		$root = <div id="top_nav"></div>;
		$root_inner = 
			<div id="top_nav_inner">
				<div id="top_nav_header">
					<img src="/UI/resources/images/header_heart_pink.png" id="top_nav_header_img" />
					<a href="/" id="top_nav_header_text">
						<div>SKETCH VAULT</div>
					</a>
				</div>
			</div>;

		$root_inner->appendChild(
			<hc:page_button 
				buttonId="new_page_button" 
				pageName="New" 
				url = "/new"
				pageActive={($currentPage == "new")} 
			/>
		);

		$root_inner->appendChild(
			<hc:page_button 
				buttonId="popular_page_button"
				pageName="Popular" 
				url = "/popular"
				pageActive={($currentPage == "popular")}
			/>
		);

		if(!isset($_SESSION["userData"])) {
			
			$root_inner->appendChild(
					<hc:page_button
						buttonId="sign_in_button"
						pageName="Sign In" />);
			
		}
		else {
			
		$root_inner->appendChild(
			<hc:page_button 
				buttonId="favorites_page_button"
				pageName="My Favorites" 
				url = "/favorites"
				pageActive={($currentPage == "favorites")}
			/>);
			$root_inner->appendChild(
					<hc:page_button 
						buttonId="sign_out_button"
						pageName="Sign Out"/>);
		}

		$root->appendChild($root_inner);
		return $root;
	}
}
