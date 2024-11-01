<!-- End TrustRuby Script -->
<div class="wrap">
<h1>TrustRuby - Customer Reviews</h1>
<hr />
<strong>Note:</strong> If you don't have an account yet, go to <a href="https://trustruby.com/business" style="color: red;" target="_blank">https://trustruby.com/business</a> and register for <strong>free</strong> to start collecting reviews.
<hr />
<?php 
function form_field( $arguments ) {
	
	$id = $arguments['uid'];
	
	if( $arguments['type'] == 'text' )
	{
		printf('<input name="%s" id="%s" type="text" value="%s" />', $id, $id, $arguments['default']);
	} 
	elseif( $arguments['type'] == 'checkbox' )
	{
		$checked = ($arguments['default'] == '1') ? 'checked' : '';
		printf('<input name="%s" id="%s" type="checkbox" value="1" %s />', $id, $id, $checked);
	} elseif( $arguments['type'] == 'select' )
	{
		printf('<select name="%s" id="%s">', $id, $id );
		foreach( $options as $value => $label ) 
		{
			printf('<option value="%s">%s</option>', $value, $label);
		}
		printf('</select>');
	}
	
	
	
	// If there is help text
    if( $helper = $arguments['helper'] ){
        printf( '<span class="helper"> %s</span>', $helper ); // Show it
    }

    // If there is supplemental text
    if( $supplimental = $arguments['supplemental'] ){
        printf( '<p class="description">%s</p>', $supplimental ); // Show it
    }
}



 ?>
 <div>
	<form method="post" action="options.php">
	 	<?php
	 	settings_fields( 'trustruby_fields' );
	 	do_settings_sections( 'trustruby_fields' );
	 	submit_button();
	 	?>
	 </form>
</div>
 <div class="trustruby-half">
 	
     <h2>Generate a Shortcode for your Website</h2>
     <table class="form-table" role="presentation">
     	<tbody>
     		<tr>
     			<th>
     				<label for="trustruby-widget-type">Select the type of widget:</label>
     			</th>
     			<td>
     				<select id="trustruby-widget-type">
						<option value="mini" data-default='{ "width": "90px", "height": "110px" }' selected>Mini</option>
						<option value="compact" data-default='{ "width": "120px", "height": "100px" }'>Compact</option>
						<option value="small" data-default='{ "width": "320px", "height": "50px" }'>Small</option>
						<option value="medium" data-default='{ "width": "280px", "height": "150px" }'>Medium</option>
						<option value="vertical" data-default='{ "width": "100%", "height": "300px", "number_of_reviews": 5 }'>Vertical</option>
						<option value="horizontal" data-default='{ "width": "100%", "height": "300px", " number_of_reviews": 10 }'>Horizontal</option>
						<option value="write" data-default='{ "width": "220px", "height": "45px" }'>Write</option>
					</select>     
     			</td>
     		</tr>
     		
     		<tr>
     			<th>
     				<label for="trustruby-widget-theme">Select the theme of widget:</label>
     			</th>
     			<td>
     				<select id="trustruby-widget-theme">
     					<option value="light">Light</option>
     					<option value="dark">Dark</option>
     				</select>
     			</td>
     		</tr>
     		
     		<tr>
     			<th>
     				<label for="trustruby-widget-width">Select the width of widget:</label>
     			</th>
     			<td>
     				<input id="trustruby-widget-width" type="text" value="" />
     			</td>
     		</tr>
     		
     		<tr>
     			<th>
     				<label for="trustruby-widget-height">Select the height of widget:</label>
     			</th>
     			<td>
     				<input id="trustruby-widget-height" type="text" value="" />
     			</td>
     		</tr>
     		
     		<tr>
     			<th>
     				<label for="trustruby-widget-lang">Select the language of widget:</label>
     			</th>
     			<td>
     				<select id="trustruby-widget-lang">
     					<option value="en">English</option>
     				</select>
     			</td>
     		</tr>
     		
     	</tbody>
     </table>
	<hr />
	<h4>Tip: If you are running an online shop, place a widget of type "Write" on your "Thank you"-Page to collect more reviews.</h4>
</div>
<div class="trustruby-half">	
	<div id="trustruby-output-holder">
		<h3>Add the shortcode below on any of your posts or pages:</h3>
		<pre id="trustruby-output">Output goes here</pre>
		<h3>Preview of your widget:</h3>
		<div id="trustruby-preview-widget"></div>
	</div>
</div>
 </div>