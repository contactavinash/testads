<?php 

if($this->uri->segment(2)!='faq')
{
	foreach($result as $views)
	{			
		$meta_title = $views->cms_metatitle;
		$meta_key = $views->cms_metakey;
		$meta_desc = $views->cms_metadesc;
		$content = $views->cms_content;
		$heading = $views->cms_heading;
		$breadcrumbs = $views->cms_heading;
		$cms_title = $views->cms_title;
		
	}
}
else
{
		$meta_title = 'FAQ';
		$meta_key = 'FAQ';
		$meta_desc = 'FAQ';
		//$content = $views->cms_content;
		$heading = 'FAQ';
		$breadcrumbs = 'Help';
		$cms_title = 'FAQ';
}

?>  
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $heading; ?> - <?php $admindetails = $this->front_model->getadmindetails_main(); echo $admindetails->site_name; ?></title>
<?php $this->load->view('front/css_script');?>
</head>

<body>
<?php $this->load->view('front/header');?>


<section class="terms mar-bot20">

<div class="container">
<h3 class="text-center text-uppercase"><?php echo $heading; ?> </h3>
<div class="bor bg-red"></div>
    
        <div class="row">
          
          <div class="col-md-12">
          
          
          
       
               <?php
			if($this->uri->segment(2)=='faq')
			{
				$faq_res = $this->db->query('SELECT * FROM `tbl_faq` where status=1 order by faq_id desc')->result();
				$ganesh=0;
				foreach($faq_res as $result)
				{
					$string = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $result->faq_ans);
					?>
                    <div class="panel-group"  role="tablist" aria-multiselectable="true">
    
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                          <h4 class="panel-title">
                            <a  role="button" data-toggle="collapse" data-parent="#accordion"  aria-expanded="false" aria-controls="collapseThree">
                             <?php echo $result->faq_qn;?>
                            </a>
                          </h4>
                        </div>
                        <div class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body" style="padding: 10px;">
                           <?php echo $string;?> 
                          </div>
                        </div>
                      </div>
                    </div>
            
				
				<?php
				$ganesh++;
				}
				?> 					
				</div>
			 <?php
			}
			else
			{
			?>
				<?php echo $content; ?>
        
			<?php
			}
			?>
    </div>
     
  </div>
  
  </div>
</section>



<!--- inner pagesec ends here --->
<?php //$this->load->view('front/partners');?>

<!--- partners ebds here --->
<?php $this->load->view('front/sub_footer');
	
//Footer
	$this->load->view('front/site_intro');	
?>
<!--- footer ends here ---> 
<?php  $this->load->view('front/js_scripts');?>
<script>
$(document).ready(function(){
			$('.panel-group').click(function(){
  var cur=$(this);
$('.panel-collapse').removeClass('in');
 cur.find('.panel-collapse').addClass('in'); 
});
		});
</script>

</body>
</html>
