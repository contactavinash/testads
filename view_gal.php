<?php 
$siteurl =  "http://" . $_SERVER['SERVER_NAME'].substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], '/') + 1);
$handle = opendir(dirname(realpath(__FILE__)).'/gallery/');
$img_details = '<span style="display:none" id="hidediv1"><center>
<h5 style="color: red; font-weight: 600;">Image deleted successfully</h5>
</center></span>';
$a=1;
        while($file = readdir($handle))
		{
            if($file !== '.' && $file !== '..')
			{
               // echo '<img src="gallery/'.$file.'" border="0" />';
			   $img_details .= '<div class="preview processing success image-preview" id="divhide'.$a.'" style="cursor:pointer">
			    <span id="delloader'.$a.'" style="display:none;"> <center><img src="http://preloaders.net/preloaders/335/Thin%20broken%20ring.gif"></center></span>
			   <a id="delblo'.$a.'" onclick="deletefile(\''.$file.'\','.$a.');"><i class="icon icon-remove"></i></a>
                    <div class="details">
                    <div class="filename">
                    <div class="sizes">
                    <a data-toggle="modal" data-target="#myModalnewmo'.$a.'"><img src="'.$siteurl.'/gallery/'.$file.'"  alt="'.$file.'"></a>
                    </div>
					
                    </div>
                      </div>	
                  </div>
				  
				  <div class="modal fade" style="display: none;" id="myModalnewmo'.$a.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">View Image</h4>
					  </div>
					  <div class="modal-body">
						<center><img src="'.$siteurl.'/gallery/'.$file.'"  alt="'.$file.'">
						<br>
						<br>
						<textarea id="selecturl'.$a.'">'.$siteurl.'/gallery/'.$file.'</textarea>
						<button onclick="calfun('.$a.');" class="btn btn-success">Select URL</button></center>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					  </div>
					</div>
				  </div>
				</div>
				  ';
				$a++;
            }
        }		
		echo $img_details;
?>
