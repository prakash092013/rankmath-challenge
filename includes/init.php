<?php 
/**
 * Custom Dashboard Initializaiton
 * 
 */
class CustomDashInit
{
	
	function __construct(){
		// add wp-admin dashboard widget
		add_action( "wp_dashboard_setup", [ $this, "rankmath_inspector_dashboard_setup_callback" ] );

		// Load assets for custom admin dashboard widget
		add_action( "admin_enqueue_scripts", [ $this, "rankmath_inspector_dashboard_enqueue_scripts" ] );

		// custom Rest API end points
		add_action("rest_api_init", [ $this, "rankmath_inspector_dashboard_enpoints" ] );

		// Loading text domain file
		add_action( 'init', [ $this, "rankmath_inspector_dashboard_load_textdomain" ] );

	}

	public function rankmath_inspector_dashboard_load_textdomain() {
		load_plugin_textdomain( 'wpdocs_textdomain', false, CUSTOM_DASH_PLUGIN_PATH . 'languages' ); 
	}

	// callback function to add wp-admin dashboard widget
	public function rankmath_inspector_dashboard_setup_callback(){
	    wp_add_dashboard_widget(
	        "rankmath_inspector_chart_widget",
	        __( 'Rank Math Custom Widget', 'rankmath-inspector' ),
	        [ $this, "rankmath_inspector_dashboard_widget_callback" ]
	    );
	}

	// callback function for dashboard widget template
	public function rankmath_inspector_dashboard_widget_callback(){
  		printf( '<div id="root" class="main"></div>' );
	}

	// callback to load the javascript assets
	public function rankmath_inspector_dashboard_enqueue_scripts( $hook ){

		$JSfiles = scandir( CUSTOM_DASH_PLUGIN_PATH . 'build/static/js/' );
	   	$react_js_to_load = '';
	   	
	   	foreach( $JSfiles as $filename ) {
	   		if( strpos($filename,'.js') && !strpos( $filename,'.js.map' ) ) {
	   			$react_js_to_load = CUSTOM_DASH_PLUGIN_URI . 'build/static/js/' . $filename;
	   		}
	   	}

	   	wp_enqueue_script('rankmath-inspector', $react_js_to_load, '', mt_rand(10,1000), true);
	   	
	   	wp_localize_script('rankmath-inspector', "rankmath_inspector_dashboard", [
	        "urls" => [
	            rest_url("rankmath-inspector/v1/week"),
	            rest_url("rankmath-inspector/v1/half-month"),
	            rest_url("rankmath-inspector/v1/month"),
	        ],
	        "nonce" => wp_create_nonce("wp_rest"),
	    ]);

	    wp_enqueue_style( 'rankmath-inspector', CUSTOM_DASH_PLUGIN_URI . 'assets/css/rankmath-inspector.css' );

	}

	public function rankmath_inspector_dashboard_permissions_check(){
	    return true;
	}

	// Registering custom end points
	public function rankmath_inspector_dashboard_enpoints() {

		// endpoint for weekly chart data
	    register_rest_route("rankmath-inspector/v1", "/week", [
	        "methods" => WP_REST_Server::READABLE,
	        "callback" => [ $this, "rankmath_inspector_weekly_chart_callback"],
	        "permission_callback" => [ $this, "rankmath_inspector_dashboard_permissions_check"],
	    ]);

	    // endpoint for half month chart data
	    register_rest_route("rankmath-inspector/v1", "/half-month", [
	        "methods" => WP_REST_Server::READABLE,
	        "callback" => [ $this, "rankmath_inspector_half_month_chart_callback" ],
	        "permission_callback" => [ $this, "rankmath_inspector_dashboard_permissions_check"],
	    ]);

	    // endpoint for monthly chart data
	    register_rest_route("rankmath-inspector/v1", "/month", [
	        "methods" => WP_REST_Server::READABLE,
	        "callback" => [ $this, "rankmath_inspector_monthly_chart_callback"],
	        "permission_callback" => [ $this, "rankmath_inspector_dashboard_permissions_check"],
	    ]);
	}

	// Enpoint callback for weeky chart data
	public function rankmath_inspector_weekly_chart_callback($request){
	    $chart_data = get_option( '_rm_week_chart' );
		return new WP_REST_RESPONSE(
	        [
	            "success" => true,
	            "pivots" => $chart_data,
	        ],
	        200
	    );
	}

	// Enpoint callback for half month chart data
	public function rankmath_inspector_half_month_chart_callback($request){
	    $chart_data = get_option( '_rm_half_month_chart' );
		return new WP_REST_RESPONSE(
	        [
	            "success" => true,
	            "pivots" => $chart_data,
	        ],
	        200
	    );
	}

	// Enpoint callback for monthly chart data
	public function rankmath_inspector_monthly_chart_callback($request){
	    $chart_data = get_option( '_rm_month_chart' );
		return new WP_REST_RESPONSE(
	        [
	            "success" => true,
	            "pivots" => $chart_data,
	        ],
	        200
	    );
	}

}

new CustomDashInit;