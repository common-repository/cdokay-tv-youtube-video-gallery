<?php
/*
Plugin Name: CDOkay! TV
Plugin URI: http://wordpress.org/extend/plugins/cdokay-tv-youtube-video-gallery/?topic_id=1785
Description: CDOkay! TV Makes it easy for displaying Youtube videos on their pages as well as displaying a full summary of your latest webisodes on a page.
Version: 2.7
Author URI: http://ripplingrealm.wordpress.com
*/


if ( ! defined( 'WP_CONTENT_URL' ) )
      define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( ! defined( 'WP_CONTENT_DIR' ) )
      define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( ! defined( 'WP_PLUGIN_URL' ) )
      define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( ! defined( 'WP_PLUGIN_DIR' ) )
      define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
if ( ! defined( 'WPMU_PLUGIN_URL' ) )
      define( 'WPMU_PLUGIN_URL', WP_CONTENT_URL. '/mu-plugins' );
if ( ! defined( 'WPMU_PLUGIN_DIR' ) )
      define( 'WPMU_PLUGIN_DIR', WP_CONTENT_DIR . '/mu-plugins' );

function wpytAddCSS(){
	echo ('<link rel="stylesheet" type="text/css" href="'.WP_CONTENT_URL.'/plugins/cdokay-tv-youtube-video-gallery/styles/jermytv.css" media="screen" />');
}
function wpAddSCRIPTS(){
	echo ('<link rel="stylesheet" type="text/css" href="'.WP_CONTENT_URL.'/plugins/cdokay-tv-youtube-video-gallery/styles/jermytv.css" media="screen" />');
	echo('<script type="text/javascript" src="'.get_option('home').'/wp-includes/js/jquery/jquery.js?ver=1.3.2"></script>
		<script type="text/javascript" language="javascript" src="'.WP_CONTENT_URL.'/plugins/cdokay-tv-youtube-video-gallery/js/jquery.jcarousel.js"></script>
                <script type="text/javascript" language="javascript" src="'.WP_CONTENT_URL.'/plugins/cdokay-tv-youtube-video-gallery/js/jquery.jcarousel.min.js"></script>
                <script type="text/javascript" language="javascript">
					jQuery(document).ready(function() {
						jQuery(\'#mycarousel\').jcarousel();
					});					
				</script>');
}
add_action('admin_head', 'wpytAddCSS'); 
add_action('wp_head', 'wpAddSCRIPTS'); 
function  jtv_width(){
	if(get_option("option_jtv_width") == ""){
		$jtv_width = 400;
		update_option("option_jtv_width",$jtv_width);
	} else {
		$jtv_width = get_option("option_jtv_width");
	}
	 echo $jtv_width;
}

function  jtv_height(){
	if(get_option("option_jtv_height") == ""){
		$jtv_height = 325;
		update_option("option_jtv_height",$jtv_height);
	} else {
		$jtv_height = get_option("option_jtv_height");
	}
	 echo $jtv_height;
}
function  jtv_th_width(){
	if(get_option("option_jtv_th_width") == ""){
		$jtv_th_width = 100;
		update_option("option_jtv_th_width",$jtv_th_width);
	} else {
		$jtv_th_width = get_option("option_jtv_th_width");
	}
	 echo $jtv_th_width;
}

function  jtv_th_height(){
	if(get_option("option_jtv_th_height") == ""){
		$jtv_th_height = 75;
		update_option("option_jtv_th_height",$jtv_th_height);
	} else {
		$jtv_th_height = get_option("option_jtv_th_height");
	}
	 echo $jtv_th_height;
}

function jtv_color_options(){
	$colorSel = get_option('option_jtv_color');
	$myColorArray = array("color0","color1","color2","color3","color4","color5","color6","color7","color8");
	$myColorNames = array("Light Grey","Dark Grey","Blue","Dark Cyan","Green","Yellow","Pink","Purple","Maroon");
	for ($i=0;$i<count($myColorArray);$i++){
		echo("<option ");
		if($colorSel == $myColorArray[$i]){
			echo("selected='yes'");
		} else {
			echo("");
		}
		echo("value='".$myColorArray[$i]."' >".$myColorNames[$i]."</option>");
	}
}

function fetchID($text){ 
	$jtv_tagname = 'cdokaytv';
	$tagstart = '['.$jtv_tagname.']';
	$tagend = '[/'.$jtv_tagname.']';
	$leftbehindA = explode($tagstart,$text);
	$text2 = $leftbehindA[0];
	for($j=1; $j<sizeof($leftbehindA); $j++) {
		$ytCode = explode($tagend, $leftbehindA[$j]);
	} 
	return $ytCode[0] ;
}

function get_cat_count($input = '') { 
	global $wpdb;
	if($input == '')
	{
		$category = get_the_category();
		return $category[0]->category_count;
	}

	elseif(is_numeric($input))
	{
		$SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->term_taxonomy.term_id=$input";
		return $wpdb->get_var($SQL);
	}
	else
	{
		$SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->terms.slug='$input'";
		return $wpdb->get_var($SQL);
	}
}

function jtv_thumbcount(){ 
	$jtv_thumbcount = get_option("option_jtv_thumbcount");
	if($jtv_thumbcount ==""){
		$showCount = get_cat_count(get_option('option_jtv_category'));
		echo("");
	} else {
		$showCount = $jtv_thumbcount;
		if($showCount>50){
			$showCount = 50;
			update_option("option_jtv_thumbcount",$showCount);
		}
		echo($showCount);
	}
	
}
function removeData(){
	delete_option("option_jtv_width");
	delete_option("option_jtv_height");
	delete_option("option_jtv_th_width");
	delete_option("option_jtv_th_height");
	delete_option("option_jtv_color");
	delete_option("option_jtv_border");
	delete_option("option_jtv_category");
	delete_option("option_jtv_thumbcount");
	}
function excerptImage(){
	$jtv_tagname = 'cdokaytv';
	$tagstart = '['.$jtv_tagname.']';
	$tagend = '[/'.$jtv_tagname.']';
	$jtv_category = get_option("option_jtv_category");
	$jtv_th_width = get_option("option_jtv_th_width");
	$jtv_th_height = get_option("option_jtv_th_height");
	$cat_compare = get_the_category();
	if(($cat_compare[0]->cat_ID) == $jtv_category){
		$theText = get_the_content();
		$jtvCode = fetchID($theText);
		$totalText = '<div class="floatleft" width="'.$jtv_th_width.'" height="'.$jtv_th_height.'" style="margin-right:5px;"><a href="'.get_permalink().'"><img src="http://i3.ytimg.com/vi/'.$jtvCode.'/default.jpg" width="'.$jtv_th_width.'" height="'.$jtv_th_height.'" alt="'.get_the_title().'" border="0" /></a></div>';
		$leftbehindA = explode($tagstart,$theText);
		for($j=1; $j<sizeof($leftbehindA); $j++) {
			$ytCode = explode($tagend, $leftbehindA[$j]);} 
		$totalText .=  $ytCode[1];
		$totalText .= '<div class="clear"></div>';
		return $totalText;
	} else {
		return get_the_excerpt();
	}
}

function cdokaySlider(){ 
	$jtv_width = get_option("option_jtv_width");
	$jtv_category = get_option("option_jtv_category");
	$jtv_th_width = get_option("option_jtv_th_width");
	$jtv_th_height = get_option("option_jtv_th_height");
	$showCount = get_option("option_jtv_thumbcount");
	echo('<div id="adjuster"><div id="wrap"><ul id="mycarousel" class="jcarousel-skin-tango">');	
	query_posts('cat='.$jtv_category.'&orderby=post_date&hide_empty=0&order=desc&showposts='.$showCount);
	while (have_posts()): the_post();
		$text = get_the_content();
		$jtvCode = fetchID($text);
		echo('<li class="innercatlist"><a href="javascript:void(0);" onclick="loadNewVideo(\''.$jtvCode.'\', 0);"><img src="http://i3.ytimg.com/vi/'.$jtvCode.'/default.jpg" width="'.$jtv_th_width.'" height="'.$jtv_th_height.'" alt="'.get_the_title().'" border="0" /></a><br /><a href="'.get_permalink().'">'.get_the_title().'</a></li>');
	endwhile;
	echo('<div class="clear"></div></ul></div></div>'); 
}

function cdokayDisplay(){
	if(is_page()){ 
	$jtv_category = get_option("option_jtv_category");
	$jtv_width =  get_option("option_jtv_width");
	$jtv_height =  get_option("option_jtv_height");
	$jtv_color =  get_option("option_jtv_color");
	if($jtv_color == "color0"){ 
		$color1 = "0xd6d6d6";
		$color2 = "0xf0f0f0";
	}
	elseif($jtv_color == "color1"){
		$color1 = "0x3a3a3a";
		$color2 = "0x999999";
	}
	elseif($jtv_color == "color2"){
		$color1 = "0x2b405b";
		$color2 = "0x6b8ab6";
	}
	elseif($jtv_color == "color3"){
		$color1 = "0x006699";
		$color2 = "0x54abd6";
	}
	elseif($jtv_color == "color4"){
		$color1 = "0x234900";
		$color2 = "0x4e9e00";
	}
	elseif($jtv_color == "color5"){
		$color1 = "0xe1600f";
		$color2 = "0xfebd01";
	}
	elseif($jtv_color == "color6"){
		$color1 = "0xcc2550";
		$color2 = "0xe87a9f";
	}
	elseif($jtv_color == "color7"){
		$color1 = "0x402061";
		$color2 = "0x9461ca";
	}
	elseif($jtv_color == "color8"){
		$color1 = "0x5d1719";
		$color2 = "0xcd311b";
	} else{
		$color1 = "0xd6d6d6";
		$color2 = "0xf0f0f0";
	}
	$jtv_border = get_option("option_jtv_border");
	$jtv_th_width = get_option("option_jtv_thumb_width");
	$jtv_th_height = get_option("option_jtv_thumb_height");
	$jtv_category = get_option("option_jtv_category"); 
	
	$the_query = new WP_Query('showposts=1&orderby=post_date&order=desc&cat='.$jtv_category);
	while ($the_query->have_posts()) : $the_query->the_post();
    $do_not_duplicate = $post->ID;
	$text =  get_the_content();
	$ytCode = fetchID($text);
	
	$contentTotalOutput ='<div id="jtv_container"><div id="ytplayer"></div>';
	$contentTotalOutput .= '<script type="text/javascript" src="'.WP_PLUGIN_URL.'/cdokay-tv-youtube-video-gallery/js/swfobject.js"> </script>';
	$contentTotalOutput .= '<script type="text/javascript">';
	$contentTotalOutput .= 'var params = { allowScriptAccess: "always" };';
	$contentTotalOutput .= 'var atts = { id: "myytplayer" };';
	$contentTotalOutput .= 'swfobject.embedSWF("http://www.youtube.com/v/'.$ytCode.'?enablejsapi=1&playerapiid=ytplayer&color1='.$color1.'&color2='.$color2.'", "ytplayer",';
	if ($jtv_width != "") { $contentTotalOutput .= '"'. $jtv_width.'",'; }
	if ($jtv_width != "") { $contentTotalOutput .= '"'. $jtv_height.'",'; }					
	$contentTotalOutput .= '"8", null, null, params, atts);';
	$contentTotalOutput .='function onYouTubePlayerReady(playerId) {ytplayer = document.getElementById("myytplayer");}function loadNewVideo(id, startSeconds){if (ytplayer) {ytplayer.loadVideoById(id, startSeconds);}}function play() {if (ytplayer) {ytplayer.playVideo();}}function pause() {if (ytplayer) {ytplayer.pauseVideo();}}function stop() {if (ytplayer) {ytplayer.stopVideo();}}';
	$contentTotalOutput .='</script></div>'; 
	echo($contentTotalOutput); 
	cdokaySlider();
	endwhile;
	}
	
}

function convertContent($content){
		$jtv_tagname = 'cdokaytv';
		$tagstart = '['.$jtv_tagname.']';
		$tagend = '[/'.$jtv_tagname.']';
		$jtv_category = get_option("option_jtv_category");
		$jtv_width =  get_option("option_jtv_width");
		$jtv_height =  get_option("option_jtv_height");
		$jtv_color =  get_option("option_jtv_color");
		if($jtv_color == "color0"){ 
			$color1 = "0xd6d6d6";
			$color2 = "0xf0f0f0";
		}
		elseif($jtv_color == "color1"){
			$color1 = "0x3a3a3a";
			$color2 = "0x999999";
		}
		elseif($jtv_color == "color2"){
			$color1 = "0x2b405b";
			$color2 = "0x6b8ab6";
		}
		elseif($jtv_color == "color3"){
			$color1 = "0x006699";
			$color2 = "0x54abd6";
		}
		elseif($jtv_color == "color4"){
			$color1 = "0x234900";
			$color2 = "0x4e9e00";
		}
		elseif($jtv_color == "color5"){
			$color1 = "0xe1600f";
			$color2 = "0xfebd01";
		}
		elseif($jtv_color == "color6"){
			$color1 = "0xcc2550";
			$color2 = "0xe87a9f";
		}
		elseif($jtv_color == "color7"){
			$color1 = "0x402061";
			$color2 = "0x9461ca";
		}
		elseif($jtv_color == "color8"){
			$color1 = "0x5d1719";
			$color2 = "0xcd311b";
		} else{
			$color1 = "0xd6d6d6";
			$color2 = "0xf0f0f0";
		}
		$jtv_border = get_option("option_jtv_border");
		$jtv_th_width = get_option("option_jtv_thumb_width");
		$jtv_th_height = get_option("option_jtv_thumb_height");
		$jtv_category = get_option("option_jtv_category"); 
		global $post;
		$cat_compare = get_the_category();
		if(($cat_compare[0]->cat_ID) == $jtv_category){ 
			$ytCode = fetchID($content);
			$contentTotalOutput ='<div id="jtv_container"><div id="ytplayer"></div>';
			$contentTotalOutput .= '<script type="text/javascript" src="'.WP_PLUGIN_URL.'/cdokay-tv-youtube-video-gallery/js/swfobject.js"> </script>';
			$contentTotalOutput .= '<script type="text/javascript">';
			$contentTotalOutput .= 'var params = { allowScriptAccess: "always" };';
			$contentTotalOutput .= 'var atts = { id: "myytplayer" };';
			$contentTotalOutput .= 'swfobject.embedSWF("http://www.youtube.com/v/'.$ytCode.'?enablejsapi=1&playerapiid=ytplayer&color1='.$color1.'&color2='.$color2.'", "ytplayer",';
			if ($jtv_width != "") { $contentTotalOutput .= '"'. $jtv_width.'",'; }
			if ($jtv_width != "") { $contentTotalOutput .= '"'. $jtv_height.'",'; }					
			$contentTotalOutput .= '"8", null, null, params, atts);';
			$contentTotalOutput .='function onYouTubePlayerReady(playerId) {ytplayer = document.getElementById("myytplayer");}function loadNewVideo(id, startSeconds){if (ytplayer) {ytplayer.loadVideoById(id, startSeconds);}}function play() {if (ytplayer) {ytplayer.playVideo();}}function pause() {if (ytplayer) {ytplayer.pauseVideo();}}function stop() {if (ytplayer) {ytplayer.stopVideo();}}';
			$contentTotalOutput .='</script></div>';	
			$leftbehindA = explode($tagstart,$content);
			for($j=1; $j<sizeof($leftbehindA); $j++) {
			$ytCode = explode($tagend, $leftbehindA[$j]);} 
			$contentTotalOutput .=  $ytCode[1];
			return $contentTotalOutput;
		} else {
		return get_the_content();
	}
}


	add_filter('the_content','convertContent');
if(!is_page()){
	add_filter('the_excerpt','excerptImage');
} 



function jermytv_admin(){
	$jtv_tagname = 'cdokaytv';
	$tagstart = '['.$jtv_tagname.']';
	$tagend = '[/'.$jtv_tagname.']';
	$jtv_width =  get_option("option_jtv_width");
	$jtv_height =  get_option("option_jtv_height");
	$jtv_color =  get_option("option_jtv_color");
	$jtv_border = get_option("option_jtv_border");
	$jtv_th_width = get_option("option_jtv_thumb_width");
	$jtv_th_height = get_option("option_jtv_thumb_height");
	$jtv_category = get_option("option_jtv_category");
	$jtv_thumbcount = get_option("option_jtv_thumbcount");
	if (isset($_POST['submitted'])){
	$jtv_width =  $_POST['input_jtv_width'];
	$jtv_height =  $_POST['input_jtv_height'];
	$jtv_th_width =  $_POST['input_jtv_th_width'];
	$jtv_th_height =  $_POST['input_jtv_th_height'];
	$jtv_color =  $_POST['input_jtv_color'];
	$jtv_border = $_POST['input_jtv_border'];
	$jtv_category = $_POST['input_jtv_category'];
	$jtv_thumbcount = $_POST['input_jtv_thumbcount'];
	update_option("option_jtv_width",$jtv_width);
	update_option("option_jtv_height",$jtv_height);
	update_option("option_jtv_th_width",$jtv_th_width);
	update_option("option_jtv_th_height",$jtv_th_height);
	update_option("option_jtv_color",$jtv_color);
	update_option("option_jtv_border",$jtv_border);
	update_option("option_jtv_category",$jtv_category);
	update_option("option_jtv_thumbcount",$jtv_thumbcount);
	echo "<div id=\"message\" class=\"updated fade\" ><p><strong>CDOKAY TV options updated.</strong></p></div>";
 }
 	if(isset($_POST['deleteData'])){
		removeData();
		echo"<div id=\"message\" class=\"updated fade\" >>Your CDOkay! TV youtube settings have been cleared.</div>";
	}
?>
<div class="wrap">
<table id="adminTable" width="100%" border="0" cellspacing="2" cellpadding="2">
<tbody>
<tr>
<td>
If you like this plugin or would like to support its development, you may donate through Paypal:
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form><br />
</td>
</tr>
<tr>
<td>
<form method="post" name="theOptions" target="_self">
<div id="icon-themes" class="icon32"></div><h2>CDOKAY! TV Settings</h2>
<div class="memo"><span class="greentext">This plugin has been developed by: Jeremy Ancog</span>. <br  />Settings declared here will affect all post or pages that display the tags.</div>
<div id="firstdiv" class="firstd floatleft">
<div id="icon-options-general" class="icon32"></div><h3>CDOkay!TV Video Frame Options</h3>
 <span class="formlabel">frame width:</span><input name="input_jtv_width" type="text" style="width:100px;" value="<?php jtv_width(); ?>"  maxlength="50" /><br />
 <span class="formlabel">frame height:</span><input name="input_jtv_height" type="text" style="width:100px;" value="<?php jtv_height(); ?>" maxlength="50" />&nbsp;<br /><br />
<div id="Frame" style="width:200px;height:168px;">	
</div>
<br />
<div id="dropdown">
<script type="text/javascript">
	document.getElementById('Frame').style.background='url("<?php echo(WP_PLUGIN_URL); ?>/cdokay-tv-youtube-video-gallery/images/<?php echo(get_option('option_jtv_color')); ?>.jpg")';	
	function displayPic(){
		var theChoice = document.theOptions.input_jtv_color.value;
		var theBackground = document.getElementById('Frame').style.background='url("<?php echo(WP_PLUGIN_URL); ?>/cdokay-tv-youtube-video-gallery/images/'+theChoice+'.jpg")';
	}
</script>
	<span class="formlabel">Select Frame Color: </span><select name="input_jtv_color" id="input_jtv_color" size="1" onchange="displayPic();">
    	<?php jtv_color_options(); ?>
    </select>
</div>
</div><!--end first division-->
<div id="seconddiv" class="secondd floatleft">
<div id="icon-options-general" class="icon32"></div><h3>CDOkay!TV Thumbnail Options</h3><br />
<span class="formlabel">thumbnail width:</span><input name="input_jtv_th_width" type="text" style="width:100px;" value="<?php jtv_th_width(); ?>"  maxlength="50" /><br />
 <span class="formlabel">thumbnail height:</span><input name="input_jtv_th_height" type="text" style="width:100px;" value="<?php jtv_th_height(); ?>" maxlength="50" />&nbsp;<br /><br />
 <span class="formlabel">thumbnail count:</span><input name="input_jtv_thumbcount" type="text" style="width:25px;" value="<?php jtv_thumbcount(); ?>" maxlength="2" />&nbsp;<br />(maximum of 50 or leave blank if you want it to depend on your number of posts in your selected category - the input field will automatically be filled with the current number of existing posts.  ) <br /><br />
 <div id="icon-options-general" class="icon32"></div><h3>CDOkay!TV Category Options</h3><br />
<span class="formlabel">Select Category to display:</span><select name="input_jtv_category" id="input_jtv_category" size="1" >
<?php
	$categories = get_categories('hide_empty=0');
	foreach ($categories as $cat) {

	if(($jtv_category) == $cat->cat_ID){
		$selConf = 'selected="yes"';
	} else {
		$selConf = '';
	}

    $option = '<option '.$selConf.' value="'.$cat->cat_ID.'">';

    $option .= $cat->cat_name;

    $option .= ' ('.$cat->category_count.')';

    $option .= '</option>';
	
    echo $option;

  }


?>
</select>
<br /><br />
<input name="submitted" type="hidden" value="yes" />
<input type="submit" name="Submit" value="Update Options &raquo;" />
<br />
<br />
Click this button for deleting data. You should click this first if you are going to uninstall this plugin. This is not undoable.
<input type="submit" name="deleteData" class="deleteBtn" onClick="return confirm('This will remove all old data settings, would you like to continue?')" value="Delete Options" />
</div>
<div id="thirddiv" class="secondd floatleft">
<div id="icon-options-general" class="icon32"></div><h3>Instructions</h3><br />
If you are able to read this, it is assumed that you already activated this plugin. Follow these steps to get your CDOkay!TV plugin working for your theme and posts:<br  /><br  /> 
<ol><span class="boldtext">For displaying Youtube Videos on your posts and allow admin control</span>
	<li>Place the following code <span class="redtext">ABOVE</span> your post texts. If this code is placed anywhere between paragraphs or texts causes all texts above the code to disappear.
        <div class="codebox">&#91;cdokaytv&#93;H_vIOEJ8G7c&#91;&#47;cdokaytv&#93;</div><br />
        where the "<span class="redtext">H_vIOEJ8G7c</span>" is the id code from your Youtube video.
        <div id="snapshot1"></div>
    </li>
    <li>
    	Check the category of the post that matches to the category selection you declared here. This is the category for your videos, and CDOkay!TV will automatically detect the posts in that category for the video code and render it properly. 
    </li>
</ol>
<br />
<ol><span class="boldtext">To run the video gallery (Please make sure you have completed the list above so this can work properly).</span>
	<li>Paste this code in your <span class="redtext">page.php</span> by replacing <span class="redtext">the_content&#40;&#41;&#59;</span> with:<br/>
    	<div class="codebox">cdokayDisplay&#40;&#41;&#59;</div><br />
    </li>
</ol>
</div>
 </form>
</td>
</tr>
</tbody>
</table>
		

 </div>
 <?php
 }
function jermytv_addpage() {
    add_submenu_page('plugins.php', 'CDOkay! TV', 'CDOkay! TV', 10, __FILE__, 'jermytv_admin');
}
add_action('admin_menu', 'jermytv_addpage');
 ?>