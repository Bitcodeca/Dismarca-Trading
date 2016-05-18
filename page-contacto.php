<?php get_header(); ?>
<div class="container margintop25">
  	<h1 class="fa-3x text-center margin0 paddingtop25"><i class="fa fa-map-marker letraroja" aria-hidden="true"></i> Contáctanos</h1>
  	<div class="row margintop25">
  		<iframe src="https://www.google.com/maps/d/embed?mid=1gYrl6AXGoePDpvr_NppUfzqurLQ&hl=es" width="100%" height="256"></iframe>
  	</div>
  	<div class="col-md-6 col-sm-6 col-xs-12">
  		<h2><i class="fa fa-comments-o letraroja" aria-hidden="true"></i>¡Comunícate con nosotros!</h2>
        <h5 class="letra2"><i class="margintop10 fa fa-phone fa-lg"> </i> Teléfono: (058) 0251-xxxxxxx</h5>
        <h5 class="marginbot0"><i class="fa fa-fax fa-lg"> </i> Fax: (058) 0251-xxxxxxx</h5>
        <h5 class="marginbot0"><i class="fa fa-map-marker fa-lg"></i> Barquisimeto, Edo Lara. Venezuela </h5>
        <h5 class="marginbot0"><i class="fa fa-envelope"></i> email</h5>
        <h5 class="marginbot0"><i class="fa fa-envelope"></i> fax</h5>
        <h5 class="marginbot0"><i class="fa fa-envelope"></i> telf</h5>
  	</div>
  	<div class="col-md-6 col-sm-6 col-xs-12">
  		<h2><i class="fa fa-envelope-o letraroja" aria-hidden="true"></i> ¡Escríbenos!</h2>
		<section class="content">
			<span class="input input--hoshi">
				<input class="input__field input__field--hoshi" type="text" id="input-4" />
				<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
					<span class="input__label-content input__label-content--hoshi">Name</span>
				</label>
			</span>
			<span class="input input--hoshi">
				<input class="input__field input__field--hoshi" type="text" id="input-5" />
				<label class="input__label input__label--hoshi input__label--hoshi-color-2" for="input-5">
					<span class="input__label-content input__label-content--hoshi">Street</span>
				</label>
			</span>
			<span class="input input--hoshi">
				<input class="input__field input__field--hoshi" type="text" id="input-6" />
				<label class="input__label input__label--hoshi input__label--hoshi-color-3" for="input-6">
					<span class="input__label-content input__label-content--hoshi">Town</span>
				</label>
			</span>
		</section>
		<script src="<?php echo get_bloginfo('template_directory');?>/js/classie.js"></script>
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
  	</div>
</div>
<?php get_footer(); ?>
