<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

		</div><!-- .site-content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'twentysixteen' ); ?>">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_class'     => 'primary-menu',
							)
						);
					?>
				</nav><!-- .main-navigation -->
			<?php endif; ?>

			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentysixteen' ); ?>">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'social',
								'menu_class'     => 'social-links-menu',
								'depth'          => 1,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>',
							)
						);
					?>
				</nav><!-- .social-navigation -->
			<?php endif; ?>

			<div class="site-info">
				<?php
					/**
					 * Fires before the twentysixteen footer text for footer customization.
					 *
					 * @since Twenty Sixteen 1.0
					 */
					do_action( 'twentysixteen_credits' );
				?>
				<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
				<?php
				if ( function_exists( 'the_privacy_policy_link' ) ) {
					the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
				}
				?>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentysixteen' ) ); ?>" class="imprint">
					<?php printf( __( 'Proudly powered by %s', 'twentysixteen' ), 'WordPress' ); ?>
				</a>
			</div><!-- .site-info -->
		</footer><!-- .site-footer -->
	</div><!-- .site-inner -->
</div><!-- .site -->
<div id="popup-container" style="display: none;">
    <div id="popup-form">
        <div class="error-form"></div>
        <form id="feedback-form" action="javascript:void(0);">
            <label>ФИО</label>
            <input type="text" name="username" maxlength="100"/>

            <label>E-mail</label>
            <input type="email" name="email" required/>

            <label>Сообщение</label>
            <textarea name="message" required> </textarea>

            <div class="photo-form">
                <label>Фото</label>
                <input type="file" name="photo" accept="image/x-png, image/jpeg"  required/>
            </div>

            <input type="hidden" name="action" value="feedbackform"/>

            <button> Отправить</button>
        </form>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
