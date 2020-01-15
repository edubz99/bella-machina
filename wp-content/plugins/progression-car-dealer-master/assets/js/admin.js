//var car_dealer = {};

(function ($) {
	"use strict";
	$(function () {

		$('#acf-make .acf-taxonomy-field select').change(function(){
			var makeName = $(this).find('option:selected').text();

			$('#acf-model .acf-taxonomy-field option')
			// first, disable all options
			.attr('disabled','disabled')
			// activate the corresponding models
			.filter('[data-make="'+ $.trim( makeName ) +'"]').removeAttr('disabled')
			// remove previous value
			.parent().val('');
		});

		$('.relationship_list').bind('DOMSubtreeModified', function(){
			var ids = $('.relationship_right a').map(function(){return $(this).attr("data-post_id");}).get();

			if ( ids.length ) {
				$('#featured_vehicles').text( '[featured_vehicles ids="'+ ids.join(',') +'"]' );
			} else {
				$('#featured_vehicles').text( '[featured_vehicles]' );
			}
		});

		$('.quote-delete').on('click', function(){
            if (confirm('Are you sure you want to delete?')) {
                var quote_id = $(this).attr('data-id');
                jQuery.ajax({
                    url: vehicle_quote_ajax.url,
                    type: 'POST',
                    data: ({
                        action: 'tz_vehicle_quote_delete',
                        quoteID: quote_id
                    }),
                    success: function(data){
                        if (data){
                            location.reload();
                        }
                    }
                });
            } else {
                // Do nothing!
            }

		})
		$('.quotes_status').on('change', function(){
            if (confirm('Are you sure you want to change?')) {
                var quote_id = $(this).attr('data-id');
                var quotes_status = $(this).val();
                jQuery.ajax({
                    url: vehicle_quote_ajax.url,
                    type: 'POST',
                    data: ({
                        action: 'tz_vehicle_quote_status',
                        quoteID: quote_id,
                        quotes_status:quotes_status
                    }),
                    success: function(data){
                        if (data){
                            location.reload();
                        }
                    }
                });
            } else {
                // Do nothing!
            }

		})

	});
}(jQuery));