<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/xhp/init.php';

class :hc:image_div extends :x:element {
	children (:div, :img);
	protected function render() {
		$root = 
			<div></div>;
		$root->addClass('image_div');

		//Place the text that should be to the right of the image as children
		$contents = $this->getChildren('div');
		$contents = $contents[0];
		$contents->addClass('image_div_contents');

		$image = $this->getChildren('img');
		$image = $image[0];
		$image->addClass('image_div_img');
		$root->appendChild($image);
		$root->appendChild($contents);
		return $root;
	}
}


?>
