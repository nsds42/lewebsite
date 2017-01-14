<?php 
/*
*Template Name: Login / Register
*
*/
?>
<?php get_header(); ?>
<section id="titlebar">
	<!-- Container -->
	<div class="container">
		<div class="eight columns" data-appear-top-offset="-100" data-animated="fadeInLeft">
			<?php while (have_posts()): the_post(); ?> 
				<?php $icon_class = get_post_meta(get_the_ID(),'_cmb_icon_class', true);?>
				<h2><i class="<?php if($icon_class !=''){ echo $icon_class;}else{echo 'icon-ticket';}?>"></i> <?php the_title(); ?></h2>
			<?php endwhile; ?>
		</div>
		<div class="eight columns" data-appear-top-offset="-100" data-animated="fadeInRight">
			<?php echo liwa_breadcrumbs(); ?>
		</div>
	</div>
	<!-- Container / End -->
</section>

<!-- Container / Start -->
<div class="container">
	<?php while (have_posts()): the_post(); ?> 
		<?php $page_sub_title = get_post_meta(get_the_ID(),'_cmb_page_sub_title', true);?>
		<?php if($page_sub_title !=''){?>
			<div class="sixteen columns">
				<h3 class="headline"><?php echo htmlspecialchars_decode($page_sub_title); ?></h3><span class="line" style="margin-bottom:45px;"></span><div class="clearfix"></div>
			</div>
		<?php }?>
		<div class="clearfix"></div>
	<?php endwhile; ?>
	<div class="eight columns" data-animated="fadeInLeft">
		<div class="box">
			<h4><i class="icon-user"></i> Member Login</h4>
			<br/>
			<div id="contact" data-appear-top-offset="-100">
				<!-- Form -->									
				<form action="<?php echo home_url(); ?>/wp-login.php" name="loginform" method="post" id="loginform">
					<fieldset>
						<div>
							<label for="name" accesskey="U">Email</label>
							<input type="text" name="log" id="user_login" placeholder="Username">
						</div>
						<div>
							<label for="name" accesskey="U">Password</label>
							<input type="password" name="pwd" id="user_pass" placeholder="Password">
						</div>
						<div class="checkbox">
							<label> 
								<input type="checkbox" name="rememberme" id="rememberme" value="forever"> Remember me
							</label>
						</div>
					</fieldset>
					<input type="submit" name="wp-submit" id="wp-submit" value="Sign in" />
					<div class="clearfix"></div>
				</form>
			</div><!-- end box -->
		</div>
	</div>
	   <div class="eight columns" data-animated="fadeInRight">
			<div class="box">
			<h4><i class="icon-file-alt"></i> New Registration</h4>
			<br/>
			<div id="contact" data-appear-top-offset="-100">
				<!-- Form -->
				<?php
					if( isset( $_POST['svalue'] ) )
					{
						if($_POST['svalue'] != $_SESSION['answer']) {
							$matherror = "Wrong math!";
						}
						else {
							$matherror = " ";
						}
					}
					  if(defined('REGISTRATION_ERROR')){
						foreach(unserialize(REGISTRATION_ERROR) as $error){
							echo '<p class="error">'.$error.'</p';
						}					    
					  } elseif(defined('REGISTERED_A_USER')){
							echo '<p class="success">Successful registration, an email has been sent to '.REGISTERED_A_USER .'</p>';
					  }
					  //echo '<p class="error">'. $matherror .'</p>';
				?>									
				<form id="registerform" method="post" name="registerform" action="<?php echo add_query_arg('do', 'register', get_permalink( $post->ID )); ?>">	
					<fieldset>
						<div>
							<label for="username" accesskey="U">Name</label>
							<input type="text" id="username" name="user" value="" placeholder="User name" required="required">
						</div>
						<div>
							<label for="first-name" accesskey="U">First Name</label>
							<input id="first-name" type="text" value="" name="first-name" placeholder="First name" required="required">
						</div>
						<div>
							<label for="last-name" accesskey="U">Last Name</label>
							<input id="last-name" type="text" value="" name="last-name" placeholder="Last name" required="required">
						</div>
						<div>
							<label for="email" accesskey="U">Email</label>
							<input type="email" id="email" name="email" value="" placeholder="Email" required="required">
						</div>
						<div>
							<label for="pass" accesskey="U">Password</label>
							<input type="password" id="pass" name="pass" value="" placeholder="Password" required="required">
						</div>
						<div>
							<label for="pass1" accesskey="U">Confirm Password</label>
							<input type="password" id="pass1" name="pass1" value="" placeholder="Re-enter password" required="required">
						</div>										
					</fieldset>
					<input type="submit" value="Sign Up">									
					<div class="clearfix"></div>
				</form>
			</div><!-- end box -->
			</div>
		</div>
	<div class="clearfix"></div>
</div><!-- end shop-wrapper -->
<?php get_footer(); ?>