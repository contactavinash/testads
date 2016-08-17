<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $admindetails[0]->homepage_title;?></title>
	<meta name="Description" content="<?php echo $admindetails[0]->meta_description;?>"/>    
    <meta name="keywords" content="<?php echo $admindetails[0]->meta_keyword;?>" />     
    <meta name="robots" CONTENT="INDEX, FOLLOW" />
<?php $this->load->view('front/css_script');?>
</head>

<body>
<?php $this->load->view('front/header');?>

<!-- header ends here --->



<!--- breadcrumb sec ends here --->

<section class="inner-page-sec clearfix  contacts-index-index">


		<div class="container">
	 
		<section class="mid-sec">
       
        <div class="row">
        
        <div class="col-md-12 col-sm-12 col-xs-12">
        
        <h3 class="heading text-center"> Payment Success </h3>
        
        <div class="privacy">
        <center><p>
		Your payment completed Sucessfully. Your coupon has been sent to your registered mail id. Thanks for shopping with us 
        </p>  
        <img src="<?php echo base_url(); ?>front/images/thanks.png">
        </center>
        <br>           
        </div>
        
        </div>
        

</div>
                
         
        </section>
        
        
    </div>
</section>


<!--- partners ebds here --->
<?php $this->load->view('front/sub_footer');
	
//Footer
	$this->load->view('front/site_intro');	
?>
<!--- footer ends here ---> 
<?php  $this->load->view('front/js_scripts');?>
</body>
</html>
