<?php
	$company_id;
	$name;
	$banner_img;
	$bio;
	$company_col;
	$company_url;
	$twitter_id;
	$focus_link; 
	$facebook_link; 
	$twitter_link;					
	$linkedin_link;
	$youtube_link; 
	$google_plus_link; 
	$press_release_link;

	$company_page = get_page_by_title( 'ecobank' );
	$page_id = $page->ID;

	$category_id = get_query_var('cat');
	$category = get_category( $category_id );
	$has_children = get_terms( 'category', array( 'parent' => $category_id, 'hide_empty' => false ) );
	$parent = get_category($category->category_parent);
	$parent_name = $parent->cat_name;

	class company
	{
		public function __construct($id, $name){
			$this->id = $id;
			$this->name = $name;
			$this->banner_img = get_field( "banner_image", $id );
			$this->bio = get_field( "bio", $id );
			$this->company_col = get_field( "company_col", $id );
			$this->company_url = get_field( "company_url", $id );
			$this->focus_link = get_field( "focus_link", $id );
			$this->twitter_id = get_field( "twitter_id", $id );
			$this->facebook_link = get_field( "facebook_link", $id );
			$this->twitter_link = get_field( "twitter_link", $id );			
			$this->linkedin_link = get_field( "linkedin_link", $id );
			$this->youtube_link = get_field( "youtube_link", $id );
			$this->google_plus_link = get_field( "google_plus_link", $id );
			$this->press_release_link = get_field( "press_release_link", $id );
		} 
	    function get_id(){
	        echo $this->id;
	    }
	    function get_name(){
	        echo $this->name;
	    }
	}

//
	$ecobank = new company('8750', 'Ecobank');
	$afdb = new company('9143', 'African Development Bank');
	$cverde = new company('9745', 'Cape Verde');
	$wbank = new company('10125', 'World Bank');
	$ge = new company('10472', 'General Electric');
	

	$companies = array($ecobank, $afdb, $cverde, $wbank, $ge);

	foreach($companies as $company){
		if($company->name == $category->name){
			$company_id = $company->id;
			$name = $company->name;
			$banner_img = $company->banner_img;
			$bio = $company->bio;
			$company_col = $company->company_col;
			$company_url = $company->company_url;
			$twitter_id = $company->twitter_id;
			$focus_link = $company->focus_link;
			$facebook_link = $company->facebook_link;
			$twitter_link = $company->twitter_link;			
			$linkedin_link = $company->youtube_link;_link;
			$youtube_link = $company->linkedin;
			$google_plus_link = $company->google_plus_link;
			$press_release_link = $company->press_release_link;
			break;
		}
	}
	
	// $category->cat_name
	/* $banner_img = get_field( "banner_image", 8750 );
	$bio = get_field( "bio", 8750 );
	$company_col = get_field( "company_col", 8750 );
	$company_url = get_field( "company_url", 8750 ); */

?>