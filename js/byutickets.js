/* byutickets.js */


// jQuery wrapper
!function ($) {

	$(document).ready(function() {

	 	var url = document.location.toString();
		if ( url.match('#') ) {
		    $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
		} 

		// Change hash for page-reload
		$('.nav-tabs a').on('shown', function (e) {
			var 
				hash = e.target.hash,
				item = $('' + hash),
				id = item.attr('id');

			item.removeAttr('id', '');
		    window.location.hash = e.target.hash;
			item.attr('id', id);
		});

	});

}(window.jQuery);