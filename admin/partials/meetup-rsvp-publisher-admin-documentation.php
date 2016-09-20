<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://igorcodes.com
 * @since      1.0.0
 *
 * @package    Meetup_Rsvp_Publisher
 * @subpackage Meetup_Rsvp_Publisher/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

	<h1>Meetup RSVP Publisher Documentation</h1>

	<h2 class="nav-tab-wrapper">
		<a class="nav-tab" href="<?php echo admin_url() ?>options-general.php?page=meetup-rsvp-publisher">Shortcode Builder</a>
		<a class="nav-tab" href="<?php echo admin_url() ?>options-general.php?page=meetup-rsvp-publisher-settings">Settings</a>	
		<a class="nav-tab nav-tab-active" href="<?php echo admin_url() ?>options-general.php?page=meetup-rsvp-publisher-documentation">Documentation</a>	
		<a class="nav-tab" href="<?php echo admin_url() ?>options-general.php?page=meetup-rsvp-publisher-security">Security</a>	
	</h2>


	<h4>Questions and Answers:</h4>	
	<div style="padding: 10px; background-color: white; width: 80%; max-width: 800px">
		<p class="question-1" style="font-weight: bold;">How is this plugin useful?</p>	
		<p class="answer-1" style="color: gray">This plugin is for those that don't have time to setup appointments with potential contacts but are regular attendees or organizers of various Meetup groups.
			Since you are already committed to attending certain meetup events, you might as well announce it on your WordPress website. 
			<br>That way you can do both:  Attend your meetup and 
			bring potential contacts to you all at the same time!  You never know, they might join that meetup group also!
		</p>
		<p class="question-2" style="font-weight: bold">How do I use your plugin?</p>	
		<p class="answer-2">
			This is a shortcode-based plugin.  Meaning you have to construct a special string called shortcode and then copy-paste it into the 
			appropriate website location.
			<br>This plugin includes an intuitive and easy-to-use Shortcode Builder that only takes moments to construct a properly formed shortcode.
			<br>You simply subtract or add your groups and your shortcode will be automatically generated for you.  Then you can just copy-n-paste it and 
			you're done!
			<br>Check out this demo here ==LINK=TO=VIDEO== 
		</p>
		<p class="question-3" style="font-weight: bold">How can I customize the output?</p>	
		<p class="answer-3">
			Go to the Settings tab in the admin area and choose your options there.  You can select whether you want to display a list or a slider (Slick Slider).
			<br>Then, you can pick and choose background color, the information that you want included and the class names for sections of the announcements.
			<br>After that just go and add CSS to your stylesheets and that's it!  ==LINK=TO=MORE=INFO=HERE==
		</p>
		<p class="question-4" style="font-weight: bold">How come it doesn't have XYZ?</p>	
		<p class="answer-4">
			Initially I made this plugin for private use, but then decided to turn it into a public one.
			<br>Consider this my MVP (minimum viable product). It is lacking features right now, but if it becomes more popular I will definitely add features and 
			improvements in the future releases.  Email me your suggestions.  Thanks!
		</p>
		<p class="question-5" style="font-weight: bold">What about security?  Do you collect my data?</p>	
		<p class="answer-5">
			Absolutely not!  I am a big believer in privacy rights.  The plugin needs you to supply the API key that you can generate at the Meetup.com website.
			<br>This plugin just pulls your RSVP list using the Meetup API and based on your selected groups it generates the list or slider.
			<br>The only place anything is saved, is in the built-in WordPress caching mechanism called Transient API.  This is done to make sure you don't exceed your
			Meetup API call limit and to increase the speed of the plugin.  That is stored in your website's database, never sent outside! 
			<br>If you are technically savvy, you are welcome to look at the code for yourself.  Otherwise just take my word for it.
		</p>

	</div>




	<hr>
	Plugin by Igor Lubinets	

</div>
