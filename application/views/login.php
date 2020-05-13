
 <div class="middle-box text-center loginscreen animated fadeInDown" style="width:50% !important;">
        <div>
            <div>

                  <!-- <h1 class="logo-name">S</h1>-->
				  <img src="<?php echo base_url(); ?>assets/img/logo.png" style="width:80%;">

            </div>
            <h3>Welcome to the Jashne Hyderabad Admin Panel</h3>
            
           
            <p>Login in. To see it in action.</p>
			<?php
                if (!is_null($msg)){
                    echo $msg;
                    
                } 
            ?>
            <form class="m-t" role="form" action="<?php echo base_url(); ?>index.php/home/login" method="post">
			<div id="main">
				<div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" required="" name="userName">				
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required="" name="password">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
				</div>
                
            </form>
           
        </div>
    </div>