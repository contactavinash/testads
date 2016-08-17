
<header>

 <div class="top-main-area text-center">
            <div class="wrap-top">
                <a href="<?php echo base_url(); ?>" class="logo mt5">
                    <img src="<?php echo base_url(); ?>front/images/logo.png" alt="Image Alternative text" title="Image Title" />
                </a>
            </div>
        </div>
 
 <div class="main">
 
 
  <div class="wrap-top">
                <div class="row">
                    <div class="col-md-6">
                        <!-- MAIN NAVIGATION -->
                        <div class="flexnav-menu-button" id="flexnav-menu-button">Menu</div>
                        <nav>
                            <ul class="nav nav-pills flexnav" id="flexnav" data-breakpoint="800">
                                <li class="active"><a href="<?php echo base_url(); ?>">Home</a>  </li>
                            <?php
								$result = $this->front_model->header_menu();
								print_r($result);
								exit;
								foreach($result as $view)
								{
							?>	
								<li><?php echo anchor('cashback/cms/'.$view->cms_title,$view->cms_heading); ?></li>
                            <?php } ?>	
                            </ul>
                        </nav>
                        <!-- END MAIN NAVIGATION -->
                    </div>
                     <div class="col-md-6">
                        <!-- LOGIN REGISTER LINKS -->
                        <ul class="login-register">
                            <li class="shopping-cart"><?php echo anchor('cashback/addtocart','<i class="fa fa-shopping-cart"></i>  My Cart');?>
                                
                            </li>
							<?php
								$user_id = $this->session->userdata('user_id');
								if($user_id!="")
								{
							?>
							 <li>
							  <?php
								$attribute = array('class'=>'','data-effect'=>'mfp-move-from-top');
								echo anchor('cashback/logout','<i class="fa fa-sign-in"></i>  Logout',$attribute);
							 ?>
							 <!--<a class="popup-text" href="#login-dialog" data-effect="mfp-move-from-top"><i class="fa fa-sign-in"></i>Logout</a>-->
							 </li>
                           <?php
							}
							else
							{
							?>
							 <li>
							 <?php
								$attributes = array('class'=>'');
								echo anchor('cashback/login','<i class="fa fa-sign-in"></i> Sign in',$attributes);
							 ?>
							 <!--<a class="popup-text" href="#login-dialog" data-effect="mfp-move-from-top"><i class="fa fa-sign-in"></i>Sign in</a>-->
                            </li>
                            <li>
							<!--<a class="popup-text" href="#register-dialog" data-effect="mfp-move-from-top"><i class="fa fa-edit"></i>Sign up</a>-->
							<?php
								$attributes = array('class'=>'');
								echo anchor('cashback/register','<i class="fa fa-edit"></i> Sign up',$attributes);
							 ?>
                            </li>
							<?php
							}
							?>
                        </ul>
                    </div>
                </div>
            </div>
 
 </div>
  
  <form class="search-area form-group search-area-white">
            <div class="wrap-top">
                <div class="row">
                    <div class="col-md-8 clearfix">
                        <label><i class="fa fa-search"></i><span>I am searching for</span>
                        </label>
                        <div class="search-area-division search-area-division-input">
                            <input class="form-control" type="text" placeholder="Travel Vacation" />
                        </div>
                    </div>
                    <div class="col-md-3 clearfix">
                        <label><i class="fa fa-map-marker"></i><span>In</span>
                        </label>
                        <div class="search-area-division search-area-division-location">
                            <input class="form-control" type="text" placeholder="Boston" />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-block btn-white search-btn pop" type="submit">Search</button>
                    </div>
                </div>
            </div>
        </form>  

</header>