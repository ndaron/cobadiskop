<?php
function beritaxx_customize_color( $wp_customize ) {
	$wp_customize->add_setting( 'beritaxx_body_background' , array(
    'default'     => "#eeeeee",
    'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 'beritaxx_body_background', array(
        'label'        => __( 'Global Color', 'beritaxx' ),
		'description'        => __( 'Global Background', 'beritaxx' ),
        'section'    => 'colors',
		)
	)
);
$wp_customize->add_setting( 'beritaxx_wrapper_background' , array(
    'default'     => "#ffffff",
    'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 'beritaxx_wrapper_background', array(
        'description'        => __( 'Container Background', 'beritaxx' ),
        'section'    => 'colors',
		)
	)
);
$wp_customize->add_setting( 'beritaxx_body_color' , array(
    'default'     => "#222222",
    'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 'beritaxx_body_color', array(
        'description'        => __( 'Global Color', 'beritaxx' ),
        'section'    => 'colors',
		)
	)
);
$wp_customize->add_setting( 'beritaxx_body_secondcolor' , array(
    'default'     => "#777777",
    'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 'beritaxx_body_secondcolor', array(
        'description'        => __( 'Second Color', 'beritaxx' ),
        'section'    => 'colors',
		)
	)
);
$wp_customize->add_setting( 'beritaxx_body_linkcolor' , array(
    'default'     => "#222222",
    'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 'beritaxx_body_linkcolor', array(
        'description'        => __( 'Link Color', 'beritaxx' ),
        'section'    => 'colors',
		)
	)
);

$wp_customize->add_setting( 'beritaxx_body_aksen1' , array(
    'default'     => "#dd3333",
    'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 'beritaxx_body_aksen1', array(
        'description'        => __( 'Aksen1 Color', 'beritaxx' ),
        'section'    => 'colors',
		)
	)
);
$wp_customize->add_setting( 'beritaxx_body_aksen2' , array(
    'default'     => "#2299aa",
    'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 'beritaxx_body_aksen2', array(
        'description'        => __( 'Aksen2 Color', 'beritaxx' ),
        'section'    => 'colors',
		)
	)
);

$wp_customize->add_setting( 'beritaxx_header_background' , array(
    'default'     => "#ffffff",
    'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 'beritaxx_header_background', array(
        'label'        => __( 'Header Color', 'beritaxx' ),
		'description'        => __( 'Header Background', 'beritaxx' ),
        'section'    => 'colors',
		)
	)
);
$wp_customize->add_setting( 'beritaxx_header_color' , array(
    'default'     => "#222222",
    'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 'beritaxx_header_color', array(
		'description'        => __( 'Header Color', 'beritaxx' ),
        'section'    => 'colors',
		)
	)
);

$wp_customize->add_setting( 'beritaxx_search_background' , array(
    'default'     => "#f7f7f7",
    'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 'beritaxx_search_background', array(
	    'label'        => __( 'Search Color', 'beritaxx' ),
		'description'        => __( 'Search Color', 'beritaxx' ),
        'section'    => 'colors',
		)
	)
);
$wp_customize->add_setting( 'beritaxx_search_border' , array(
    'default'     => "#dddddd",
    'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 'beritaxx_search_border', array(
		'description'        => __( 'Search Border', 'beritaxx' ),
        'section'    => 'colors',
		)
	)
);
$wp_customize->add_setting( 'beritaxx_search_color' , array(
    'default'     => "#555555",
    'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 'beritaxx_search_color', array(
		'description'        => __( 'Search Input Color', 'beritaxx' ),
        'section'    => 'colors',
		)
	)
);

$wp_customize->add_setting( 'beritaxx_menu_color' , array(
    'default'     => "#222222",
    'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 'beritaxx_menu_color', array(
	    'label'        => __( 'Menu Color', 'beritaxx' ),
		'description'        => __( 'Link Color', 'beritaxx' ),
        'section'    => 'colors',
		)
	)
);
$wp_customize->add_setting( 'beritaxx_menu_color1' , array(
    'default'     => "#dd3333",
    'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 'beritaxx_menu_color1', array(
		'description'        => __( 'Link Aksen 1 Color', 'beritaxx' ),
        'section'    => 'colors',
		)
	)
);
$wp_customize->add_setting( 'beritaxx_menu_color2' , array(
    'default'     => "#2299aa",
    'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 'beritaxx_menu_color2', array(
		'description'        => __( 'Link Aksen 2 Color', 'beritaxx' ),
        'section'    => 'colors',
		)
	)
);


$wp_customize->add_setting( 'beritaxx_taxxfooter_background' , array(
    'default'     => "#eeeeee",
    'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 'beritaxx_taxxfooter_background', array(
	    'label'        => __( 'Footer Color', 'beritaxx' ),
		'description'        => __( 'Outer Background', 'beritaxx' ),
        'section'    => 'colors',
		)
	)
);
$wp_customize->add_setting( 'beritaxx_footer_background' , array(
    'default'     => "#111111",
    'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 'beritaxx_footer_background', array(
		'description'        => __( 'Block Background', 'beritaxx' ),
        'section'    => 'colors',
		)
	)
);
$wp_customize->add_setting( 'beritaxx_footer_textcolor' , array(
    'default'     => "#f7f7f7",
    'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 'beritaxx_footer_textcolor', array(
		'description'        => __( 'Text Color', 'beritaxx' ),
        'section'    => 'colors',
		)
	)
);
$wp_customize->add_setting( 'beritaxx_footer_linkcolor' , array(
    'default'     => "#dddddd",
    'transport'   => 'refresh',
	'sanitize_callback' => 'wp_kses_post'
));
$wp_customize->add_control( new WP_Customize_Color_Control( 
    $wp_customize, 'beritaxx_footer_linkcolor', array(
		'description'        => __( 'Link Color', 'beritaxx' ),
        'section'    => 'colors',
		)
	)
);



}
add_action( 'customize_register', 'beritaxx_customize_color', 11 );

function beritaxx_customize_css() {
    ?>
    <style type="text/css">
        body { 
	    	background: <?php echo esc_html( get_theme_mod('beritaxx_body_background', "#eeeeee") ); ?>; 
			color: <?php echo esc_html( get_theme_mod('beritaxx_body_color', "#222222") ); ?>; 
		}
		.taxxnews,
		#header-one .area_secondary { 
	    	background: <?php echo esc_html( get_theme_mod('beritaxx_wrapper_background', "#ffffff") ); ?>; 
		}
		.taxxnews a { 
	    	color: <?php echo esc_html( get_theme_mod('beritaxx_body_linkcolor', "#222222") ); ?>; 
		}
		.list_after,
		.time_mini,
		.popular_list_after,
		.latest_after,
		.rel_post span,
		.time_view span,
		.after_title,
		.nav_breadcrumb i,
		.classic_time_mini,
		.classic_after,
		.block_time_mini,
		.block_after { 
	    	color: <?php echo esc_html( get_theme_mod('beritaxx_body_secondcolor', "#777777") ); ?>; 
		}
		.com_mini i,
		.after_title i { 
	    	color: <?php echo esc_html( get_theme_mod('beritaxx_body_aksen1', "#dd3333") ); ?>; 
		}
		.user_mini i,
		.after_title .fa-user-circle,
		.bio_name i { 
	    	color: <?php echo esc_html( get_theme_mod('beritaxx_body_aksen2', "#2299aa") ); ?>; 
		}
		.bio_social i {
			color: <?php echo esc_html( get_theme_mod('beritaxx_body_aksen2', "#2299aa") ); ?>; 
			border: 1px solid <?php echo esc_html( get_theme_mod('beritaxx_body_aksen2', "#2299aa") ); ?>; 
		}
		.header,
		#header-one .taxx_search,
		.taxx_search.mobile_search,
		#header-one .nav .dd.desktop li ul,
		#header-one .nav .dd.desktop ul li ul,
		#header-one .taxx_flat_menu { 
	    	background: <?php echo esc_html( get_theme_mod('beritaxx_header_background', "#ffffff") ); ?>; 
		}
		.header,
		.header .taxx_social i,
		.slider:before { 
	    	color: <?php echo esc_html( get_theme_mod('beritaxx_header_color', "#222222") ); ?>; 
		}
		.taxx_mobmenu {
			border: 1px solid <?php echo esc_html( get_theme_mod('beritaxx_header_color', "#222222") ); ?>; 
		}
		.oc_search span:after {
			border: 2px solid <?php echo esc_html( get_theme_mod('beritaxx_header_color', "#222222") ); ?>; 
		}
		.oc_search span:before {
			background: <?php echo esc_html( get_theme_mod('beritaxx_header_color', "#222222") ); ?>; 
		}
		.taxx_form_search { 
	    	background: <?php echo esc_html( get_theme_mod('beritaxx_search_background', "#f7f7f7") ); ?>; 
			border: 1px solid <?php echo esc_html( get_theme_mod('beritaxx_search_border', "#dddddd") ); ?>;
		}
		.taxx_input input[type="text"] { 
		    background: <?php echo esc_html( get_theme_mod('beritaxx_search_background', "#f7f7f7") ); ?>; 
	    	color: <?php echo esc_html( get_theme_mod('beritaxx_search_color', "#555555") ); ?>; 
		}
		.taxx_button i { 
	    	color: <?php echo esc_html( get_theme_mod('beritaxx_search_color', "#555555") ); ?>; 
		}
		.nav .dd.desktop li a,
		.nav .dd.desktop ul li a,
		.nav .dd.accord li.span1 li a,
		.nav .dd.accord li.span2 li a,
		#header-one .nav .dd.desktop ul li a {
			color: <?php echo esc_html( get_theme_mod('beritaxx_menu_color', "#222222") ); ?>; 
		}
		.nav .dd.desktop li.span1 a,
		.nav .dd.accord li.span1 a {
			color: <?php echo esc_html( get_theme_mod('beritaxx_menu_color1', "#dd3333") ); ?>; 
		}
		#header-one .nav .dd.desktop li.menu-item-has-children:after,
		#header-one .nav .dd.desktop li ul li.menu-item-has-children:after,
		#header-one .nav .dd.accord li.menu-item-has-children:after {
			background: <?php echo esc_html( get_theme_mod('beritaxx_menu_color1', "#dd3333") ); ?>; 
		}
		#header-one .nav .dd.desktop li ul {
			border-top: 3px solid <?php echo esc_html( get_theme_mod('beritaxx_menu_color1', "#dd3333") ); ?>; 
		}
		#header-one .nav .dd.accord li ul {
			border-top: 1px solid <?php echo esc_html( get_theme_mod('beritaxx_menu_color1', "#dd3333") ); ?>; 
		}
		.nav .dd.desktop li.span2 a,
		.nav .dd.accord li.span2 a {
			color: <?php echo esc_html( get_theme_mod('beritaxx_menu_color2', "#2299aa") ); ?>; 
		}
		.beritaxx_tags a {
			color: <?php echo esc_html( get_theme_mod('beritaxx_body_linkcolor', "#222222") ); ?>; 
			border: 1px solid <?php echo esc_html( get_theme_mod('beritaxx_body_aksen2', "#2299aa") ); ?>;
		}
		.comment-form #submit,
		.comment__meta .comment-reply-link {
			background: <?php echo esc_html( get_theme_mod('beritaxx_wrapper_background', "#ffffff") ); ?>; 
			color: <?php echo esc_html( get_theme_mod('beritaxx_body_linkcolor', "#222222") ); ?>; 
			border: 1px solid <?php echo esc_html( get_theme_mod('beritaxx_body_aksen2', "#2299aa") ); ?>;
		}
		.pagination a.active {
			color: <?php echo esc_html( get_theme_mod('beritaxx_wrapper_background', "#ffffff") ); ?>; 
			background: <?php echo esc_html( get_theme_mod('beritaxx_body_linkcolor', "#222222") ); ?>; 
		}
		.widget_block h4.post_feat_head,
		.fbo_latest,
		.cat_head_one,
		.open_sidebar {
			color: <?php echo esc_html( get_theme_mod('beritaxx_wrapper_background', "#ffffff") ); ?>; 
			background: <?php echo esc_html( get_theme_mod('beritaxx_body_aksen1', "#222222") ); ?>; 
		}
		.berlin_block .com_mini {
			color: <?php echo esc_html( get_theme_mod('beritaxx_wrapper_background', "#ffffff") ); ?>; 
			background: <?php echo esc_html( get_theme_mod('beritaxx_body_aksen2', "#dd3333") ); ?>; 
		}
		.berlin_block .com_mini i {
			color: <?php echo esc_html( get_theme_mod('beritaxx_wrapper_background', "#ffffff") ); ?>; 
		}
		.fto_number {
			color: <?php echo esc_html( get_theme_mod('beritaxx_body_aksen2', "#dd3333") ); ?>;
		}
		.amsterdam_block {
			border-top: 2px solid <?php echo esc_html( get_theme_mod('beritaxx_body_aksen2', "#dd3333") ); ?>;
		}
		.paris_block .item {
			border-top: 2px solid <?php echo esc_html( get_theme_mod('beritaxx_body_aksen2', "#dd3333") ); ?>;
			border-bottom: 2px solid <?php echo esc_html( get_theme_mod('beritaxx_body_aksen2', "#dd3333") ); ?>;
		}
		.cat_head span {
			background: <?php echo esc_html( get_theme_mod('beritaxx_wrapper_background', "#ffffff") ); ?>;
		}
		.cat_head:after {
			border-bottom: 1px solid <?php echo esc_html( get_theme_mod('beritaxx_body_aksen2', "#dd3333") ); ?>;
		}
		.taxxfooter {
			background: <?php echo esc_html( get_theme_mod('beritaxx_taxxfooter_background', "#eeeeee") ); ?>; 
		}
		.footer {
			background: <?php echo esc_html( get_theme_mod('beritaxx_footer_background', "#111111") ); ?>; 
			color: <?php echo esc_html( get_theme_mod('beritaxx_footer_textcolor', "#f7f7f7") ); ?>; 
		}
		.footer a {
			color: <?php echo esc_html( get_theme_mod('beritaxx_footer_linkcolor', "#dddddd") ); ?>; 
		}
    </style>
    <?php
}
add_action( 'wp_head', 'beritaxx_customize_css');