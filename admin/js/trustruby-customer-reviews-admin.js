(function( $ ) {
	'use strict';
	
	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	function showWidgetShortcode()
	{	
		var isPluginPage = $('#trustruby-widget-type').length;
		
		if( !isPluginPage )
		{
			return;
		}
		$('#trustruby-preview-widget').empty();

		
		var options = $('#trustruby-widget-type').children("option:selected").data('default');
		options.domain = $('#trustruby_domain').val();
	 	options.type = $('#trustruby-widget-type').children("option:selected").val();
	 	options.placeholder_id = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
	 	options.theme = $('#trustruby-widget-theme').children('option:selected').val();
	 	options.lang = $('#trustruby-widget-lang').children('option:selected').val();

	 	var width = $('#trustruby-widget-width').val() || options.width;
	 	options.width = width;
	 	$('#trustruby-widget-width').val( width );
	 	
	 	var height = $('#trustruby-widget-height').val() || options.height;
	 	options.height = height;
	 	$('#trustruby-widget-height').val( height );
	 	

		var output = '[trustruby_widget';
		Object.keys(options).forEach(function(key, index) {
		    output += ' ' + key + '="' + options[key] + '"';
		})
		output += ']';

		$('#trustruby-output').html( output );
		
		
		var iframe = $('<iframe>')
						.attr('scrolling', 'no')
						.attr('frameborder', 'no')
						.attr('width', options.width)
						.attr('height', options.height);
		var queryString = [];
		Object.keys(options).forEach(function(key, index) {
		    queryString.push( key + '=' + options[key]);
		});
		queryString = queryString.join('&');
		iframe.attr('src', 'http://trustruby.com/widget/display?' + queryString);
		
		
		$('#trustruby-preview-widget')
			.css({
				width: options.width,
				height: options.height
			})
			.append( iframe );		
	}
	
	function showWidgetAfterTypeChanged() {
		$('#trustruby-widget-width').val('');
		$('#trustruby-widget-height').val('');
		showWidgetShortcode();
	}
	
	function showWidgetAfterThemeChanged() {
		var $themeEl = $('#trustruby-widget-theme');
		var $previewEl = $('#trustruby-preview-widget');
		var theme = $themeEl.val();
		if( theme == 'dark' ) {
			$previewEl.addClass('dark');	
		}
		else {
			$previewEl.removeClass('dark');
		}
		
		showWidgetShortcode();
	}
	 
	 
	$(document).ready(function(){
		
		
		 $('#trustruby-widget-type').change(showWidgetAfterTypeChanged);
		 $('#trustruby-widget-theme').change(showWidgetAfterThemeChanged);
		 $('#trustruby-widget-lang').change(showWidgetShortcode);
		 $('#trustruby-widget-width, #trustruby-widget-height').blur(showWidgetShortcode);
		 showWidgetShortcode();
	});
})( jQuery );
