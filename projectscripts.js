jQuery( '#message a' ).hide();
jQuery( document ).ready(
	function(){
			jQuery( '#lsp_meta_box_details .ui-sortable-handle' ).click();
			jQuery( '#lsp_meta_box_details .inside' ).show();
	}
);




jQuery( '#lsp_post_testimonial' ).change(
	function(){
			jQuery( '#lsp_post_show' ).val( 'yes' );
	}
);



jQuery( '#title' ).blur(
	function(){
		if (jQuery( 'input[name=lsp_post_client_name]' ).val() == '') {
			jQuery( 'input[name=lsp_post_client_name]' ).val( jQuery( '#title' ).val() );
		}
	}
);




jQuery( '#title' ).blur(
	function(){
		if (jQuery( 'input[name=lsp_post_client_name]' ).val() == '') {
			jQuery( 'input[name=lsp_post_client_name]' ).val( jQuery( '#title' ).val() );
		}
	}
);



jQuery( '#message a' ).hide();
jQuery( document ).ready(
	function(){
			jQuery( '#lsp_meta_box_details .ui-sortable-handle' ).click();
			jQuery( '#lsp_meta_box_details .inside' ).show();
	}
);
