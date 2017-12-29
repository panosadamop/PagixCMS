<?php

class Pagix_page_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }


	/*     * *************************** */
    /*     * ** Page Querys ************ */
    /*     * *************************** */
	/*function getSiteName() {
        // Get Theme
        $this->db->select("*");
       	$this->db->where("siteID", 0);
		$query = $this->db->get('pagix_settings');
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
        	foreach ($results as $u): 
				return $u['siteTitle'];			
			endforeach; 
		}
        return array();
    }
	
	function getTheme() {
        // Get Theme
        $this->db->select("*");
       	$this->db->where("siteID", 0);
		$query = $this->db->get('pagix_settings');
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
        	foreach ($results as $u): 
				return $u['siteTheme'];			
			endforeach; 
		}
        return array();
    }*/
	
    function getPage($pageURL) {
        // Get page
        $this->db->select("*");
        $this->db->join('pagix_page_content', 'pagix_page_content.pageID = pagix_page_attributes.pageID');
        $this->db->join('pagix_page_meta', 'pagix_page_meta.pageID = pagix_page_attributes.pageID');
		$this->db->where("pagePublished", 1);
		$this->db->where("pageURL", $pageURL);
        $query = $this->db->get('pagix_page_attributes');
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
        	foreach ($results as $u): 
				$page = array(
	   	   				'pageID'    			=> $u['pageID'],
	   	   				'pageTitle' 			=> $u['pageTitle'],
						'pageKeywords' 			=> $u['pageKeywords'],
						'pageDescription' 		=> $u['pageDescription'],
	   	   				'pageContentHTML'   	=> $u['pageContentHTML'],
						'pageTemplate'    		=> $u['pageTemplate'],
						'enableJumbotron'   	=> $u['enableJumbotron'],
						'enableSlider'   		=> $u['enableSlider'],
						'jumbotronHTML'    		=> $u['jumbotronHTML'],
                     );      	
			endforeach; 
			return $page;
		
		}
        return array('pageID' => "",'pageTemplate' => "");
    }
	function getCategory($catSlug) {
        // Get category
        $this->db->select("*");
		$this->db->where("categorySlug", $catSlug);
        $query = $this->db->get('pagix_post_category');
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
        	foreach ($results as $u): 
				$category = array(
	   	   				'pageID'    			=> $u['categoryID'],
						'categoryID'    		=> $u['categoryID'],
	   	   				'pageTitle' 			=> $u['categoryTitle'],
						'pageKeywords' 			=> '',
						'pageDescription' 		=> $u['categoryDescription'],
                     );      	
			endforeach; 
			return $category;
		
		}
        return array('categoryID' => "");
    }
	
	function getArticle($postURL) {
        // Get article
        $this->db->select("*");
		$this->db->where("postURL", $postURL);
        $this->db->where("published", 1);
        $this->db->join('pagix_post_category', 'pagix_post_category.categoryID = pagix_post.categoryID');
        $query = $this->db->get('pagix_post');
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
        	foreach ($results as $u): 
				$category = array(
	   	   				'pageID'    			=> $u['postID'],
						'postID'    			=> $u['postID'],
	   	   				'pageTitle' 			=> $u['postTitle'],
						'pageKeywords' 			=> '',
						'pageDescription' 		=> $u['postExcerpt'],
						'postContent' 			=> $u['postContentHTML'],
						'datePosted' 			=> $u['datePosted'],
						'categoryTitle' 		=> $u['categoryTitle'],
						'categorySlug' 			=> $u['categorySlug'],
                     );      	
			endforeach; 
			return $category;
		
		}
        return array('postID' => "");
    }
	
	
   function getSettings() {
        // Get settings
        $this->db->select("*");
		$this->db->where("siteID", 0);
        $query = $this->db->get('pagix_settings');
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
        	foreach ($results as $u): 
				$page = array(
						'siteLogo'    				=> $u['siteLogo'],
						'siteFavicon'    			=> $u['siteFavicon'],
						'siteTitle'    				=> $u['siteTitle'],
						'siteTheme'    				=> $u['siteTheme'],
						'siteFooter'    			=> $u['siteFooter'],
						'siteMaintenanceHeading'    => $u['siteMaintenanceHeading'],
						'siteMaintenanceMeta'	    => $u['siteMaintenanceMeta'],
						'siteMaintenanceContent'    => $u['siteMaintenanceContent'],
						'siteMaintenance'    		=> $u['siteMaintenance'],
						'siteAdditionalJS'    		=> $u['siteAdditionalJS'],
                     );      	
			endforeach; 
			return $page;
		
		}
        return array();
    }

}

?>