<?php 
/**
 * Plugin Name: MP3 Audio Player
 * Plugin URI: http://pluginlyspeaking.com/plugins/mp3-audio-player/
 * Description: Share some Background music or via an Audio Player.
 * Author: PluginlySpeaking
 * Version: 1.1.1
 * Author URI: http://www.pluginlyspeaking.com
 * License: GPL2
 */

add_action( 'wp_enqueue_scripts', 'psap_add_script' );

function psap_add_script() {
	wp_enqueue_style( 'psap_css', plugins_url('css/psap.css', __FILE__));
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script( 'psap_js', plugins_url('js/psap.js', __FILE__), array( 'jquery' ),false,true);
	wp_enqueue_script('jquery');	
}

// Enqueue admin styles
add_action( 'admin_enqueue_scripts', 'psap_add_admin_style' );
function psap_add_admin_style() {
	wp_enqueue_style( 'psap_admin_css', plugins_url('css/psap_admin.css', __FILE__));
}

// Check for the PRO version
add_action( 'admin_init', 'psap_free_pro_check' );
function psap_free_pro_check() {
    if (is_plugin_active('pluginlyspeaking-mp3audioplayer-pro/pluginlyspeaking-mp3audioplayer-pro.php')) {

        function my_admin_notice(){
        echo '<div class="updated">
                <p><strong>PRO</strong> version is activated.</p>
              </div>';
        }
        add_action('admin_notices', 'my_admin_notice');

        deactivate_plugins(__FILE__);
    }
}

function psap_create_type() {
  register_post_type( 'psap_type',
    array(
      'labels' => array(
        'name' => 'Audio Player',
        'singular_name' => 'Audio Player'
      ),
      'public' => true,
      'has_archive' => false,
      'hierarchical' => false,
      'supports'           => array( 'title' ),
      'menu_icon'    => 'dashicons-plus',
    )
  );
}

add_action( 'init', 'psap_create_type' );


function psap_admin_css() {
    global $post_type;
    $post_types = array( 
                        'psap_type',
                  );
    if(in_array($post_type, $post_types))
    echo '<style type="text/css">#edit-slug-box, #post-preview, #view-post-btn{display: none;}</style>';
}

function psap_remove_view_link( $action ) {

    unset ($action['view']);
    return $action;
}

add_filter( 'post_row_actions', 'psap_remove_view_link' );
add_action( 'admin_head-post-new.php', 'psap_admin_css' );
add_action( 'admin_head-post.php', 'psap_admin_css' );

function psap_check($cible,$test){
  if($test == $cible){return ' checked="checked" ';}
}

function psap_check_array($cible,$test){
  if(in_array($test,$cible)){return ' checked="checked" ';}
}

add_action('add_meta_boxes','psap_init_settings_metabox');

function psap_init_settings_metabox(){
  add_meta_box('psap_settings_metabox', 'Settings', 'psap_add_settings_metabox', 'psap_type', 'side', 'high');
}

function psap_add_settings_metabox($post){
	
	$prefix = '_psap_';
	
	$playback_music = get_post_meta($post->ID, $prefix.'playback_music',true);
	
	?>
	<table class="psap_table">
		<tr>
			<td colspan="2"><label for="playback_music">Playback of the music : </label>
				<select name="playback_music" class="psap_select_100">
					<option <?php selected( $playback_music, "player"); ?> id="playback_music_player" value="player">Audio Player</option>
					<option <?php selected( $playback_music, "background");  ?> id="playback_music_background" value="background">Background Music</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2"><label for="playlist_use">What's your music ? </label>
				<select name="playlist_use" class="psap_select_100" disabled>
					<option id="playlist_use_single_song" value="single_song">Single Song</option>
				</select>
			</td>
		</tr>
	</table>
	
	<script type="text/javascript">
		$=jQuery.noConflict();
		jQuery(document).ready( function($) {
			if($('#playback_music_player').is(':selected')) {
				$('#psap_player_metabox').show();
			} 
			if($('#playback_music_background').is(':selected')) {
				$('#psap_player_metabox').hide();
			}
			
			$('select[name=playback_music]').live('change', function(){
				if($('#playback_music_player').is(':selected')) {
					$('#psap_player_metabox').show();
				} 
				if($('#playback_music_background').is(':selected')) {
					$('#psap_player_metabox').hide();
				}
			});
		});
	</script>
	
	<?php 
	
}

add_action('add_meta_boxes','psap_init_advert_metabox');

function psap_init_advert_metabox(){
  add_meta_box('psap_advert_metabox', 'Upgrade to PRO Version', 'psap_add_advert_metabox', 'psap_type', 'side', 'low');
}

function psap_add_advert_metabox($post){	
	?>
	
	<ul style="list-style-type:disc;padding-left:20px;">
		<li>Downloadable Songs</li>
		<li>Create playlists</li>
		<li>Choose the initial volume</li>
		<li>Start automatically the player</li>
		<li>Device restriction</li>
		<li>User restriction</li>
		<li>More layouts</li>
		<li>And more...</li>
	</ul>
	<a style="text-decoration: none;display:inline-block; background:#33b690; padding:8px 25px 8px; border-bottom:3px solid #33a583; border-radius:3px; color:white;" target="_blank" href="http://pluginlyspeaking.com/plugins/mp3-audio-player/">See all PRO features</a>
	<span style="display:block;margin-top:14px; font-size:13px; color:#0073AA; line-height:20px;">
		<span class="dashicons dashicons-tickets"></span> Code <strong>AP10OFF</strong> (10% OFF)
	</span>
	<?php 
	
}

add_action('add_meta_boxes','psap_init_player_metabox');

function psap_init_player_metabox(){
  add_meta_box('psap_player_metabox', 'Select your Player Layout', 'psap_add_player_metabox', 'psap_type', 'normal');
}

function psap_add_player_metabox($post){
	
	$prefix = '_psap_';
	$player_layout = get_post_meta($post->ID, $prefix.'player_layout',true);	
	?>
	
	<ul class="psap_w_li_31 psap_ul_layout">
		<li>
			<input type="radio" id="player_layout_1" name="player_layout" value="layout_1" <?php echo (empty($player_layout)) ? 'checked="checked"' : psap_check($player_layout,'layout_1'); ?>>
			<label for="player_layout_1">
				<img src="<?php echo plugins_url('img/layouts_player/layout_1.JPG', __FILE__); ?>" > 
			</label>
		</li>
		<li>
			<input type="radio" id="player_layout_2" name="player_layout" value="layout_2" <?php echo (empty($player_layout)) ? '' : psap_check($player_layout,'layout_2'); ?>>
			<label for="player_layout_2">
				<img src="<?php echo plugins_url('img/layouts_player/layout_2.JPG', __FILE__); ?>" > 
			</label>
		</li>
		<li>
			<input type="radio" id="player_layout_3" name="player_layout" value="layout_3" <?php echo (empty($player_layout)) ? '' : psap_check($player_layout,'layout_3'); ?>>
			<label for="player_layout_3">
				<img src="<?php echo plugins_url('img/layouts_player/layout_3.JPG', __FILE__); ?>" > <br />
			</label>
		</li>
	</ul>
	<?php 
	
}

add_action('add_meta_boxes','psap_init_singlesong_metabox');

function psap_init_singlesong_metabox(){
  add_meta_box('psap_singlesong_metabox', 'Single Song', 'psap_add_singlesong_metabox', 'psap_type', 'normal');
}

function psap_add_singlesong_metabox($post){
	
	$prefix = '_psap_';
	$song_name = get_post_meta($post->ID, $prefix.'song_name',true);
	$song_artist   = get_post_meta($post->ID, $prefix.'song_artist',true);
	$song_cover   = get_post_meta($post->ID, $prefix.'song_cover',true);
	$song_file = get_post_meta($post->ID, $prefix.'song_file',true);
	?>
	<table id="psap_table_singlesong">
		<tr>
			<td class="psap_thin"><label for="song_name">Song's Name <span class="psap_desc">(opt.)</span> : </label>
			<input type="text" name="song_name" value="<?php echo (empty($song_name)) ? '' : $song_name; ?>" /></td>

			<td class="psap_thin"><label for="song_artist" >Song's Artist <span class="psap_desc">(opt.)</span> : </label>
			<input type="text" name="song_artist" value="<?php echo (empty($song_artist)) ? '' : $song_artist; ?>" /></td>

			<td class="psap_large"><label for="">Song's cover <span class="psap_desc">(opt.)</span> : </label>
			<input type="text" name="song_cover" id="song_cover_01" value="<?php echo $song_cover; ?>" /><input type="button" id="01" class="button song-cover-button" value="Choose an image" /></td>

			<td class="psap_large"><label for="song_file">Audio file : </label>
			<input type="text" name="song_file" id="song_file_01" value="<?php echo $song_file; ?>" /><input type="button" id="01" class="button song-button" value="Choose a file" /></td>
		</tr>
	</table>
	
	<?php 
	
}

add_action( 'admin_enqueue_scripts', 'psap_audio_file_enqueue' );
function psap_audio_file_enqueue() {
	global $typenow;
	if( $typenow == 'psap_type' ) {
		wp_enqueue_media();
 
		// Registers and enqueues the required javascript.
		wp_register_script( 'psap_media-js', plugin_dir_url( __FILE__ ) . 'js/psap_media.js', array( 'jquery' ) );
		wp_localize_script( 'psap_media-js', 'psap_media_js',
			array(
				'title' => __( 'Choose or Upload a file'),
				'button' => __( 'Use this file'),
			)
		);
		wp_enqueue_script( 'psap_media-js' );
	}
}

add_action( 'admin_enqueue_scripts', 'psap_image_file_enqueue' );
function psap_image_file_enqueue() {
	global $typenow;
	if( $typenow == 'psap_type' ) {
		wp_enqueue_media();
 
		// Registers and enqueues the required javascript.
		wp_register_script( 'psap_media_cover-js', plugin_dir_url( __FILE__ ) . 'js/psap_media_cover.js', array( 'jquery' ) );
		wp_localize_script( 'psap_media_cover-js', 'psap_media_cover_js',
			array(
				'title' => __( 'Choose or Upload an image'),
				'button' => __( 'Use this file'),
			)
		);
		wp_enqueue_script( 'psap_media_cover-js' );
	}
}

add_action('save_post','psap_save_metabox');
function psap_save_metabox($post_id){
	
	$prefix = '_psap_';
	
	//Metabox Settings
	if(isset($_POST['playback_music'])){
		update_post_meta($post_id, $prefix.'playback_music', sanitize_text_field($_POST['playback_music']));
	}
	if(isset($_POST['player_layout'])){
		update_post_meta($post_id, $prefix.'player_layout', sanitize_text_field($_POST['player_layout']));
	}
	if(isset($_POST['song_name'])){
		update_post_meta($post_id, $prefix.'song_name', esc_html($_POST['song_name']));
	}
	if(isset($_POST['song_artist'])){
		update_post_meta($post_id, $prefix.'song_artist', esc_html($_POST['song_artist']));
	}
	if(isset($_POST['song_cover'])){
		update_post_meta($post_id, $prefix.'song_cover', esc_html($_POST['song_cover']));
	}
	if(isset($_POST['song_file'])){
		update_post_meta($post_id, $prefix.'song_file', esc_html($_POST['song_file']));
	}	
}

add_action( 'manage_psap_type_posts_custom_column' , 'psap_custom_columns', 10, 2 );

function psap_custom_columns( $column, $post_id ) {
    switch ( $column ) {
	case 'shortcode' :
		global $post;
		$pre_slug = '' ;
		$pre_slug = $post->post_title;
		$slug = sanitize_title($pre_slug);
    	$shortcode = '<span style="border: solid 3px lightgray; background:white; padding:7px; font-size:17px; line-height:40px;">[ps_audioplayer name="'.$slug.'"]</strong>';
	    echo $shortcode; 
	    break;
    }
}

function psap_add_columns($columns) {
    return array_merge($columns, 
              array('shortcode' => __('Shortcode'),
                    ));
}
add_filter('manage_psap_type_posts_columns' , 'psap_add_columns');


function psap_shortcode($atts) {
	extract(shortcode_atts(array(
		"name" => ''
	), $atts));
		
	global $post;
    $args = array('post_type' => 'psap_type', 'numberposts'=>-1);
    $custom_posts = get_posts($args);
	$output = '';
	foreach($custom_posts as $post) : setup_postdata($post);
	$sanitize_title = sanitize_title($post->post_title);
	if ($sanitize_title == $name)
	{
		$postid = get_the_ID();	
	   
		$prefix = '_psap_';
		
		$playback_music = get_post_meta($post->ID, $prefix.'playback_music',true);	
		$light_class="";
		$layout_class="";
		
		if ($playback_music == 'player')
		{
			$player_layout = get_post_meta($post->ID, $prefix.'player_layout',true);
			$player_class = '';
			$background_class = 'psap_hidden';
			$layout = plugins_url('img/'.$player_layout.'.png', __FILE__);
			
			$bg_font_color = "";
			$bg_background_color = "";
			
			$layout_class="psap_".$player_layout;
			if($player_layout == "layout_3")
				$light_class="psap_light";
		}
		
		if ($playback_music == 'background')
		{
			$bg_font_color = "#FFFFFF";	
			$bg_background_color = "#000000";
			$player_class = 'psap_hidden';
			$background_class = '';
			$player_layout = '';
			$layout = '';
		}

		$playlist_class = 'psap_hidden';
		$song_name = get_post_meta($post->ID, $prefix.'song_name',true);
		$song_artist   = get_post_meta($post->ID, $prefix.'song_artist',true);
		$song_file = get_post_meta($post->ID, $prefix.'song_file',true);
		$song_cover = get_post_meta($post->ID, $prefix.'song_cover',true);
	
		$output = '';	
		
		$output .= '<input type="hidden" id="psap_layout" value="'.$player_layout.'" />';
	
		$output .= '<div class="psap_player '.$player_class.'" style="background: transparent url(\''.$layout.'\') no-repeat scroll center top;">';
		$output .= '	<div class="psap_pl '.$playlist_class.'" style="background: transparent url(\''.$layout.'\') no-repeat scroll -274px -175px;"></div>';
		$output .= '	<div class="psap_title '.$light_class.'"></div>';
		$output .= '	<div class="psap_artist '.$light_class.'"></div>';
		$output .= '	<div class="psap_cover"></div>';
		$output .= '	<div class="psap_controls">';
		$output .= '		<div class="psap_play" style="background: transparent url(\''.$layout.'\') no-repeat scroll -8px -171px;"></div>';
		$output .= '		<div class="psap_pause" style="background: transparent url(\''.$layout.'\') no-repeat scroll -8px -198px;"></div>';
		$output .= '		<div class="psap_rew" style="background: transparent url(\''.$layout.'\') no-repeat scroll -54px -171px;"></div>';
		$output .= '		<div class="psap_fwd" style="background: transparent url(\''.$layout.'\') no-repeat scroll -100px -171px;"></div>';
		$output .= '	</div>';
		$output .= '	<div class="psap_volume"></div>';
		$output .= '	<div class="psap_tracker"></div>';
		$output .= '</div>';

		$output .= '<ul class="psap_playlist psap_hidden">';
		if($song_name == '')
			$song_name = pathinfo($song_file, PATHINFO_FILENAME);
		$output .= '<li audiourl="'.$song_file.'" cover="'.$song_cover.'" artist="'.$song_artist.'">'. $song_name .'</li>';
		$output .= '</ul>';	
		
		
		$output .= '<div class="psap_background '.$background_class.'">';
		$output .= '<span class="psap_background_play" style="color:'.$bg_font_color.';background-color:'.$bg_background_color.';" onclick="playAudio();">&#9658;</span>';
		$output .= '<span class="psap_background_pause" style="color:'.$bg_font_color.';background-color:'.$bg_background_color.';" onclick="stopAudio();">&#10074;&#10074;</span>';
		$output .= '</div>';
	}
	endforeach; wp_reset_query();
	return $output;
}
add_shortcode( 'ps_audioplayer', 'psap_shortcode' );


	
?>