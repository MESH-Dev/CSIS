</div><!-- #page -->

<footer>

	<a href="http://www.upenn.edu/" target="_blank">
		<div class="shield">
			<img src="<?php echo get_template_directory_uri(); ?>/img/shield.png" />
		</div>
	</a>

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
							<a href="https://twitter.com/penn_csis" target="_blank"><i class="fa fa-twitter"></i></a>
						</li>
						<li>
							<a href="https://www.facebook.com/socialimpactstrategy/" target="_blank"><i class="fa fa-facebook"></i></a>
						</li>
						<li>
							<a href="https://instagram.com/penn_csis/" target="_blank"><i class="fa fa-instagram"></i></a>
						</li>
						<li>
							<a href="https://www.youtube.com/channel/UCv1r5pVKofVIYPK4RMNU-fQ" target="_blank"><i class="fa fa-youtube"></i></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

</footer>

<div class="footer-bottom">
	<div class="container">
		<div class="six columns offset-by-three">
			<h6>Center for Social Impact Strategy</h6>
			<span>University of Pennsylvania School of Social Policy and Practice | 3815 Walnut St Philadelphia, PA 19104 | csis@sp2.upenn.edu</span>
		</div>
	</div>

	<div class="footer-attribution">
		<span>Site by <a href="http://meshfresh.com/" target="_blank">MESH</a></span>
	</div>

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


<script type="text/javascript">
piAId = '122292';
piCId = '86140';

(function() {
	function async_load(){
		var s = document.createElement('script'); s.type = 'text/javascript';
		s.src = ('https:' == document.location.protocol ? 'https://pi' : 'http://cdn') + '.pardot.com/pd.js';
		var c = document.getElementsByTagName('script')[0]; c.parentNode.insertBefore(s, c);
	}
	if(window.attachEvent) { window.attachEvent('onload', async_load); }
	else { window.addEventListener('load', async_load, false); }
})();
</script>




</body>
</html>
