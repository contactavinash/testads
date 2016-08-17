 <div class="col-md-3 col-sm-3">
          <div id="magik-verticalmenu" class="block magik-verticalmenu">
            <div class="nav-title"> <span>Categories</span> </div>
            <div class="nav-content">
              <div class="navbar navbar-inverse">
                <div id="verticalmenu" class="verticalmenu" role="navigation">
                  <div class="navbar">
                    <div class="collapse navbar-collapse navbar-ex1-collapse"> 
                      
                      <!-- BEGIN NAV -->
                      <ul class="nav navbar-nav verticalmenu">
                        <li class="parent dropdown"> <a href="#" id="all" class="selectcat">
                            <span>All Categories</span></a>                        
                        </li>
                        <?php
                        foreach ($premiumlist as $value) {?>
                           <li class="parent dropdown"> <a href="#" id="<?php echo $value->category_id; ?>" class="selectcat">
                            <span><?php echo $value->category_name; ?></span><b class="round-arrow"></b></a>
                        </li><?php
                        }?>
                       
                       
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>