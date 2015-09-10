</div><!-- #page -->

<footer>

	<div class="shield">
		<img src="<?php echo get_template_directory_uri(); ?>/img/shield.png" />
	</div>

	<div class="container">
		<div class="row">

			<div class="four columns">
				<div class="footer-logo">
					<img src="<?php echo get_template_directory_uri(); ?>/img/penn.png" />
				</div>
			</div>
			<div class="four columns offset-by-four">
				<div class="footer-social">
					<ul>
						<li>
							<a href=""><i class="fa fa-twitter"></i></a>
						</li>
						<li>
							<a href=""><i class="fa fa-facebook"></i></a>
						</li>
						<li>
							<a href=""><i class="fa fa-instagram"></i></a>
						</li>
						<li>
							<a href=""><i class="fa fa-youtube"></i></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

</footer>

<div class="footer-bottom">
	<h6>Center for Social Impact Strategy</h6>
	<span>22 West Elm Road, Pleasantville, US 11222 | + 1 555 987 6543 | contactsocialimpactstrategy.com</span>
</div>

<?php wp_footer(); ?>

<script>
	(function() {
		// trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
		if (!String.prototype.trim) {
			(function() {
				// Make sure we trim BOM and NBSP
				var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
				String.prototype.trim = function() {
					return this.replace(rtrim, '');
				};
			})();
		}

		[].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
			// in case the input is already filled..
			if( inputEl.value.trim() !== '' ) {
				classie.add( inputEl.parentNode, 'input--filled' );
			}

			// events:
			inputEl.addEventListener( 'focus', onInputFocus );
			inputEl.addEventListener( 'blur', onInputBlur );
		} );

		function onInputFocus( ev ) {
			classie.add( ev.target.parentNode, 'input--filled' );
		}

		function onInputBlur( ev ) {
			if( ev.target.value.trim() === '' ) {
				classie.remove( ev.target.parentNode, 'input--filled' );
			}
		}
	})();
</script>



</body>
</html>
