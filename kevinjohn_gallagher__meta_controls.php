<?php
/*
	Plugin Name: 			Kevinjohn Gallagher: Pure Web Brilliant's Meta Controls
	Description: 			Removes the need for meta tags to be hardcoded into themes. 
	Version: 				2.3
	Author: 				Kevinjohn Gallagher
	Author URI: 			http://kevinjohngallagher.com/
	
	Contributors:			kevinjohngallagher, purewebbrilliant 
	Donate link:			http://kevinjohngallagher.com/
	Tags: 					kevinjohn gallagher, pure web brilliant, framework, cms, simple, multisite, 
	Requires at least:		3.0
	Tested up to: 			3.4
	Stable tag: 			2.3
*/
/**
 *
 *	Kevinjohn Gallagher: Pure Web Brilliant's Meta Controls
 * =============================================================
 *
 *	Removes the need for meta tags to be hardcoded into themes. 
 *
 *
 *	This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 *	General Public License as published by the Free Software Foundation; either version 3 of the License, 
 *	or (at your option) any later version.
 *
 * 	This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; 
 *	without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 *	See the GNU General Public License (http://www.gnu.org/licenses/gpl-3.0.txt) for more details.
 *
 *	You should have received a copy of the GNU General Public License along with this program.  
 * 	If not, see http://www.gnu.org/licenses/ or http://www.gnu.org/licenses/gpl-3.0.txt
 *
 *
 *	Copyright (C) 2008-2012 Kevinjohn Gallagher / http://www.kevinjohngallagher.com
 *
 *
 *	@package				Pure Web Brilliant
 *	@version 				2.3
 *	@author 				Kevinjohn Gallagher <wordpress@kevinjohngallagher.com>
 *	@copyright 				Copyright (c) 2012, Kevinjohn Gallagher
 *	@link 					http://kevinjohngallagher.com
 *	@license 				http://www.gnu.org/licenses/gpl-3.0.txt
 *
 *
 */
 

 	if ( ! defined( 'ABSPATH' ) )
 	{ 
 			die( 'Direct access not permitted.' ); 
 	}
 	
 	
 	




	define( '_KEVINJOHN_GALLAGHER___meta_controls', '2.3' );



	if (class_exists('kevinjohn_gallagher')) 
	{
		
		
		class	kevinjohn_gallagher___meta_controls 
		extends kevinjohn_gallagher
		{
		
				/*
				**
				**		VARIABLES
				**
				*/
				const PM		=	'_kevinjohn_gallagher___meta_controls';
				
				
				var					$instance;
				var 				$plugin_name;
				var					$uniqueID;
				var					$plugin_dir;
				var					$plugin_url;
				var					$plugin_page_title; 
				var					$plugin_menu_title; 					
				var 				$plugin_slug;
				var 				$http_or_https;
				var 				$plugin_options;

				var 				$core_jquery_version;
				var 				$jquery_new_url;
				var 				$jquery_mobile_url;
				
		
				/*
				**
				**		CONSTRUCT
				**
				*/
				public	function	__construct() 
				{
						$this->instance											=	&$this;
						$this->uniqueID 										=	self::PM;
						$this->plugin_dir										=	plugin_dir_path(__FILE__);	
						$this->plugin_url										=	plugin_dir_url(__FILE__);							
						$this->plugin_name										=	"Kevinjohn Gallagher: Pure Web Brilliant's meta controls";
						$this->plugin_page_title								=	"meta control"; 
						$this->plugin_menu_title								=	"meta control"; 					
						$this->plugin_slug										=	"meta-control";
						
						
						add_action( 'init',				array( $this, 'init' ) );
						add_action( 'init',				array( $this, 'init_child' ) );
						add_action(	'admin_init',		array( $this, 'admin_init_register_settings'), 100);
					//	add_action( 'admin_menu',		array( $this, 'add_plugin_to_menu'));
												
				}
				
				
				
				
				/*
				**
				**		INIT_CHILD
				**
				*/
			
				public function init_child() 
				{
			
				
						add_action(	'wp_head',									array( $this,	'wp_head_meta_controls'), 100);

				}
				


				public 	function 	define_child_settings_sections()
				{
					//	$this->child_settings_sections['section_web']					= ' Web: ';
						$this->child_settings_sections['section_mobile'] 				= ' Mobile:';
					//	$this->child_settings_sections['section_windows'] 				= ' Windows:';
						$this->child_settings_sections['section_chrome_frame']			= ' Chrome Frame for IE: ';
					//	$this->child_settings_sections['section_seo'] 					= ' Search Engines:';						
					//	$this->child_settings_sections['section_robots'] 				= ' Robots:';
						$this->child_settings_sections['section_extras'] 				= ' Extras:';
				}


				public 	function 	define_child_settings_array()
				{		
						
						$this->child_settings_array['chrome_frame'] = array(
																				'id'      		=> 'chrome_frame',
																				'title'   		=> 'Chrome Frame:',
																				'description'	=> 'This allows users of older browsers with the Chrome Frame extention installed to view the site as if in the latest version of google\'s Chrome browser. This is especially handy for those in IE6/7.',
																				'type'    		=> 'checkbox',
																				'section' 		=> 'section_chrome_frame',
																				'choices' 		=> array(
																									),
																				'class'   		=> ''
																			);					


//Mobile
						/*
						
						$this->child_settings_array['mobile_debug'] = array(
																				'id'      		=> 'mobile_debug',
																				'title'   		=> 'Debug',
																				'description'	=> 'This displays the meta tags even when not a mobile device. ',
																				'type'    		=> 'radio',
																				'section' 		=> 'section_mobile',
																				'choices' 		=> array(
																											'1'	=>	'On',
																											'0'	=>	'Off'
																									),
																				'class'   		=> ''
																			);
						*/					


						$this->child_settings_array['mobile_optomized'] = array(
																				'id'      		=> 'mobile_optomized',
																				'title'   		=> 'Mobile Optomized',
																				'description'	=> ' ',
																				'type'    		=> 'select',
																				'section' 		=> 'section_mobile',
																				'choices' 		=> array(
																											'0'			=>	' == Do not use == ',
																											'width'		=>	'width',
																											'height'	=>	'height',
																											'both'		=>	'Width & height'
																									),
																				'class'   		=> ''
																			);					

						$this->child_settings_array['mobile_handheld'] = array(
																				'id'      		=> 'mobile_handheld',
																				'title'   		=> 'Handheld friendly',
																				'description'	=> '',
																				'type'    		=> 'select',
																				'section' 		=> 'section_mobile',
																				'choices' 		=> array(
																											'0'			=>	' == Do not use == ',
																											'yes'		=>	'True',
																											'no'		=>	'False'																									),
																				'class'   		=> ''
																			);					


//	<meta http-equiv="cleartype

						$this->child_settings_array['mobile_telephone'] = array(
																				'id'      		=> 'mobile_telephone',
																				'title'   		=> 'Telephone',
																				'description'	=> ' This makes phone numbers "click to call".',
																				'type'    		=> 'select',
																				'section' 		=> 'section_mobile',
																				'choices' 		=> array(
																											'0'			=>	' == Do not use == ',
																											'yes'		=>	'Yes',
																											'no'		=>	'No'
																									),
																				'class'   		=> ''
																			);					


						$this->child_settings_array['mobile_web_app_capable'] = array(
																				'id'      		=> 'mobile_web_app_capable',
																				'title'   		=> 'Apple: Web App capable',
																				'description'	=> ' ',
																				'type'    		=> 'select',
																				'section' 		=> 'section_mobile',
																				'choices' 		=> array(
																											'0'			=>	' == Do not use == ',
																											'yes'		=>	'Yes',
																											'no'		=>	'No'
																									),
																				'class'   		=> ''
																			);					

						$this->child_settings_array['mobile_web_app_style'] = array(
																				'id'      		=> 'mobile_web_app_style',
																				'title'   		=> 'Apple: Web App bar style',
																				'description'	=> ' ',
																				'type'    		=> 'select',
																				'section' 		=> 'section_mobile',
																				'choices' 		=> array(
																											'0'			=>	' == Do not use == ',
																											'white'		=>	' White',
																											'black'		=>	' Black',
																											'trans'		=>	' Translucent'
																									),
																				'class'   		=> ''
																			);					


						$this->child_settings_array['mobile_cleartype'] = array(
																				'id'      		=> 'mobile_cleartype',
																				'title'   		=> 'Cleartype',
																				'description'	=> ' ',
																				'type'    		=> 'select',
																				'section' 		=> 'section_mobile',
																				'choices' 		=> array(
																											'0'			=>	' == Do not use == ',
																											'yes'		=>	' Yes',
																											'no'		=>	' No'
																									),
																				'class'   		=> ''
																			);					


						$this->child_settings_array['viewport_width'] = array(
																				'id'      		=> 'viewport_width',
																				'title'   		=> 'Viewport: width',
																				'description'	=> ' ',
																				'type'    		=> 'select',
																				'section' 		=> 'section_mobile',
																				'choices' 		=> array(
																											'0'			=>	' == Do not use == ',
																											'device'	=>	' device-width ',
																											'240'		=>	' 240px',
																											'340'		=>	' 340px',
																											'480'		=>	' 480px',
																											'600'		=>	' 600px',
																											'760'		=>	' 760px',
																											'980'		=>	' 980px'
																									),
																				'class'   		=> ''
																			);					


						$this->child_settings_array['viewport_height'] = array(
																				'id'      		=> 'viewport_height',
																				'title'   		=> 'Viewport: height',
																				'description'	=> ' ',
																				'type'    		=> 'select',
																				'section' 		=> 'section_mobile',
																				'choices' 		=> array(
																											'0'			=>	' == Do not use == ',
																											'device'	=>	' device-height ',
																											'480'		=>	' 480px',
																											'760'		=>	' 760px',
																											'980'		=>	' 980px'
																									),
																				'class'   		=> ''
																			);					



						$this->child_settings_array['viewport_usr_scale'] = array(
																				'id'      		=> 'viewport_usr_scale',
																				'title'   		=> 'Viewport: user scalable',
																				'description'	=> ' ',
																				'type'    		=> 'select',
																				'section' 		=> 'section_mobile',
																				'choices' 		=> array(
																											'0'			=>	' == Do not use == ',
																											'yes'	=>	' yes ',
																											'no'	=>	' no '
																									),
																				'class'   		=> ''
																			);					




						$this->child_settings_array['viewport_init_scale'] = array(
																				'id'      		=> 'viewport_init_scale',
																				'title'   		=> 'Viewport: initial scale',
																				'description'	=> ' ',
																				'type'    		=> 'select',
																				'section' 		=> 'section_mobile',
																				'choices' 		=> array(
																											'0'			=>	' == Do not use == ',
																											'0-5'	=>	' 0.5 ',
																											'0-6'	=>	' 0.6 ',
																											'0-7'	=>	' 0.7 ',
																											'0-8'	=>	' 0.8 ',
																											'0-9'	=>	' 0.9 ',
																											'1-0'	=>	' 1.0 ',
																											'1-1'	=>	' 1.1 ',
																											'1-2'	=>	' 1.2 ',
																											'1-3'	=>	' 1.3 ',
																											'1-4'	=>	' 1.4 ',
																											'1-5'	=>	' 1.5 ',
																											'1-6'	=>	' 1.6 ',
																											'1-7'	=>	' 1.7 ',
																											'1-8'	=>	' 1.8 ',
																											'1-9'	=>	' 1.9 ',
																											'2-0'	=>	' 2.0 '
																									),
																				'class'   		=> ''
																			);					



						$this->child_settings_array['viewport_max_scale'] = array(
																				'id'      		=> 'viewport_max_scale',
																				'title'   		=> 'Viewport: maximum scale',
																				'description'	=> ' ',
																				'type'    		=> 'select',
																				'section' 		=> 'section_mobile',
																				'choices' 		=> array(
																											'0'			=>	' == Do not use == ',
																											'0-25'	=>	' 0.25 ',
																											'0-5'	=>	' 0.5 ',
																											'0-75'	=>	' 0.75 ',
																											'0-9'	=>	' 0.9 ',
																											'1-0'	=>	' 1.0 ',
																											'1-25'	=>	' 1.25 ',
																											'1-5'	=>	' 1.5 ',
																											'2-0'	=>	' 2.0 ',
																											'2-5'	=>	' 2.5 ',
																											'5-0'	=>	' 5.0 ',
																											'7-5'	=>	' 7.5 ',
																											'10-0'	=>	' 10.0 '
																									),
																				'class'   		=> ''
																			);					



						$this->child_settings_array['viewport_min_scale'] = array(
																				'id'      		=> 'viewport_min_scale',
																				'title'   		=> 'Viewport: minimum scale',
																				'description'	=> ' ',
																				'type'    		=> 'select',
																				'section' 		=> 'section_mobile',
																				'choices' 		=> array(
																											'0'			=>	' == Do not use == ',
																											'0-25'	=>	' 0.25 ',
																											'0-5'	=>	' 0.5 ',
																											'0-75'	=>	' 0.75 ',
																											'0-9'	=>	' 0.9 ',
																											'1-0'	=>	' 1.0 ',
																											'1-25'	=>	' 1.25 ',
																											'1-5'	=>	' 1.5 ',
																											'2-0'	=>	' 2.0 ',
																											'2-5'	=>	' 2.5 ',
																											'5-0'	=>	' 5.0 ',
																											'7-5'	=>	' 7.5 ',
																											'10-0'	=>	' 10.0 '
																									),
																				'class'   		=> ''
																			);					



						$this->child_settings_array['image_toolbar'] = array(
																				'id'      		=> 'image_toolbar',
																				'title'   		=> 'Image Toolbar',
																				'description'	=> ' ',
																				'type'    		=> 'radio',
																				'section' 		=> 'section_extras',
																				'choices' 		=> array(
																											'0'			=>	' == Do not use == ',
																											'true'		=>	' True',
																											'false'		=>	' False'
																									),
																				'class'   		=> ''
																			);					


						$this->child_settings_array['ms_smart_tag'] = array(
																				'id'      		=> 'ms_smart_tag',
																				'title'   		=> 'MS Smart Tag',
																				'description'	=> ' ',
																				'type'    		=> 'radio',
																				'section' 		=> 'section_extras',
																				'choices' 		=> array(
																											'0'			=>	' == Do not use == ',
																											'true'		=>	' True',
																											'false'		=>	' False'
																									),
																				'class'   		=> ''
																			);					




//Robot Settings
						/*

						if(class_exists('WPSEO_Frontend'))
						{							 
								
									$this->child_settings_array['robots_use_yoast'] = array(
																							'id'      		=> 'robots_use_yoast',
																							'title'   		=> 'Robots',
																							'description'	=> 'This is disabled while Yoast\'s SEO plugin is activated. <br /> We strongly support using that for SEO meta control. ',
																							'type'    		=> 'text_only',
																							'section' 		=> 'section_robots',
																							'choices' 		=> array(
																												),
																							'class'   		=> ''
																						);					


						 } else {
								 

									$this->child_settings_array['robots_index'] = array(
																							'id'      		=> 'robots_index',
																							'title'   		=> 'index',
																							'description'	=> '',
																							'type'    		=> 'checkbox',
																							'section' 		=> 'section_robots',
																							'choices' 		=> array(
																												),
																							'class'   		=> ''
																						);					
			
									$this->child_settings_array['robots_noodp'] = array(
																							'id'      		=> 'robots_noodp',
																							'title'   		=> 'noodp',
																							'description'	=> '',
																							'type'    		=> 'checkbox',
																							'section' 		=> 'section_robots',
																							'choices' 		=> array(
																												),
																							'class'   		=> ''
																						);					
			
			
									$this->child_settings_array['robots_noydir'] = array(
																							'id'      		=> 'robots_noydir',
																							'title'   		=> 'noydir',
																							'description'	=> '',
																							'type'    		=> 'checkbox',
																							'section' 		=> 'section_robots',
																							'choices' 		=> array(
																												),
																							'class'   		=> ''
																						);					


								 
						}
						*/

				
				
				
				}

				/*
				**
				**		ADD_PLUGIN0_TO_MENU
				**
				*/				
				public 	function 	add_plugin_to_menu()
				{

						$this->framework_admin_menu_child(	$this->plugin_page_title, 
															$this->plugin_menu_title, 
															$this->plugin_slug, 
															array($this, 	'child_admin_page')
														);				
				}
				

				/*
				**
				**		CHILD ADMIN PAGE
				**
				*/				
				public 	function 	child_admin_page()
				{
						$this->framework_admin_page_header('Meta Control', 'icon_class');
					 
						$this->framework_admin_page_footer();				
				}
				
				
				
				public 	function 	wp_head_meta_controls()
				{
					
						$this->chrome_frame();
						
						
					//	if( class_exists('kevinjohn_gallagher___mobile_control') )
					//	{		
					//			if( $this->plugin_options['mobile_debug'] )
					//			{

										$this->mobile_headers();
					//			}
					//	}
						
						
						$this->microsoft_tags();
				}


				public 	function 	chrome_frame()
				{
				
						$show_chrome_frame				=	$this->plugin_options['chrome_frame'];
					
						if($show_chrome_frame)
						{
							
								echo "\n";
								echo '<meta 	http-equiv="X-UA-Compatible"			content="IE=edge,chrome=1">';
							
						}
					
				}

				public 	function 	mobile_headers()
				{


						$show_mobile_optomized				=	$this->plugin_options['mobile_optomized'];
					
						if($show_mobile_optomized)
						{
							
								echo "\n";
								echo '<meta 	name="MobileOptimized"				content="'. $show_mobile_optomized .'">';
							
						}

						$show_mobile_handheld				=	$this->plugin_options['mobile_handheld'];
					
						if($show_mobile_handheld)
						{
							
								echo "\n";
								echo '<meta 	name="HandheldFriendly"				content="'. $show_mobile_handheld .'">';
							
						}



						$show_mobile_telephone				=	$this->plugin_options['mobile_telephone'];
					
						if($show_mobile_telephone)
						{
							
								echo "\n";
								echo '<meta 	name="format-detection"				content="'. $show_mobile_telephone .'">';
							
						}




						$viewport_width						=	$this->plugin_options['viewport_width'];
						$viewport_height					=	$this->plugin_options['viewport_height'];
						$viewport_usr_scale					=	$this->plugin_options['viewport_usr_scale'];
						$viewport_init_scale				=	$this->plugin_options['viewport_init_scale'];
						$viewport_min_scale					=	$this->plugin_options['viewport_min_scale'];
						$viewport_max_scale					=	$this->plugin_options['viewport_max_scale'];
						
						$viewport_string					=	"";						
						$viewport_string					=	$viewport_string. "";
						
						

						if( !empty( $viewport_width ) )
						{
								$viewport_string					=	$viewport_string. "width=". $viewport_width ."; ";
						}


						if( !empty( $viewport_height ) )
						{
								$viewport_string					=	$viewport_string. "height=". $viewport_height ."; ";
						}


						if( !empty( $viewport_usr_scale ) )
						{
								$viewport_string					=	$viewport_string. "user-scalable=". $viewport_usr_scale ."; ";
						}

						if( !empty( $viewport_init_scale ) )
						{
								$viewport_string					=	$viewport_string. "initial-scale=". $viewport_init_scale ."; ";
						}

						if( !empty( $viewport_max_scale ) )
						{
								$viewport_string					=	$viewport_string. "max-scale=". $viewport_max_scale ."; ";
						}

						if( !empty( $viewport_min_scale ) )
						{
								$viewport_string					=	$viewport_string. "min-scale=". $viewport_min_scale ."; ";
						}

						
						if( !empty( $viewport_string ) )
						{
								echo "\n";						
								echo '<meta	name="viewport"					content="'. $viewport_string  .'" />';
						}
						
						
						$show_mobile_web_app_capable			=	$this->plugin_options['mobile_web_app_capable'];
					
						if($show_mobile_web_app_capable)
						{
							
								echo "\n";
								echo '<meta 	name="apple-mobile-web-app-capable"		content="'. $show_mobile_web_app_capable .'">';
						}


						$show_mobile_web_app_style			=	$this->plugin_options['mobile_web_app_style'];
					
						if($show_mobile_web_app_style)
						{
							
								echo "\n";
								echo '<meta 	name="apple-mobile-web-app-status-bar-style"';
								echo 		'	content="'. $show_mobile_web_app_style .'">';
						}


					
				}
				
				
				
				public 	function 	microsoft_tags()
				{
						$show_image_toolbar			=	$this->plugin_options['image_toolbar'];
					
						if($show_image_toolbar)
						{
							
								echo "\n";
								echo '<meta 	http-equiv="ImageToolbar"			content="'. $show_image_toolbar .'">';
						}
					
					
						$show_ms_smart_tag			=	$this->plugin_options['ms_smart_tag'];
					
						if($show_ms_smart_tag)
						{
							
								echo "\n";
								echo '<meta 	name="MSSmartTagsPreventParsing"		content="'. $show_ms_smart_tag .'">';
						}
					
						$show_mobile_cleartype				=	$this->plugin_options['mobile_cleartype'];
					
						if($show_mobile_cleartype)
						{
							
								echo "\n";
								echo '<meta 	http-equiv="cleartype"				content="'. $show_mobile_cleartype .'">';
						}
					
					
				}
				
				
				public 	function 	win_7_app()
				{
					
					
				}

		
		
		}	//	class
		
	
		$kevinjohn_gallagher___meta_controls			=	new kevinjohn_gallagher___meta_controls();
		
	
	} else {
	

			function kevinjohn_gallagher___mobile_controls___parent_needed()
			{
					echo	"<div id='message' class='error'>";
					
					echo	"<p>";
					echo	"<strong>Kevinjohn Gallagher: Pure Web Brilliant's Meta Controls</strong> ";	
					echo	"requires the parent framework to be installed and activated";
					echo	"</p>";
			} 

			add_action('admin_footer', 'kevinjohn_gallagher___mobile_controls___parent_needed');	
	
	}


