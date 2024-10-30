=== CDOkay!TV WordPress Plugin ===
Contributors: rippler7
Donate link: 
Tags: gallery, video, youtube, videos, jquery, jcarousel
Requires at least: 2.5
Tested up to: 3.0
Stable tag: trunk

CDOkay! TV Makes it easy for displaying Youtube videos on your pages as well as displaying a full summary of your latest webisodes on a page.

== Description ==

CDOkay! TV Makes it easy for displaying Youtube videos on your pages as well as displaying a full summary of your latest webisodes on a page. It allows you to post a youtube on each of your post with customizable general attributes such as width and height and frame color to match your theme. Also, you can add a Youtube Video slideshow gallery, with thumbnail preview below the main screen. Each thumbnail is clickable and does not require your whole page to reload. The thumbnails can also be customized through their dimensions and display number limit. 

What it does basically is render your youtube shortcode posts into a working youtube video. Those video posts must also belong to the same category as the one you selected in the CDOkay! TV admin panel. The video gallery as well displays your latest video posts in a slider position through image thumbnails. Clicking the image launches the corresponding video onto the main frame, while clicking on the title of the thumbnail will open the WordPress post of that video.

FEATURES:

1) Makes it easy for users to post Youtube Videos on their blog posts individually, enabling them to tag videos via WordPress, or elicit comments on the video on their WordPress blogs.

2) Allows posting articles after each video display. This enables the admin to discuss about the video.

3) Easily configurable.  The video can have varied gerneral properties such as frame color, width and height. For the gallery, the admin can choose how many thumbnails to display and the size of the thumbnails as well.

4) No page reload to play each video on the gallery. Ths system uses the Youtube player API, allowing the user to click on the thumbnail and load the corresponding video, without having to reload the page each time. 

5) Category select. It's hard for simple users to determine the category ID of their video posts, therefore a dropdown menu is provided for them to just select where the appropriate category their videos belong to might be.

6) Thumbnail preview excerpt. Excerpt articles will display a thumbnail preview of the video alongside the content text. For the moment, this displays the full content , but replaces the video with an image.

7) The gallery incorporates http://sorgalla.com/jcarousel/ interface, which allows advanced admins to go beyond the traditional static slider. The standard slider allows users to slide through the desired video thumbnail if there are more than the set slider width.

Future versions may add more features and functionalities. If you would like to help support the development of this plugin, you may make a donation through Paypal (Refer to the button found on the admin page).  

== Installation ==

1. Download the zipped folder.
2. Extract the contents of the folder to <YourWordpressWebsiteRootInstallDirectory>/wp-contents/plugins/
3. Login to your blog as admin and activate the plugin through the Plugins control panel.
4. In the Plugins panel tab you can find the plugin and edit settings according to your preferences.

For displaying Youtube Videos on your posts and allow admin control:

a) Place the following shortcode ABOVE your post texts. (If this code is placed anywhere between paragraphs or texts, it causes all texts above the shortcode to disappear.):

[cdokaytv]H_vIOEJ8G7c[/cdokaytv]

where the "H_vIOEJ8G7c" is the id code from your Youtube video. 

b) Check the category of the post that matches to the category you selected in the CDOkay! TV admin panel. This is the category for your videos, and CDOkay!TV will automatically detect the posts in that category for the video code and render it properly if the tagcodes are found. You can set the category change in the CDOkay! TV admin panel.

To run the video gallery (Please make sure you have completed the list above so this can work properly).

a) Paste this code in your page.php by replacing the_content(); with:

cdokayDisplay();

You can actually place this code anywhere on your page but you will need to paste <?php  cdokayDisplay();  ?>  (as long as it's outside the php loop)  instead of just cdokayDisplay(); and it will run just the same.

Editing the CSS

The css file can be found in the styles folder. The file is named 'jermytv.css'.

a) There are two CSS items to customize the width of the slider:

.jcarousel-skin-tango .jcarousel-container-horizontal {
    width: 450px; 
    padding: 5px 40px;
    margin:0px auto;
}

.jcarousel-skin-tango .jcarousel-clip-horizontal {
    width:  450px;
    height: 110px;
    margin:0px auto;
}
Change the width (or height) according to your preference. These can be found at lines 83 and 95 of your text editor (you can edit this via notepad). Save settings afterward.

After you have completed the above steps, you will be able to control your Youtube video display on your WordPress blog posts and page.

== Screenshots ==

1. The video gallery render.

2. The admin panel view.

== Changelog ==

= 2.4 =
*Added clear data button for uninstall

= 2.7 =
*renamed hardcoded folder names in jermytv.php which caused a source file error for not being able to load required javascript and css files.

== Faq ==

Q: Okay, now I activated the plugin... I am in the CDOkay! TV admin panel... what next?
A: Start having your video post categories by setting a new category that is exclusively for your video posts. If you already have one, you may skip making a new video category. After that, make video posts by placing the cdokaytv shortcodes with the youtube video id. Below it you can add additional text content if you want.

Q: Right, I just made several posts following that format, nothing's happening?
A: Go to the CDOkay! TV admin panel settings and select your video category. After that you can select your frame color and the width and height.

Q: Hey! They're looking good. Okay, now what about that video gallery you mentioned?
A: You want it on your homepage? No problem. You just place the php function 'cdokayDisplay();' (without the quotes) anywhere inside your page.php page. If you want it to appear on specific pages, you may want to paste in the following:

if(is_page('name-of-your-page')){
	cdokayDisplay();
}

Or if you want it only to show up on your homepage:

if(is_front_page()){
	cdokayDisplay();
} 

Remember, this function won't work unless you already activated the plugin!

Q: Awesome! But wait, why did you name it CDOkay! TV?
A: Because I first implemented that system (manually) on a website with that name. You can actually see the plugin in action there: http://www.cdokay.com and click away on the video thumbnails or their titles.

Q: Great, are there any more features?
A: In time there will be more features, but at the moment I still have other matters to attend to. If you could donate some amount to encourage me to further the development of this plugin or make entirely new ones, it is greatly appreciated!

== Uninstallation ==

1. Unset all options inside the CDOkay! TV Admin panel.

2. If you placed the following code on any of your theme pages:

cdokayDisplay();

You need to remove them. If you replaced 'get_content();' with it, you should put it back in place.

3. You can then deactivate the plugin in the Plugins management panel.
