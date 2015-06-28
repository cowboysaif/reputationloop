<?php
error_reporting(0);
 if(isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction']!=''){
$actionfunction = $_REQUEST['actionfunction'];

  
   call_user_func($actionfunction,$_REQUEST);
}
function showData($data){
	
	  $page = $data['page'];
	   if($page==1){
	   $offset = 0;  
	  }
	  else{
	  $offset = ($page-1)*$limit;
	  }

	  $apiKey = "61067f81f8cf7e4a1f673cd230216112";
	  if ( $data['num_of_review'] == "" ) { 
	  $noOfReviews = "50";
	  }
	  else {
	  $noOfReviews = $data['num_of_review'];
	 
	  }
	  $internal = "1";
	
	  if ( $data["yelp"] == "" ) {
	  $yelp = "1";
	  }
	  else {
	  $yelp = $data["yelp"];
	
	  }
	  if ( $data["google"] == "" ) {
	  $google = "1";
	  }
	  else {
	  $google = $data["google"];
	 
	  }
	  
	  if ( !isset($data["internal"])  ) {
	  $internal = "1";
	  }
	  else {
	  $internal = $data["internal"];
	 
	  }
	  
	  if ( !isset($data["star"]) ) {
	  $threshold = "1";
	  }
	  else {
	  $threshold = $data["star"];
	 
	  }
	
	  $limit = 10;
	  $adjacent = 10;
	 
	  $url="http://test.localfeedbackloop.com/api?apiKey=".$apiKey."&noOfReviews=".$noOfReviews."&internal=".$internal."&yelp=".$yelp."&google=".$google."&offset=".$offset."&threshold=".$threshold;
	
	  
	  //  Initiate curl
	  $ch = curl_init();
	  // Disable SSL verification
	  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	  // Will return the response, if false it print the response
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  // Set the url 
	  curl_setopt($ch, CURLOPT_URL,$url);
	  // Execute
	  $result=json_decode(curl_exec($ch));
	
	  // Closing
	  curl_close($ch);
	  $str = '<header class="container">
	  			<input type="hidden" id="page_num" value="'.$page.'"></input>
    			<section class="content">
				<h1 id="business_name">'.$result->business_info->business_name.'</h1>
				<p>'.$result->business_info->business_address.'</p>
				<p>'.$result->business_info->business_phone.'</p>
				<p><span class="stars">'.$result->business_info->total_rating->total_avg_rating.'</span>'.$result->business_info->total_rating->total_avg_rating.' ('.$result->business_info->total_rating->total_no_of_reviews.' total reviews)</p>
				<p><a class="button" href="'.$result->business_info->external_page_url.'">Go to website</a>
				<div >';
				
				for ( $i = intval($page) * 10 - 10 ; $i <= intval($page)*10 ; $i++ ) {
					if ( $noOfReviews < $i  )  break;
					$str = $str .'
				<blockquote>
				<a href="'.$result->reviews[$i]->customer_url.'">'.$result->reviews[$i]->customer_name.' '.$result->reviews[$i]->customer_last_name.'</a>
				<p><span class="stars">'.$result->reviews[$i]->rating.'</span> '.$result->reviews[$i]->rating.' Stars '.$result->reviews[$i]->date_of_submission.'</p>
				<p>'.$result->reviews[$i]->description.'<p>
				</blockquote>';
				}
			$str = $str.'</div>
				</section>
  			</header>
	  ';
	  echo $str;
	  pagination($limit,$adjacent,$noOfReviews,$page);  
}
function pagination($limit,$adjacents,$rows,$page){	
	$pagination='';
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$prev_='';
	$first='';
	$lastpage = ceil($rows/$limit);	
	$next_='';
	$last='';
	if($lastpage > 1)
	{	
		
		//previous button
		if ($page > 1) 
			$prev_.= "<a class='page-numbers' href=\"?page=$prev\">previous</a>";
		else{
			//$pagination.= "<span class=\"disabled\">previous</span>";	
			}
		
		//pages	
		if ($lastpage < 5 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
		$first='';
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
			}
			$last='';
		}
		elseif($lastpage > 3 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			$first='';
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
			$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";			
			}
			
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
		       $first.= "<a class='page-numbers' href=\"?page=1\">First</a>";	
			for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
				$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";			
			}
			//close to end; only hide early pages
			else
			{
			    $first.= "<a class='page-numbers' href=\"?page=1\">First</a>";	
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
				$last='';
			}
            
			}
		if ($page < $counter - 1) 
			$next_.= "<a class='page-numbers' href=\"?page=$next\">next</a>";
		else{
			//$pagination.= "<span class=\"disabled\">next</span>";
			}
		$pagination = "<div class=\"pagination\">".$first.$prev_.$pagination.$next_.$last;
		//next button
		
		$pagination.= "</div>\n";		
	}

	echo $pagination;  
}
?>