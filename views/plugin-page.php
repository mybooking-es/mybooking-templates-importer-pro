<?php
/**
 * The plugin page view - the "settings" page of the plugin.
 *
 * @package mybooking-templates-importer
 */

namespace MybookingTemplatesImporter;

$predefined_themes = $this->import_files;

if ( empty( $this->import_files ) ) {
	$predefined_themes = array();
}

/**
 * Hook for adding the custom plugin page header
 */
do_action( 'mybooking-templates-importer/plugin_page_header' );
?>

<div class="mybooking-templates-importer wrap about-wrap">

	<?php ob_start(); ?>
		<h1 class="mybooking-templates-importer__title"><?php esc_html_e( 'Mybooking Templates Pro', 'mybooking-templates-importer' ); ?></h1>
	<?php
	$plugin_title = ob_get_clean();

	// Display the plugin title (can be replaced with custom title text through the filter below).
	echo wp_kses_post( apply_filters( 'mybooking-templates-importer/plugin_page_title', $plugin_title ) );

	// Display warrning if PHP safe mode is enabled, since we wont be able to change the max_execution_time.
	if ( ini_get( 'safe_mode' ) ) {
		printf(
			esc_html__( '%sWarning: your server is using %sPHP safe mode%s. This means that you might experience server timeout errors.%s', 'mybooking-templates-importer' ),
			'<div class="notice notice-warning is-dismissible"><p>',
			'<strong>',
			'</strong>',
			'</p></div>'
		);
	}

	// Start output buffer for displaying the plugin intro text.
	ob_start();
	?>

	<div class="mybooking-templates-importer__intro-text">
		<p class="about-description">
			<?php esc_html_e( 'Mybooking Templates Pro is the easiest way to setup your renting site with Mybooking Theme and Mybooking Reservation Engine plugin.', 'mybooking-templates-importer' ); ?><br>
			<?php esc_html_e( 'Once you select a template from the above gallery all demo post, pages, images, styles and theme settings will be imported to your site.', 'mybooking-templates-importer' ); ?>
		</p>

		<h3><?php esc_html_e( '1. Before you begin', 'mybooking-templates-importer' ); ?></h3>

		<p>
			<?php esc_html_e( 'You need to install the following components:', 'mybooking-templates-importer' ); ?>
			<ol>
				<li><?php esc_html_e( 'Mybooking Theme', 'mybooking-templates-importer' ); ?></li>
				<li><?php esc_html_e( 'Mybooking Reservation Engine plugin', 'mybooking-templates-importer' ); ?></li>
				<li><?php esc_html_e( 'Elementor plugin', 'mybooking-templates-importer' ); ?></li>
			</ol>
		</p>

		<div class="update-nag notice notice-warning inline">
			<?php esc_html_e( 'Please note:', 'mybooking-templates-importer' ); ?>
			<b><?php esc_html_e( 'No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified.', 'mybooking-templates-importer' ); ?></b>
		</div>
	</div>

	<?php
	$plugin_intro_text = ob_get_clean();

	// Display the plugin intro text (can be replaced with custom text through the filter below).
	echo wp_kses_post( apply_filters( 'mybooking-templates-importer/plugin_intro_text', $plugin_intro_text ) );
	?>

	<h3><?php esc_html_e( '2. Select a template', 'mybooking-templates-importer' ); ?></h3>

	<?php if ( 1 === count( $predefined_themes ) ) : ?>

			<div class="mybooking-templates-importer__gl-item-container  wp-clearfix  js-mybooking-templates-importer-gl-item-container">
				<?php $import_file = $predefined_themes[0]; ?>
				<?php $index=0; ?>
					<?php
						// Prepare import item display data.
						$img_src = isset( $import_file['import_preview_image_url'] ) ? $import_file['import_preview_image_url'] : '';
						// Default to the theme screenshot, if a custom preview image is not defined.
						if ( empty( $img_src ) ) {
							$theme = wp_get_theme();
							$img_src = $theme->get_screenshot();
						}

					?>
					<div class="mybooking-templates-importer__gl-item js-mybooking-templates-importer-gl-item" data-categories="<?php echo esc_attr( Helpers::get_demo_import_item_categories( $import_file ) ); ?>"
						                                       data-name="<?php echo esc_attr( strtolower( $import_file['import_file_name'] ) ); ?>">
						<div class="mybooking-templates-importer__gl-item-image-container">
							<?php if ( ! empty( $img_src ) ) : ?>
								<img class="mybooking-templates-importer__gl-item-image" src="<?php echo esc_url( $img_src ) ?>">
							<?php else : ?>
								<div class="mybooking-templates-importer__gl-item-image  mybooking-templates-importer__gl-item-image--no-image"><?php esc_html_e( 'No preview image.', 'mybooking-templates-importer' ); ?></div>
							<?php endif; ?>
						</div>
						<div class="mybooking-templates-importer__gl-item-footer<?php echo ! empty( $import_file['preview_url'] ) ? '  mybooking-templates-importer__gl-item-footer--with-preview' : ''; ?>">
							<h4 class="mybooking-templates-importer__gl-item-title" title="<?php echo esc_attr( $import_file['import_file_name'] ); ?>"><?php echo esc_html( $import_file['import_file_name'] ); ?></h4>
							<button class="mybooking-templates-importer__gl-item-button  button  button-primary  js-mybooking-templates-importer-gl-import-data" value="<?php echo esc_attr( $index ); ?>"><?php esc_html_e( 'Import', 'mybooking-templates-importer' ); ?></button>
							<?php if ( ! empty( $import_file['preview_url'] ) ) : ?>
								<a class="mybooking-templates-importer__gl-item-button  button" href="<?php echo esc_url( $import_file['preview_url'] ); ?>" target="_blank"><?php esc_html_e( 'Preview', 'mybooking-templates-importer' ); ?></a>
							<?php endif; ?>
						</div>
					</div>
			</div>
			<div id="js-mybooking-templates-importer-modal-content"></div>

	<?php elseif ( count( $predefined_themes ) > 1 ) : ?>

		<!-- MybookingTemplatesImporter grid layout -->
		<div class="mybooking-templates-importer__gl  js-mybooking-templates-importer-gl">
		<?php
			// Prepare navigation data.
			$categories = Helpers::get_all_demo_import_categories( $predefined_themes );
		?>
			<?php if ( ! empty( $categories ) ) : ?>
				<div class="mybooking-templates-importer__gl-header  js-mybooking-templates-importer-gl-header">
					<nav class="mybooking-templates-importer__gl-navigation">
						<ul>
							<li class="active"><a href="#all" class="mybooking-templates-importer__gl-navigation-link  js-mybooking-templates-importer-nav-link"><?php esc_html_e( 'All', 'mybooking-templates-importer' ); ?></a></li>
							<?php foreach ( $categories as $key => $name ) : ?>
								<li><a href="#<?php echo esc_attr( $key ); ?>" class="mybooking-templates-importer__gl-navigation-link  js-mybooking-templates-importer-nav-link"><?php echo esc_html( $name ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</nav>
					<div clas="mybooking-templates-importer__gl-search">
						<input type="search" class="mybooking-templates-importer__gl-search-input  js-mybooking-templates-importer-gl-search" name="mybooking-templates-importer-gl-search" value="" placeholder="<?php esc_attr_e( 'Search demos...', 'mybooking-templates-importer' ); ?>">
					</div>
				</div>
			<?php endif; ?>
			<div class="mybooking-templates-importer__gl-item-container  wp-clearfix  js-mybooking-templates-importer-gl-item-container">
				<?php foreach ( $predefined_themes as $index => $import_file ) : ?>
					<?php
						// Prepare import item display data.
						$img_src = isset( $import_file['import_preview_image_url'] ) ? $import_file['import_preview_image_url'] : '';
						// Default to the theme screenshot, if a custom preview image is not defined.
						if ( empty( $img_src ) ) {
							$theme = wp_get_theme();
							$img_src = $theme->get_screenshot();
						}

					?>
					<div class="mybooking-templates-importer__gl-item js-mybooking-templates-importer-gl-item" data-categories="<?php echo esc_attr( Helpers::get_demo_import_item_categories( $import_file ) ); ?>" data-name="<?php echo esc_attr( strtolower( $import_file['import_file_name'] ) ); ?>">
						<div class="mybooking-templates-importer__gl-item-image-container">
							<?php if ( ! empty( $img_src ) ) : ?>
								<img class="mybooking-templates-importer__gl-item-image" src="<?php echo esc_url( $img_src ) ?>">
							<?php else : ?>
								<div class="mybooking-templates-importer__gl-item-image  mybooking-templates-importer__gl-item-image--no-image"><?php esc_html_e( 'No preview image.', 'mybooking-templates-importer' ); ?></div>
							<?php endif; ?>
						</div>
						<div class="mybooking-templates-importer__gl-item-footer<?php echo ! empty( $import_file['preview_url'] ) ? '  mybooking-templates-importer__gl-item-footer--with-preview' : ''; ?>">
							<h4 class="mybooking-templates-importer__gl-item-title" title="<?php echo esc_attr( $import_file['import_file_name'] ); ?>"><?php echo esc_html( $import_file['import_file_name'] ); ?></h4>
							<button class="mybooking-templates-importer__gl-item-button  button  button-primary  js-mybooking-templates-importer-gl-import-data" value="<?php echo esc_attr( $index ); ?>"><?php esc_html_e( 'Import', 'mybooking-templates-importer' ); ?></button>
							<?php if ( ! empty( $import_file['preview_url'] ) ) : ?>
								<a class="mybooking-templates-importer__gl-item-button  button" href="<?php echo esc_url( $import_file['preview_url'] ); ?>" target="_blank"><?php esc_html_e( 'Preview', 'mybooking-templates-importer' ); ?></a>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<div id="js-mybooking-templates-importer-modal-content"></div>

	<?php endif; ?>

	<p class="mybooking-templates-importer__ajax-loader  js-mybooking-templates-importer-ajax-loader">
		<span class="spinner"></span> <?php esc_html_e( 'Importing, please wait!', 'mybooking-templates-importer' ); ?>
	</p>

	<div class="mybooking-templates-importer__response  js-mybooking-templates-importer-ajax-response"></div>
</div>

<?php
/**
 * Hook for adding the custom admin page footer
 */
do_action( 'mybooking-templates-importer/plugin_page_footer' );
