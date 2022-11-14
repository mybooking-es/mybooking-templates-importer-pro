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

<div class="mybooking-templates-importer  wrap  about-wrap">

	<?php ob_start(); ?>
		<h1 class="mybookingTemplatesImporter__title"><?php esc_html_e( 'Mybooking Templates Importer', 'mybooking-templates-importer' ); ?></h1>
	<?php
	$plugin_title = ob_get_clean();

	// Display the plugin title (can be replaced with custom title text through the filter below).
	echo wp_kses_post( apply_filters( 'mybooking-templates-importer/plugin_page_title', $plugin_title ) );

	// Display warrning if PHP safe mode is enabled, since we wont be able to change the max_execution_time.
	if ( ini_get( 'safe_mode' ) ) {
		printf(
			esc_html__( '%sWarning: your server is using %sPHP safe mode%s. This means that you might experience server timeout errors.%s', 'mybooking-templates-importer' ),
			'<div class="notice  notice-warning  is-dismissible"><p>',
			'<strong>',
			'</strong>',
			'</p></div>'
		);
	}

	// Start output buffer for displaying the plugin intro text.
	ob_start();
	?>

	<div class="mybookingTemplatesImporter__intro-text">
		<p class="about-description">
			<?php echo wp_kses_post( 'This is an <b>utility</b> to create a reservation website with <u>mybooking theme</u> and <u>mybooking reservation engine plugin</u>.', 'mybooking-templates-importer' ); ?>
			<?php esc_html_e( 'It creates the reservation process, contact, terms and conditions and legal pages. It also setup the menus and the widgets to create a working site.', 'mybooking-templates-importer' ); ?>
		</p>
		<p><b><?php esc_html_e( 'Required plugins:', 'mybooking-templates-importer' ); ?></b></p>
		<ul>
			<li><?php esc_html_e( 'MyBooking Reservation Engine', 'mybooking-templates-importer' ); ?></li>
			<li><?php esc_html_e( 'Elementor', 'mybooking-templates-importer' ); ?></li>
		</ul>
		<p><b><?php esc_html_e( 'Required theme:', 'mybooking-templates-importer' ); ?></b></p>
		<ul>
			<li><?php esc_html_e( 'MyBooking', 'mybooking-templates-importer' ); ?></li>
		</ul>

		<hr>

		<p><?php esc_html_e( 'When you import the data, the following things might happen:', 'mybooking-templates-importer' ); ?></p>

		<ul>
			<li><?php esc_html_e( 'No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified.', 'mybooking-templates-importer' ); ?></li>
			<li><?php esc_html_e( 'Posts, pages, images, widgets, menus and other theme settings will get imported.', 'mybooking-templates-importer' ); ?></li>
			<li><?php esc_html_e( 'Please click on the Import button only once and wait, it can take a couple of minutes.', 'mybooking-templates-importer' ); ?></li>
		</ul>

		<hr>
	</div>

	<?php
	$plugin_intro_text = ob_get_clean();

	// Display the plugin intro text (can be replaced with custom text through the filter below).
	echo wp_kses_post( apply_filters( 'mybooking-templates-importer/plugin_intro_text', $plugin_intro_text ) );
	?>

	<p> 
		<?php esc_html_e( 'Select one of the following templates:', 'mybooking-templates-importer' ); ?>
	</p>

	<?php if ( 1 === count( $predefined_themes ) ) : ?>

			<div class="mybookingTemplatesImporter__gl-item-container  wp-clearfix  js-mybooking-templates-importer-gl-item-container">
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
					<div class="mybookingTemplatesImporter__gl-item js-mybooking-templates-importer-gl-item" data-categories="<?php echo esc_attr( Helpers::get_demo_import_item_categories( $import_file ) ); ?>" 
						                                       data-name="<?php echo esc_attr( strtolower( $import_file['import_file_name'] ) ); ?>">
						<div class="mybookingTemplatesImporter__gl-item-image-container">
							<?php if ( ! empty( $img_src ) ) : ?>
								<img class="mybookingTemplatesImporter__gl-item-image" src="<?php echo esc_url( $img_src ) ?>">
							<?php else : ?>
								<div class="mybookingTemplatesImporter__gl-item-image  mybookingTemplatesImporter__gl-item-image--no-image"><?php esc_html_e( 'No preview image.', 'mybooking-templates-importer' ); ?></div>
							<?php endif; ?>
						</div>
						<div class="mybookingTemplatesImporter__gl-item-footer<?php echo ! empty( $import_file['preview_url'] ) ? '  mybookingTemplatesImporter__gl-item-footer--with-preview' : ''; ?>">
							<h4 class="mybookingTemplatesImporter__gl-item-title" title="<?php echo esc_attr( $import_file['import_file_name'] ); ?>"><?php echo esc_html( $import_file['import_file_name'] ); ?></h4>
							<button class="mybookingTemplatesImporter__gl-item-button  button  button-primary  js-mybooking-templates-importer-gl-import-data" value="<?php echo esc_attr( $index ); ?>"><?php esc_html_e( 'Import', 'mybooking-templates-importer' ); ?></button>
							<?php if ( ! empty( $import_file['preview_url'] ) ) : ?>
								<a class="mybookingTemplatesImporter__gl-item-button  button" href="<?php echo esc_url( $import_file['preview_url'] ); ?>" target="_blank"><?php esc_html_e( 'Preview', 'mybooking-templates-importer' ); ?></a>
							<?php endif; ?>
						</div>
					</div>
			</div>
			<div id="js-mybooking-templates-importer-modal-content"></div>

	<?php elseif ( count( $predefined_themes ) > 1 ) : ?>

		<!-- MybookingTemplatesImporter grid layout -->
		<div class="mybookingTemplatesImporter__gl  js-mybooking-templates-importer-gl">
		<?php
			// Prepare navigation data.
			$categories = Helpers::get_all_demo_import_categories( $predefined_themes );
		?>
			<?php if ( ! empty( $categories ) ) : ?>
				<div class="mybookingTemplatesImporter__gl-header  js-mybooking-templates-importer-gl-header">
					<nav class="mybookingTemplatesImporter__gl-navigation">
						<ul>
							<li class="active"><a href="#all" class="mybookingTemplatesImporter__gl-navigation-link  js-mybooking-templates-importer-nav-link"><?php esc_html_e( 'All', 'mybooking-templates-importer' ); ?></a></li>
							<?php foreach ( $categories as $key => $name ) : ?>
								<li><a href="#<?php echo esc_attr( $key ); ?>" class="mybookingTemplatesImporter__gl-navigation-link  js-mybooking-templates-importer-nav-link"><?php echo esc_html( $name ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</nav>
					<div clas="mybookingTemplatesImporter__gl-search">
						<input type="search" class="mybookingTemplatesImporter__gl-search-input  js-mybooking-templates-importer-gl-search" name="mybooking-templates-importer-gl-search" value="" placeholder="<?php esc_attr_e( 'Search demos...', 'mybooking-templates-importer' ); ?>">
					</div>
				</div>
			<?php endif; ?>
			<div class="mybookingTemplatesImporter__gl-item-container  wp-clearfix  js-mybooking-templates-importer-gl-item-container">
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
					<div class="mybookingTemplatesImporter__gl-item js-mybooking-templates-importer-gl-item" data-categories="<?php echo esc_attr( Helpers::get_demo_import_item_categories( $import_file ) ); ?>" data-name="<?php echo esc_attr( strtolower( $import_file['import_file_name'] ) ); ?>">
						<div class="mybookingTemplatesImporter__gl-item-image-container">
							<?php if ( ! empty( $img_src ) ) : ?>
								<img class="mybookingTemplatesImporter__gl-item-image" src="<?php echo esc_url( $img_src ) ?>">
							<?php else : ?>
								<div class="mybookingTemplatesImporter__gl-item-image  mybookingTemplatesImporter__gl-item-image--no-image"><?php esc_html_e( 'No preview image.', 'mybooking-templates-importer' ); ?></div>
							<?php endif; ?>
						</div>
						<div class="mybookingTemplatesImporter__gl-item-footer<?php echo ! empty( $import_file['preview_url'] ) ? '  mybookingTemplatesImporter__gl-item-footer--with-preview' : ''; ?>">
							<h4 class="mybookingTemplatesImporter__gl-item-title" title="<?php echo esc_attr( $import_file['import_file_name'] ); ?>"><?php echo esc_html( $import_file['import_file_name'] ); ?></h4>
							<button class="mybookingTemplatesImporter__gl-item-button  button  button-primary  js-mybooking-templates-importer-gl-import-data" value="<?php echo esc_attr( $index ); ?>"><?php esc_html_e( 'Import', 'mybooking-templates-importer' ); ?></button>
							<?php if ( ! empty( $import_file['preview_url'] ) ) : ?>
								<a class="mybookingTemplatesImporter__gl-item-button  button" href="<?php echo esc_url( $import_file['preview_url'] ); ?>" target="_blank"><?php esc_html_e( 'Preview', 'mybooking-templates-importer' ); ?></a>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<div id="js-mybooking-templates-importer-modal-content"></div>

	<?php endif; ?>

	<p class="mybookingTemplatesImporter__ajax-loader  js-mybooking-templates-importer-ajax-loader">
		<span class="spinner"></span> <?php esc_html_e( 'Importing, please wait!', 'mybooking-templates-importer' ); ?>
	</p>

	<div class="mybookingTemplatesImporter__response  js-mybooking-templates-importer-ajax-response"></div>
</div>

<?php
/**
 * Hook for adding the custom admin page footer
 */
do_action( 'mybooking-templates-importer/plugin_page_footer' );
