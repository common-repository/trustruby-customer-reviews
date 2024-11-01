<!-- TrustRuby Widget -->
<div id="<?php echo $atts['placeholder_id']; ?>"></div>
<!-- End TrustRuby Widget -->
<!-- TrustRuby Script -->
<script>
(function (w,d,s,o,f,js,fjs) {
w['TrustRuby-Widget']=o;w[o] = w[o] || function () { (w[o].q = w[o].q || []).push(arguments) };
js = d.createElement(s), fjs = d.getElementsByTagName(s)[0];
js.id = o; js.src = f; js.async = 1; fjs.parentNode.insertBefore(js, fjs);
}(window, document, 'script', 'trw', '//trustruby.com/js/widget/main.es5.js'));

trw('show-reviews-widget', {
	type: '<?php echo $atts['type']; ?>',
	domain: '<?php echo $atts['domain']; ?>',
	placeholder_id: '<?php echo $atts['placeholder_id']; ?>',
	width: '<?php echo $atts['width']; ?>',
	height: '<?php echo $atts['height']; ?>',
	theme: '<?php echo $atts['theme']; ?>',
	lang: '<?php echo $atts['lang']; ?>',
	number_of_reviews: '<?php echo $atts['number_of_reviews']; ?>'
});
</script>
<!-- End TrustRuby Script -->