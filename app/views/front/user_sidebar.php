<?php

$user_id = $this->session->userdata('user_id');

 $balcne =  $this->front_model->user_balance($user_id);

					 $newbal =  number_format($balcne,2);

					 $paid_earnings =  $this->front_model->paid_earnings($user_id);

					 $paid_earning =  number_format($paid_earnings,2);

					 
					
					$balcne_cb =  $this->front_model->user_cashback_balance($user_id);
					
					 $new_cb_bal =  number_format($balcne_cb,2);
					 
					  $total_earnings =  $this->front_model->total_earnings($user_id);

					 $total_earning =  number_format($total_earnings,2);

					 

					 $waiting =  $this->front_model->waiting_approval($user_id);

					 $waiting_approval =  number_format($waiting,2);

					 

					 $reff =  $this->front_model->ref_earnings($user_id);

					 $ref_earning =  number_format($reff,2);

					 

				  ?>

<div class="col-md-3">

                  

                  <div class="earn-box clearfix">

                  

                  <h4 class="clr-blu text-center"> My Earnings</h4>

                  

                  <hr>

                  

                 <table class="table table-hover">

                 

                  <tr>

                    <td>Total Earnings</td>

                    <td><?php echo DEFAULT_CURRENCY.' '.$total_earning;?></td>

                  </tr>
                  
                  
                  <tr>

                    <td>Cashback Earnings</td>

                    <td><?php echo DEFAULT_CURRENCY." ".$new_cb_bal;?></td>

                  </tr>

                  

                  <tr>

                    <td>Paid Earnings</td>

                    <td><?php echo DEFAULT_CURRENCY.' '.$paid_earning;?></td>

                  </tr>

                  

                  <tr>

                    <td>Earnings Available for payment</td>

                    <td><?php echo DEFAULT_CURRENCY." ".$newbal;?></td>

                  </tr>

                  

                  <tr>

                    <td>Waiting for withdraw approval</td>

                    <td><?php echo DEFAULT_CURRENCY." ".$waiting_approval;?></td>

                  </tr>

                  

                  <tr>

                    <td>Referral Earnings</td>

                    <td><?php echo DEFAULT_CURRENCY." ".$ref_earning;?></td>

                  </tr>

                  

                  <tr>

                    <td>Available Balance</td>

                    <td><?php echo DEFAULT_CURRENCY." ".$newbal;?></td>

                  </tr>

                  

                  

                  

                  </table>



                  

                  </div> 

                  

                  <div class="earn-box clearfix">

                  

                <h4 class="clr-blu text-center"> Frequently Asked Questions </h4>

                

                <?php

				$allfaqs = $this->front_model->get_allfaqs();

				if(count($allfaqs)!=0)

				{

					foreach($allfaqs as $faqs)

					{

						?>

                       		<h5 class="txt-tfm bld"><?php echo $faqs->faq_qn;?></h5>

                  

                          	<p class="text-justify"><?php echo $faqs->faq_ans;?></p>

                          

                         	<hr>

                        <?php

					}

				}

				?>      

                  

                  </div>

                  

                  </div>