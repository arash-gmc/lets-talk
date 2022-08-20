<?php

function header_to_lastpage($last_page,$profile_id,$post_id,$searched){
	if ($last_page=='timeline'){
			header("Location: .?action=".$last_page."#post-".$post_id);
		}else if ($last_page=='profile'){
			header("Location: .?action=".$last_page.'&profile_id='.$profile_id."#post-".$post_id);
		}else if ($last_page=='post-detail'){
			header("Location: .?action=".$last_page.'&post-id='.$post_id);
		}else if($last_page=='search'){
			header("Location: .?action=".$last_page.'&searched-word='.$searched."#post-".$post_id);
		}else{
			echo 'last action wan not definded';
		}
}


?>