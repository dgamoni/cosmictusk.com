
<?php comment_form(); ?>

<?php if ( have_comments() ) : ?>


				<!--<h2 class="comments-title">
					<?php
						printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', THEME_TEXTDOMAIN ),
							number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
					?>
				</h2>-->

				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
				<nav id="comment-nav-above" class="comment-navigation" role="navigation">
					<h1 class="screen-reader-text"><?php _e( 'Comment navigation', THEME_TEXTDOMAIN ); ?></h1>
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', THEME_TEXTDOMAIN ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', THEME_TEXTDOMAIN ) ); ?></div>
				</nav><!-- #comment-nav-above -->
				<?php endif; // check for comment navigation ?>

				<ol class="comment-list">
					<?php
						wp_list_comments( array(
							'style'      => 'ol',
							'short_ping' => true,
							'avatar_size'       => 70,
						) );
					?>
				</ol><!-- .comment-list -->

				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
				<nav id="comment-nav-below" class="comment-navigation" role="navigation">
					<h1 class="screen-reader-text"><?php _e( 'Comment navigation', THEME_TEXTDOMAIN ); ?></h1>
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', THEME_TEXTDOMAIN ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', THEME_TEXTDOMAIN ) ); ?></div>
				</nav><!-- #comment-nav-below -->
				<?php endif; // check for comment navigation ?>

			<?php endif; // have_comments() ?>

			<?php
				// If comments are closed and there are comments, let's leave a little note, shall we?
				if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
			?>
				<p class="no-comments text-align-center padding-both-40"><?php _e( 'Comments are closed.', THEME_TEXTDOMAIN ); ?></p>
			<?php endif; ?>
