/* global acf, ACFaddRelL10n */

jQuery(document).ready(function($) {
	
	// handle add button click event
	function addObjectHandler() {
		var $this      = $(this),
			$field     = $this.closest('.acf_relationship'),
			$input     = $this.siblings('.relationship_search'),
			val        = $('<div />').html($input.val()).text(),
			post_types = $field.data('post_type').split(',');

		if ( val && window.confirm( ACFaddRelL10n.confirmTitle.replace( '{title}', val ) ) ) {
			$.ajax({
				url: acf.o.ajaxurl,
				type: 'post',
				dataType: 'json',
				data: $.extend({ 
					action:	'acf/fields/relationship/create_post', 
					title:  val,
					post_type: post_types,
					nonce: acf.o.nonce
				}, acf.o ),
				success: function( request ){
					if ( request.data ) {
						acf.fields.relationship.set({ $field : $field }).fetch();
					}
				}
			});
		}
	}

	function searchInputHandler(event) {
		var button = $( event.data[0] );
		if ( this.value ) {
			button.show();
		} else {
			button.hide();
		}
	}

	$(document).on('acf/setup_fields', function(e, $el){

		// the button to attach to each relationship search field
		var add_button = $('<span class="acf-button-add acf-button-add-object"></span>').on( 'click', addObjectHandler ).hide();
		
		$el.find( '.acf_relationship' ).each(function(){

			var post_types = $(this).data('post_type').split(",");

			// attach add button only if there is just one post type
			// TODO: allow multiple post types
			if ( post_types.length === 1 ) { 
				$(this).find('.relationship_search').on('keyup', add_button, searchInputHandler).after(add_button);
			}

		});
	});
});