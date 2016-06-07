<p>Welcome to the Starter Template.  Below you will find a useful guide to managing your site.</p>


<h2 id="help-wordpress">WordPress</h2>

	<p>If you are new to WordPress and editing content, please review the help section at <a href="http://codex.wordpress.org/Getting_Started_with_WordPress">http://codex.wordpress.org/Getting_Started_with_WordPress</a></p>


<h2 id="help-site-setup">Site Setup</h2>

	<p>Most of the options for the site will be set when activating the theme.  Below are some additional items for setting up and customizing your site.</p>

	<h3 id="help-customizer">Customizer</h3>
	
		<p>The Customizer has several options for you to control your site's display and settings.  You can access the Customizer from the <a href="/wp-admin/customize.php?return=%2Fwp-admin%2F">Admin Panel</a> or from the public facing side using the Admin Bar under the Site Name (fig 1.0).</p>
	
		<figure>
			<img src="<?php echo get_template_directory_uri();?>/images/admin/customizer.png" alt="Customizer access from admin bar.">	
			<figcaption><strong>Fig 1.0</strong> Accessing the Customizer from the Admin Bar</figcaption>
		</figure>
		
		<p>The Customizer has an Admin panel on the left and a Preview panel of the page you launched the Customizer.  The default view will be the Homepage if you accessed the Customizer from the Admin Section.</p>
		
		<p>As you enter changes in the Admin panel, the Preview panel will update asynchronously with your changes.  This means you can preview the changes prior to clicking the <strong>Save &amp; Publish</strong> button.</p>
		
		<p>Once you are ready to commit to the changes you have made, click the <strong>Save &amp; Publish</strong> button.</p>
	
	
		<h4 id="help-customizer-site-title-tagline">Site Title &amp; Tagline</h4>
		
			<p>This section controls the Site Title and Tagline (secondary title below Site Title).</p>
			
		<h4 id="help-customizer-navigation">Navigation</h4>
		
			<p>This sets which menu to use in designated sections.  The <strong>Primary Menu</strong> is used for the main site navigation. Select which menu you would like to use. You can edit your menu content on the <a href="/wp-admin/nav-menus.php">Menus</a> screen in the Appearance section.</p>
			
		<h4 id="help-customizer-widgets">Widgets</h4>
		
			<p>The widgets can be controlled from the <a href="/wp-admin/widgets.php">Widgets</a> screen in the Appearances section.  Also see <a href="#help-widgets">Widgets Section</a>.</p>
			
		<h4 id="help-customizer-calendar-options">Calendar Options</h4>
		
			<h5 id="help-customizer-calendar-options-ID">Calendar ID</h5>
			
				<p>To use the calendar, you must enter a Calendar ID.  To get your Calendar ID, go to <a href="https://web-app.usc.edu/web/ecal/">USC Calendars</a>, find your Calendar and click on the title.  The Calendar ID is the number at the end in the URL.  For example, the <a href="https://web-app.usc.edu/web/ecal/calendar/headlines/32">USC Public Events</a> is ID <strong>32</strong>.</p>
				
				<pre><code>
https://web-app.usc.edu/web/ecal/calendar/headlines/32
				</code></pre>
			
			<h5 id="help-customizer-calendar-options-list-type">List Type</h5>
			
				<p>The list type for the events page shows different elements:</p>
				
				<ul>
					<li><strong>Headlines</strong>
						<ul>
							<li>Headline</li>
							<li>Date(s)</li>
							<li>Time</li>
						</ul>
					</li>
					<li><strong>Highlights</strong>
						<ul>
							<li>Image</li>
							<li>Headline</li>
							<li>Date(s)</li>
							<li>Time</li>
							<li>Location</li>
						</ul>
					</li>
					<li><strong>Summary</strong>
						<ul>
							<li>Image</li>
							<li>Headline</li>
							<li>Summary</li>
							<li>Date(s)</li>
							<li>Time</li>
							<li>Location</li>
							<li>Description</li>
						</ul>
					</li>
				</ul>
				
				<p><strong>Note:</strong> If you navigate to your Events page, you can then open the Customizer and preview the changes asynchronously before saving your changes.</p>
				
			<h5 id="help-customizer-calendar-choose-events-page">Choose Events Page</h5>
			
				<p>By default, when you activated this theme, a page called <a href="/events">Events</a> was created and set to use the <strong>Events</strong> Template.  In order to display the Events, you must have the <strong>Events</strong> Template selected from the Page Attributes for that page (Fig 1.1).</p>
				
				<figure>
					<img src="<?php echo get_template_directory_uri();?>/images/admin/events-template.jpg" alt="Events Template">	
					<figcaption><strong>Fig 1.1</strong> <strong>Events</strong> as Page Template</figcaption>
				</figure>
				
				<p>Select the <strong>Events</strong> page from the dropdown list of pages to use it as your Events list/details page.  This is what the Calendar Widget will use to link events so it is important to set this page selection.</p>
		
		<h4 id="help-customizer-static-front-page">Static Front Page</h4>
		
			<p>By default, whey you activated this theme, a page called <a href="/welcome">Welcome</a> was created and set as the static homepage using the <strong>Welcome Page</strong>.  For details about using this page, see the <a href="#help-homepage">Homepage</a> section.</p>
			
			<p>This setting is set only on a theme switch to allow you to specify a different page or posts to use as the homepage.</p>
		
		<h4 id="help-customizer-footer">Site Credit</h4>
		
			<p>The Feedback and Website By sections can be used to help users contact you for additional support.</p>
			
			<figure>
				<img src="<?php echo get_template_directory_uri();?>/images/admin/customizer-website-footer.jpg" alt="Feedback">	
				<figcaption><strong>Fig 1.2</strong> Example of the footer feedback text input</figcaption>
			</figure>
			
		<h5 id="help-customizer-feedback">Feedback</h5>
		
			<p><strong>Website Feedback Text</strong> is the text prior to the <strong>Website Feedback Link</strong> that will display in the footer.</p>
			
			<p><strong>Website Feedback Link</strong> is the link for the <strong>Website Feedback Link Text</strong>.</p>
			
			<p><strong>Website Feedback Link Text</strong> is the link text.</p>
			
			<p>See Fig. 1.2</p>
		
		<h5 id="help-customizer-website-by">Website By</h5>
		
			<p><strong>Website By Text</strong> is the text prior to the <strong>Website By Link</strong> that will display in the footer.</p>
			
			<p><strong>Website By Link</strong> is the link for the <strong>Website By Link Text</strong>.</p>
			
			<p><strong>Website By Link Text</strong> is the link text.</p>
			
			<p>See Fig 1.2</p>
	
	<h3 id="help-homepage">Homepage</h3>
	
		<h4 id="help-homepage-template">Template</h4>
		
			<p>In order to use the functions of the Homepage, you must set the page to use the Template <strong>Homepage</strong> from Page Attributes (Fig 1.3).</p>
			
			<figure>
				<img src="<?php echo get_template_directory_uri();?>/images/admin/homepage-template.jpg" alt="Homepage Template">	
				<figcaption><strong>Fig 1.3</strong> <strong>Homepage</strong> as Page Template</figcaption>
			</figure>
				
<h2 id="help-widgets">Widgets</h2>

	<p>You can add Widgets to the Sidebars and Footer in the <a href="/wp-admin/widgets.php">Widgets Admin</a> section.</p>
	
	<h3 id="help-widgets-ecal">USC Event Calendar</h3>
	
		<p>You can add the USC Event Calendar widget to any of the available widget sections (see <a href="#help-customizer-calendar-options">Calendar Options</a> for setting your Calendar ID).</p>
		
		<p>Drag the widget to the desired section and complete the options (Fig 1.6)</p>
		
		<figure>
			<img src="<?php echo get_template_directory_uri();?>/images/admin/usc-events-calendar-widget.jpg" alt="USC Event Calendar Widget">	
			<figcaption><strong>Fig 1.6</strong> Options for the USC Event Calendar widget</figcaption>
		</figure>
		
		<p><strong>Widget Title</strong> sets the Title of the widget.</p>
		
		<p><strong>Number of Events</strong> sets the amount of events to display in the widget (default 3).</p>
		
		<p><strong>Fallback URL Title</strong> will display if JavaScript is de-activated and provide a link to your calendar ID on the <a href="https://web-app.usc.edu/web/ecal/">Events Calendar site</a>.</p>

<h2 id="help-classes">Classes</h2>

	<h3 id="help-clasees-fit">Fit</h3>
	
		<p>There are several Cascading Style Sheet (CSS) clases you can use to aid with layouts.</p>
		
		<pre>
			<code>
&lt;iframe class="fit" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3306.83866430604!2d-118.28511700000003!3d34.022352000000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c7e49c71a5ed%3A0xaa905a5bb427a2c4!2sUniversity+of+Southern+California!5e0!3m2!1sen!2sus!4v1419028485184" width="600" height="450" frameborder="0" style="border:0"&gt;&lt;/iframe&gt;
			</code>
		</pre>
		
		<iframe class="fit" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3306.83866430604!2d-118.28511700000003!3d34.022352000000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c7e49c71a5ed%3A0xaa905a5bb427a2c4!2sUniversity+of+Southern+California!5e0!3m2!1sen!2sus!4v1419028485184" width="600" height="450" frameborder="0" style="border:0"></iframe>
		
		<p>Without the <strong>fit</strong> class:</p>
		
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3306.83866430604!2d-118.28511700000003!3d34.022352000000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c7e49c71a5ed%3A0xaa905a5bb427a2c4!2sUniversity+of+Southern+California!5e0!3m2!1sen!2sus!4v1419028485184" width="600" height="450" frameborder="0" style="border:0"></iframe>
		
	<h3 id="help-classes-icons">Icons</h3>
	
		<p>There are several icons that can be used with menus or inline content.  Add the class next to the icon in the menu section (Fig 1.8).</p>
		
		<figure>
			<img src="<?php echo get_template_directory_uri();?>/images/admin/classes-menu.jpg" alt="Menu Classes">	
			<figcaption><strong>Fig 1.8</strong> Adding classes to menus.</figcaption>
		</figure>
		
		<h4 id="help-classes-icons-text">Icons with Text</h4>
		
			<ul>
				<h5>Navigation</h5>
				<li><span class="icon-cancel-circled"></span> icon-cancel-circled</li>
				<li><span class="icon-cancel-circled2"></span> icon-cancel-circled2</li>
				<li><span class="icon-home"></span> icon-home</li>
				<li><span class="icon-link-ext"></span> icon-link-ext</li>
				<li><span class="icon-menu"></span> icon-menu</li>
				<li><span class="icon-search"></span> icon-search</li>
				
				<h5>Arrows</h5>
				<li><span class="icon-up-open"></span> icon-up-open</li>
				<li><span class="icon-down-open"></span> icon-down-open</li>
				<li><span class="icon-right-open"></span> icon-right-open</li>
				<li><span class="icon-left-open"></span> icon-left-open</li>
				<li><span class="icon-up-open-big"></span> icon-up-open-big</li>
				<li><span class="icon-down-open-big"></span> icon-down-open-big</li>
				<li><span class="icon-left-open-big"></span> icon-left-open-big</li>
				<li><span class="icon-right-open-big"></span> icon-right-open-big</li>
				
				<h5>Punctuation</h5>
				<li><span class="icon-quote"></span> icon-quote</li>
				
				<h5>Contact</h5>
				<li><span class="icon-mail"></span> icon-mail</li>
				<li><span class="icon-mail-alt"></span> icon-mail-alt</li>
				<li><span class="icon-mobile"></span> icon-mobile</li>
				<li><span class="icon-phone"></span> icon-phone</li>
				
				<h5>Events</h5>
				<li><span class="icon-calendar"></span> icon-calendar</li>
				<li><span class="icon-calendar-empty"></span> icon-calendar-empty</li>
				<li><span class="icon-clock"></span> icon-clock</li>
				<li><span class="icon-location"></span> icon-location</li>
				
				<h5>Documents</h5>
				<li><span class="icon-doc-text"></span> icon-doc-text</li>
				
				<h5>Social</h5>
				<li><span class="icon-apple"></span> icon-apple</li>
				<li><span class="icon-default"></span> icon-default</li>
				<li><span class="icon-itunes"></span> icon-itunes</li>
				<li><span class="icon-doc-text"></span> icon-doc-text</li>
				<li><span class="icon-facebook"></span> icon-facebook</li>
				<li><span class="icon-facebook-squared"></span> icon-facebook-squared</li>
				<li><span class="icon-flickr"></span> icon-flickr</li>
				<li><span class="icon-flickr-squared"></span> icon-flickr-squared</li>
				<li><span class="icon-google-plus"></span> icon-google-plus</li>
				<li><span class="icon-google-plus-squared"></span> icon-google-plus-squared</li>
				<li><span class="icon-instagram"></span> icon-instagram</li>
				<li><span class="icon-linkedin"></span> icon-linkedin</li>
				<li><span class="icon-linkedin-squared"></span> icon-linkedin-squared</li>
				<li><span class="icon-pinterest-squared"></span> icon-pinterest-squared</li>
				<li><span class="icon-pinterest-circled-1"></span> icon-pinterest-circled-1</li>
				<li><span class="icon-rss-squared"></span> icon-rss-squared</li>
				<li><span class="icon-rss"></span> icon-rss</li>
				<li><span class="icon-twitter"></span> icon-twitter</li>
				<li><span class="icon-twitter-squared"></span> icon-twitter-squared</li>
				<li><span class="icon-vimeo-squared"></span> icon-vimeo-squared</li>
				<li><span class="icon-vine"></span> icon-vine</li>
				<li><span class="icon-youtube"></span> icon-youtube</li>
				<li><span class="icon-youtube-play"></span> icon-youtube-play</li>
				<li><span class="icon-youtube-squared"></span> icon-youtube-squared</li>
			</ul>
		
		<h4 id="help-classes-icons-only">Icons Only</h4>
		
			<p>Using <strong>icon-only-[name]</strong> will replace the text of the item and only display the icon at 2x.</p>
			
			<p><strong>Note:</strong> using this class will hide all nested child elements.</p>
			
			<pre>
				<code>
&lt;p class="icon-only-home"&gt;This text will not display.
	&lt;span&gt;Neither will this text&lt;/span&gt;
&lt;/p&gt;
				</code>
			</pre>
			
			<p>Example of a menu using only icons:</p>
			
			<ul>
				<li class="icon-only-facebook">icon-facebook</li>
				<li class="icon-only-doc-text">icon-doc-text</li>
				<li class="icon-only-twitter">icon-twitter</li>
				<li class="icon-only-instagram">icon-instagram</li>
				<li class="icon-only-youtube">icon-youtube</li>
			</ul>
			
			<p>To show the classes, the icons are their own &lt;span&gt;</p>
			
			<p></p>
			<ul>
				<?php
					/**
						Regex
						find: \$icon-(.*?):\ '(.*?)';
						replace: <li><span\ class="icon-only-\1"></span>\ icon-only-\1</li>
					**/
				?>
				<h5>Navigation</h5>
				<li><span class="icon-only-cancel-circled"></span> icon-only-cancel-circled</li>
				<li><span class="icon-only-cancel-circled2"></span> icon-only-cancel-circled2</li>
				<li><span class="icon-only-home"></span> icon-only-home</li>
				<li><span class="icon-only-link-ext"></span> icon-only-link-ext</li>
				<li><span class="icon-only-menu"></span> icon-only-menu</li>
				<li><span class="icon-only-search"></span> icon-only-search</li>
				
				<h5>Arrows</h5>
				<li><span class="icon-only-up-open"></span> icon-only-up-open</li>
				<li><span class="icon-only-down-open"></span> icon-only-down-open</li>
				<li><span class="icon-only-right-open"></span> icon-only-right-open</li>
				<li><span class="icon-only-left-open"></span> icon-only-left-open</li>
				<li><span class="icon-only-up-open-big"></span> icon-only-up-open-big</li>
				<li><span class="icon-only-down-open-big"></span> icon-only-down-open-big</li>
				<li><span class="icon-only-left-open-big"></span> icon-only-left-open-big</li>
				<li><span class="icon-only-right-open-big"></span> icon-only-right-open-big</li>
				
				<h5>Punctuation</h5>
				<li><span class="icon-only-quote"></span> icon-only-quote</li>
				
				<h5>Contact</h5>
				<li><span class="icon-only-mail"></span> icon-only-mail</li>
				<li><span class="icon-only-mail-alt"></span> icon-only-mail-alt</li>
				<li><span class="icon-only-mobile"></span> icon-only-mobile</li>
				<li><span class="icon-only-phone"></span> icon-only-phone</li>
				
				<h5>Events</h5>
				<li><span class="icon-only-calendar"></span> icon-only-calendar</li>
				<li><span class="icon-only-calendar-empty"></span> icon-only-calendar-empty</li>
				<li><span class="icon-only-clock"></span> icon-only-clock</li>
				<li><span class="icon-only-location"></span> icon-only-location</li>
				
				<h5>Documents</h5>
				<li><span class="icon-only-doc-text"></span> icon-only-doc-text</li>
				
				<h5>Social</h5>
				<li><span class="icon-only-apple"></span> icon-only-apple</li>
				<li><span class="icon-only-default"></span> icon-only-default</li>
				<li><span class="icon-only-itunes"></span> icon-only-itunes</li>
				<li><span class="icon-only-doc-text"></span> icon-only-doc-text</li>
				<li><span class="icon-only-facebook"></span> icon-only-facebook</li>
				<li><span class="icon-only-facebook-squared"></span> icon-only-facebook-squared</li>
				<li><span class="icon-only-flickr"></span> icon-only-flickr</li>
				<li><span class="icon-only-flickr-squared"></span> icon-only-flickr-squared</li>
				<li><span class="icon-only-google-plus"></span> icon-only-google-plus</li>
				<li><span class="icon-only-google-plus-squared"></span> icon-only-google-plus-squared</li>
				<li><span class="icon-only-instagram"></span> icon-only-instagram</li>
				<li><span class="icon-only-linkedin"></span> icon-only-linkedin</li>
				<li><span class="icon-only-linkedin-squared"></span> icon-only-linkedin-squared</li>
				<li><span class="icon-only-pinterest-squared"></span> icon-only-pinterest-squared</li>
				<li><span class="icon-only-pinterest-circled-1"></span> icon-only-pinterest-circled-1</li>
				<li><span class="icon-only-rss-squared"></span> icon-only-rss-squared</li>
				<li><span class="icon-only-rss"></span> icon-only-rss</li>
				<li><span class="icon-only-twitter"></span> icon-only-twitter</li>
				<li><span class="icon-only-twitter-squared"></span> icon-only-twitter-squared</li>
				<li><span class="icon-only-vimeo-squared"></span> icon-only-vimeo-squared</li>
				<li><span class="icon-only-vine"></span> icon-only-vine</li>
				<li><span class="icon-only-youtube"></span> icon-only-youtube</li>
				<li><span class="icon-only-youtube-play"></span> icon-only-youtube-play</li>
				<li><span class="icon-only-youtube-squared"></span> icon-only-youtube-squared</li>
			</ul>