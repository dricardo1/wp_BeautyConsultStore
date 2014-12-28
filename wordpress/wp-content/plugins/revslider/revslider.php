<?php
/*
Plugin Name: Revolution Slider
Plugin URI: http://www.themepunch.com/codecanyon/revolution_wp/
Description: Revolution Slider - Premium responsive slider
Author: ThemePunch
Version: 4.5.01
Author URI: http://themepunch.com
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if(class_exists('RevSliderFront')) {
	die('ERROR: It looks like you have more then one instance of Revolution Slider installed. Please remove additional instances for this plugin to work again.');
}

$revSliderVersion = "4.5.01";
$currentFile = __FILE__;
$currentFolder = dirname($currentFile);

//include frameword files
require_once $currentFolder . '/inc_php/framework/include_framework.php';

//include bases
require_once $folderIncludes . 'base.class.php';
require_once $folderIncludes . 'elements_base.class.php';
require_once $folderIncludes . 'base_admin.class.php';
require_once $folderIncludes . 'base_front.class.php';

//include product files
require_once $currentFolder . '/inc_php/revslider_settings_product.class.php';
require_once $currentFolder . '/inc_php/revslider_globals.class.php';
require_once $currentFolder . '/inc_php/revslider_operations.class.php';
require_once $currentFolder . '/inc_php/revslider_slider.class.php';
require_once $currentFolder . '/inc_php/revslider_output.class.php';
require_once $currentFolder . '/inc_php/revslider_slide.class.php';
require_once $currentFolder . '/inc_php/revslider_widget.class.php';
require_once $currentFolder . '/inc_php/revslider_params.class.php';

require_once $currentFolder . '/inc_php/revslider_tinybox.class.php';

require_once $currentFolder . '/inc_php/fonts.class.php'; //punchfonts



try{
	
	//register the revolution slider widget
	UniteFunctionsWPRev::registerWidget("RevSlider_Widget");

	//add shortcode
	function rev_slider_shortcode($args){

        extract(shortcode_atts(array('alias' => ''), $args, 'rev_slider'));
        $sliderAlias = ($alias != '') ? $alias : UniteFunctionsRev::getVal($args,0);
		
		ob_start();
		$slider = RevSliderOutput::putSlider($sliderAlias);
		$content = ob_get_contents();
		ob_clean();
		ob_end_clean();
		
		// Do not output Slider if we are on mobile
		$disable_on_mobile = $slider->getParam("disable_on_mobile","off");
		if($disable_on_mobile == 'on'){
			$mobile = strstr($_SERVER['HTTP_USER_AGENT'],'Android') || strstr($_SERVER['HTTP_USER_AGENT'],'webOS') || strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') ||strstr($_SERVER['HTTP_USER_AGENT'],'iPod') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad') ? true : false;
			
			if($mobile)
				return false;
		}
		
		//handle slider output types
		if(!empty($slider)){
			$outputType = $slider->getParam("output_type","");
			switch($outputType){
				case "compress":
					$content = str_replace("\n", "", $content);
					$content = str_replace("\r", "", $content);
					return($content);
				break;
				case "echo":
					echo $content;		//bypass the filters
				break;
				default:
					return($content);
				break;
			}
		}else
			return($content);		//normal output

	}

	add_shortcode( 'rev_slider', 'rev_slider_shortcode' );

	//add tiny box dropdown menu
	$tinybox = new RevSlider_TinyBox();



	if(is_admin()){		//load admin part
	
		require_once $currentFolder . '/inc_php/framework/update.class.php';

		require_once $currentFolder."/revslider_admin.php";

		$productAdmin = new RevSliderAdmin($currentFile);

	}else{		//load front part

		/**
		 *
		 * put rev slider on the page.
		 * the data can be slider ID or slider alias.
		 */
		function putRevSlider($data,$putIn = ""){
			$operations = new RevOperations();
			$arrValues = $operations->getGeneralSettingsValues();
			$includesGlobally = UniteFunctionsRev::getVal($arrValues, "includes_globally","on");
			$strPutIn = UniteFunctionsRev::getVal($arrValues, "pages_for_includes");
			$isPutIn = RevSliderOutput::isPutIn($strPutIn,true);

			if($isPutIn == false && $includesGlobally == "off"){
				$output = new RevSliderOutput();
				$option1Name = "Include RevSlider libraries globally (all pages/posts)";
				$option2Name = "Pages to include RevSlider libraries";
				$output->putErrorMessage(__("If you want to use the PHP function \"putRevSlider\" in your code please make sure to check \" ",REVSLIDER_TEXTDOMAIN).$option1Name.__(" \" in the backend's \"General Settings\" (top right panel). <br> <br> Or add the current page to the \"",REVSLIDER_TEXTDOMAIN).$option2Name.__("\" option box."));
				return(false);
			}

			RevSliderOutput::putSlider($data,$putIn);
		}


		/**
		 *
		 * put rev slider on the page.
		 * the data can be slider ID or slider alias.
		 */
		function checkRevSliderExists($alias){
            $rev = new RevSlider();
            return $rev->isAliasExists($alias);
		}

		require_once $currentFolder."/revslider_front.php";
		$productFront = new RevSliderFront($currentFile);
	}
	
}catch(Exception $e){
	$message = $e->getMessage();
	$trace = $e->getTraceAsString();
	echo _e("Revolution Slider Error:",REVSLIDER_TEXTDOMAIN)."<b>".$message."</b>";
}
