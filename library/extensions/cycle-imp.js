		jQuery(document).ready(function () {
			//From: http://www.takerootdesign.co.uk/blog/web-design/adding-named-navigation-jquery-cycle-gallery
			//Create an array of titles
			var titles = jQuery('#cycleContainer div.slide').find("h2").map(function() { return jQuery(this).text(); });
			//Add an unordered list to contain the navigation
			//Invoke the cycle plugin on #featured
			jQuery('#cycleContainer').after('<ul id="pager" class="bclass"></ul>').cycle({
				//Specify options
				fx:     'fade', //Name of transition effect
				//timeout: 0,           //Disable auto advance
				autostop: false,
				delay: 2000,
				timeout: 7000,
				pause: true,
				pager:  '#pager',     //Selector for element to use as pager container
				pagerEvent: 'mouseover',
				fastOnEvent: true,
				pagerAnchorBuilder: function (index) {               //Build the pager
				return '<li><a href="#">' + titles[index] + '</a></li>';
			},
			updateActivePagerLink: function(pager, currSlideIndex) {
				jQuery(pager).find('li').removeClass('active').filter('li:eq('+currSlideIndex+')').addClass('active');
			}
			});
		});		
			