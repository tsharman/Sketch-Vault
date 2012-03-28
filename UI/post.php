<?php

session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/xhp/init.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/fetch_posts.php';


class :hc:post_nav_button extends :x:element {
	attribute
		bool active,
		string buttonId,
		string url,
		string name;
	protected function render() {
		$active = $this->getAttribute('active');
		$buttonId = $this->getAttribute('buttonId');
		$name = $this->getAttribute('name');
		$url = $this->getAttribute('url');
		$root =
			<a id={$buttonId} 
				class="button filter_button"
				href={$url}>
					{$name}
			</a>;
		if($active) {
			$root->addClass('active_filter');
		}
		return $root;
	}
}
class :hc:post_nav extends :x:element {
	protected function render() {
		$activeFilter = (isset($_GET["filter"])) ? $_GET["filter"] : "all";
		$root = 
			<div id="post_nav">
			</div>;
		$root->appendChild(
				<hc:post_nav_button
					buttonId="all_posts_button"
					name="All Time"
					active={($activeFilter == "all")}
					url="/popular"
					/>);
		$root->appendChild(
				<hc:post_nav_button
					buttonId="today_posts_button"
					name="Today"
					active={($activeFilter == "day")}
					url="/popular/day"
					/>);
		$root->appendChild(
				<hc:post_nav_button
					buttonId="week_posts_button"
					name="This Week"
					active={($activeFilter == "week")}
					url="/popular/week"
					/>);
		return $root;
	}
}



class :hc:post_list extends :x:element {
	protected function render() {
		$post_list = <div class="post_list"></div>;
		$currentPage = (isset($_GET["page"])) ? $_GET["page"] : "new";
		$currentFilter = (isset($_GET["filter"])) ? $_GET["filter"] : "all";
		$user = $_SESSION["userData"];
		switch($currentPage) {
			case "new":
				$posts = fetchNewPosts(0, 20);
				break;
			case "favorites":
				$posts = fetchFavoritePosts($user["ID"], 0, 20);
				break;
			case "popular":
				$posts = fetchPopularPosts(0, 20, $currentFilter);
				break;
			default:
				$posts = fetchNewPosts(0, 20);
				break;

		}
		if($currentPage == "popular") {
			$post_list->appendChild(
					<hc:post_nav
						/>);
		}
		if(count($posts) > 0) {
			foreach($posts as $post) {
				$post_list->appendChild($post);
			}
		}
		else {
			$post_list->appendChild(
					<div class="post_message">
						<h3>Oops! Looks like this list is empty!</h3><br />
						<h3>Maybe you should be a boss and go like a comic.</h3>
					</div>);
		}
		return $post_list;
	}
}


class :hc:post extends :x:element {
	attribute
		int post_id,
		string permalink,
		string series,
		string name,
		string img_url,
		bool favorited = false;

	protected function render() {
		$comic_series = $this->getAttribute('series');
		$comic_name = $this->getAttribute('name');
		$favorited = $this->getAttribute('favorited');
		$permalink = $this->getAttribute('permalink');
		$post = <div class="post"></div>;

		// post heading
		$post_heading = <div class="post_heading"></div>;
		$post_heading_series = 
			<div class="post_heading_series">
				{$comic_series}
			</div>;
		$post_heading_name = 
			<div class="post_heading_name">
				<a href={$permalink}>
					<div class="full_post_name">
						{$comic_name}
					</div>
				</a>
			</div>;

		// post favorited 
		$post_heading_favorited = <div class="post_heading_favorited"></div>;
		$favorite_class = ($favorited) ? "favorited" : "non_favorited";
		$post_heading_favorited->addClass($favorite_class);
		$post_id = $this->getAttribute('post_id');
		$post_heading_favorited->setAttribute("data-postid", $post_id);
		if(isset($_SESSION['userData'])) {
			$user_id = $_SESSION['userData']['ID'];
			$post_heading_favorited->setAttribute("data-userid", $user_id);
		}

		// post body
		$post_image =
			<a href={$permalink}>
				<img src={$this->getAttribute('img_url')} class="post_image" />
			</a>;

		$post_heading->appendChild($post_heading_name);
		$post_heading->appendChild($post_heading_series);
		$post_heading->appendChild($post_heading_favorited);
		$post->appendChild($post_heading);
		$post->appendChild($post_image);

		return $post;

	}
}

?>
