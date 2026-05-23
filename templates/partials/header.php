<?php
/**
 * AIOHM Plugin Admin Header - Redesigned with internal plugin page navigation.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get the current page to set the 'active' class on the menu item
$aiohm_current_page = '';
if ( function_exists( 'get_current_screen' ) ) {
	$aiohm_screen = get_current_screen();
	if ( $aiohm_screen && strpos( $aiohm_screen->id, 'aiohm-' ) !== false ) {
		$aiohm_current_page = str_replace( 'toplevel_page_', '', $aiohm_screen->id );
		$aiohm_current_page = str_replace( 'admin_page_', '', $aiohm_current_page );
	}
}
?>
<div class="aiohm-admin-header">
	<div class="aiohm-admin-header__logo">
		<a href="<?php echo esc_url( admin_url( 'admin.php?page=aiohm-knowledge-assistant-pro' ) ); ?>">
			<?php
			if ( class_exists( 'AIOHM_KB_Core_Init' ) && defined( 'AIOHM_KB_PLUGIN_URL' ) ) {
				echo wp_kses_post(
					AIOHM_KB_Core_Init::render_image(
						AIOHM_KB_PLUGIN_URL . 'assets/images/AIOHM-logo.png',
						esc_attr__( 'AIOHM Logo', 'aiohm-knowledge-assistant' )
					)
				);
			} else {
				echo '<strong>' . esc_html__( 'AIOHM Assistant', 'aiohm-knowledge-assistant' ) . '</strong>';
			}
			?>
		</a>
	</div>
	<div class="aiohm-admin-header__nav">
		<nav class="aiohm-nav">
			<ul class="aiohm-menu">
			<?php
			// Show Pro Features link if user has active license, otherwise show Register PRO
			$aiohm_show_register_link = true;
			if ( function_exists( 'aiohm_kb_fs' ) ) {
				$aiohm_fs = aiohm_kb_fs();
				if ( $aiohm_fs->can_use_premium_code() || $aiohm_fs->is_paying() || $aiohm_fs->is_premium() ) {
					$aiohm_show_register_link = false;
					?>
					<li>
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=aiohm-pro-features' ) ); ?>">
							<?php esc_html_e( 'Pro Features', 'aiohm-knowledge-assistant' ); ?>
						</a>
					</li>
					<?php
				}
			}
			if ( $aiohm_show_register_link ) {
				?>
				<li>
					<a href="https://knowledge.aiohm.app/club/" target="_blank">Register PRO</a>
				</li>
				<?php
			}
			?>
			<li>
				<a href="https://knowledge.aiohm.app/contact/" target="_blank">Contact</a>
			</li>
			</ul>
		</nav>
	</div>
</div>
<div class="aiohm-admin-wrap">
