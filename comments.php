<?php
/**
 * @Packge     : Education
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */
 
// Block direct access
if( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if ( post_password_required() ) {
    return;
}
?>

    <?php if ( have_comments() ) : ?>
		<section id="comments" class="comment-sec-area comments-area content--area pt-80"><!-- Comment Item Start-->
        <h4 class="text-uppercase pb-80"><?php printf( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'education' ), number_format_i18n( get_comments_number() ) ); ?></h4>
		
        <?php the_comments_navigation(); ?>
            <div class="commentlist">
                <?php
                    wp_list_comments( array(
                        'style'       => 'div',
                        'short_ping'  => true,
                        'avatar_size' => 70,
                        'callback'    => 'education_comment_callback'
                    ) );
                ?>
            </div><!-- .comment-list -->
        <?php the_comments_navigation(); ?>
		</section><!-- Comment Item End-->
    <?php endif; // Check for have_comments(). ?>

    <?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'education' ); ?></p>
    <?php endif; ?>
    
<?php

    //
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? "required='required'" : '' );
	$fields =  array(
	  'author' => '<div class="form-group form-inline"><div class="form-group col-lg-6 col-md-12 name"><input class="common-input mb-20 form-control" placeholder="'.esc_attr__( 'Enter your name', 'education' ).'" type="text" name="author" value="'. esc_attr( $commenter['comment_author'] ).'" id="cName" '.$aria_req.'></div>',
	  'email' =>'<div class="form-group col-lg-6 col-md-12 email"><input class="common-input mb-20 form-control" placeholder="'.esc_attr__( 'Enter your email', 'education' ).'" type="text" name="email"  value="' . esc_attr(  $commenter['comment_author_email'] ) .'" id="cEmail" '.$aria_req.'></div>',
      'url' =>'<div class="form-group w-100"><input class="common-input mb-20 form-control" placeholder="'.esc_attr__( 'Enter Your Website', 'education' ).'" type="text" name="url" value="'. esc_attr( $commenter['comment_author_url'] ) .'" id="cWebsite"></div></div>',
      'cookies_consent' =>'<p class="comment-form-cookies-consent text-left"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" value="yes" type="checkbox"><label class="cookies-consent-label" for="wp-comment-cookies-consent">'.esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'education' ).'</label></p>',
	);
	

	$args=array(
	'comment_field'         => '<div class="form-group"><textarea id="cMessage" rows="6" class="form-control mb-10" name="comment" placeholder="'.esc_attr__( 'Messege', 'education' ).'"></textarea></div>',
	'id_form'               =>'contactForm',
    'class_form'            =>'',
	'title_reply'           =>esc_html__( 'Leave a Reply', 'education' ),
	'title_reply_before'    =>'<h5 class="pb-20">',
	'title_reply_after'     =>'</h5>',
    'label_submit'          => esc_html__( 'Post Comment', 'education' ),
    'class_submit'          => 'primary-btn mt-20',
	'submit_button'         => '<button type="submit" name="%1$s" id="%2$s" class="%3$s">%4$s</button>',
	'fields'                =>$fields,
	
	);

    if( comments_open() ){ 
        echo '<section class="commentform-area comment-form pt-80">';
    }
    comment_form( $args );
    if( comments_open() ){ 
        echo '</section>';
    }
