<?php
/**
 * image.php - image viewer class for 402 framework
 */

require_once VIEW_DIR."html_builder.php";

/**
 * load and initialise Image Viewer class for 402 framework
 */
class MapViewer extends BuildHTML {

	//formatted content
	private static $viewer_content;
	//framework images directory
	private static $img_dir = MEDIA_IMAGES_DIR;
	private static $div = "div";
	private static $img = "img";

	/**
	 * return the formatted image view content
	 */
	function get_viewer_content($content, $img_viewer_attributes, $img_attributes) {
		$this->format_map_view($content, $img_viewer_attributes, $img_attributes);
	
		return self::$viewer_content;
	}
	
	function format_map_view($content, $img_viewer_attributes, $img_attributes) {

		$script_attributes = array(
		    "src" => "http://maps.googleapis.com/maps/api/js",
		);
		$script_start = BuildHTML::start_element("script",$script_attributes);
		$script_end = BuildHTML::end_element("script");



		$script2_start = BuildHTML::start_element("script");
		$script2_content = "function initialize() {";
		$script2_content .= "var mapProp = {";
		$script2_content .= "center:new google.maps.LatLng(".$content."),";
		$script2_content .= "zoom:18,";
		$script2_content .= "mapTypeId:google.maps.MapTypeId.ROADMAP";
		$script2_content .= "};";
		$script2_content .= "var map=new google.maps.Map(document.getElementById(\"googleMap\"), mapProp);";
		$script2_content .= "var marker = new google.maps.Marker({";
      	$script2_content .= "position: new google.maps.LatLng(".$content."),";
     	$script2_content .= "map: map";
  		$script2_content .= "});";

		$script2_content .= "}";
		$script2_content .= "google.maps.event.addDomListener(window, 'load', initialize);";
		$script2_end = BuildHTML::end_element("script");


		$div_attributes = array(
		    "id" => "googleMap",
		    "style" => "width:800px;height:580px;",
		);
		$div_start = BuildHTML::start_element(self::$div,$div_attributes);
		$div_end = BuildHTML::end_element(self::$div);

		self::$viewer_content = $script_start.$script_end.$script2_start.$script2_content.$script2_end.$div_start.$div_end;
	}


}
?>