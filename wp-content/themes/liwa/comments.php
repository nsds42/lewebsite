<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;
?>
<?php if ( have_comments() ) : ?>
<div class="twelve alt columns">
	<h3 class="headline">Comments <span class="comments-amount">(<?php comments_number( __('0', 'liwa'), __('1', 'liwa'), __('%', 'liwa') ); ?>)</span></h3><span class="line"></span><div class="clearfix"></div>
	<section class="comments-sec">
	
		<ol class="commentlist">
			<?php wp_list_comments('callback=liwa_theme_comment'); ?>
		</ol>
		<?php
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
			<nav class="navigation comment-navigation" role="navigation">		   
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'liwa' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'liwa' ) ); ?></div>
			</nav><!-- .comment-navigation -->
		<?php endif; // Check for comment navigation ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="no-comments"><?php _e( 'Comments are closed.' , 'CNE' ); ?></p>
		<?php endif; ?>			
	</section>
	<div class="clearfix"></div>
</div>
<?php endif; ?>		
<!-- //COMMENTS -->

<!-- LEAVE A COMMENT -->
<div class="respond">
<h3 class="headline">Add Comment</h3><span class="line" style="margin-bottom: 35px"></span><div class="clearfix"></div>
			
<!--Reply form-->
<div class="add-comment">
<?php
    if ( is_singular() ) wp_enqueue_script( "comment-reply" );
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $comment_args = array(
                'id_form' => 'comments_form', 	
                'title_reply'=> '',
                'fields' => apply_filters( 'comment_form_default_fields', array(
                    'author' => '<fieldset><div><label>Nick:</label>
                    <input type="text" placeholder="Name *" value="" id="author" name="author" /></div>', 
					
                    'email' => '<div><label>Email: <span>*</span></label>
                    <input type="text" placeholder="Email *" value="" id="email" name="email" /></div>',
                    'wedsite' =>'<div><label>WebSite:</label>
					<input type="text" placeholder="WebSite" value="" id="website" name="website" ></div></fieldset>',                                                                                  
                ) ),                                
                 'comment_field' => '<div><label>Comment: <span>*</span></label>
				 <textarea name="comment"'.$aria_req.'  placeholder="Message *" id="comment" cols="45" rows="10" ></textarea></div>',                                                   
                 'label_submit' => 'Add Comment',
                 'comment_notes_before' => '',
                 'comment_notes_after' => '',               
        )
    ?>
    <?php comment_form($comment_args); ?>
</div><!-- //LEAVE A COMMENT -->
  </div>              