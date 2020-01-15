var car_dealer = {};

(function ($) {
    /*
     * Cleans the form URL from empty parameters on submit
     */
    $('.submit-vehicle-type').on('change',function(){
        var makeName = $(this).find( 'option:selected' ).attr( 'data-type' );
        $('.submit-vehicle-model option').attr( 'disabled', 'disabled' );
        $('.submit-vehicle-make option')
        // first, disable all options
            .attr( 'disabled', 'disabled' )
            // activate the corresponding models
            .filter( '[data-type="' + $.trim( makeName ) + '"], [value="-1"]' ).removeAttr( 'disabled' )
        // remove previous value
            .parent().val( -1 );

    });
    $('.submit-vehicle-make').on('change',function(){
        var makeName = $(this).find( 'option:selected' ).attr( 'data-make' );

        $('.submit-vehicle-model option')
        // first, disable all options
            .attr( 'disabled', 'disabled' )
            // activate the corresponding models
            .filter( '[data-make="' + $.trim( makeName ) + '"], [value="-1"]' ).removeAttr( 'disabled' )
        // remove previous value
            .parent().val( -1 );
    });

    $('.img_delete').on('click',function(){
        var CarID = $(this).parent().attr('data-id');
        jQuery.ajax({
            url: vehicle_compare_ajax.url,
            type: 'POST',
            data: ({
                action: 'tz_autoshowroom_remove_thumbnail',
                CarID: CarID
            }),
            success: function(data){
                alert(data);
                if (data){
                    $('.img_pre').empty().append('<span>Deleted</span>');
                }
            }
        });
    })

    $('.delete_img_gallery').on('click',function(){
        var imageID = $(this).parent().attr('data-id');
        jQuery.ajax({
            url: vehicle_compare_ajax.url,
            type: 'POST',
            data: ({
                action: 'tz_autoshowroom_remove_image_gallery',
                imageID: imageID
            }),
            success: function(data){
                if (data){
                    $('.img_pre').empty();
                    $('.img_pre').append(data);
                }
            }
        });
    })
    $('.dealer_delete_vehicle').on('click',function(){
        var CarID = $(this).attr('data-id');
        var isGood=confirm('Dialogue');
        if (isGood) {
            $(this).parent().parent().addClass('car_hide');
            jQuery.ajax({
                url: vehicle_compare_ajax.url,
                type: 'POST',
                data: ({
                    action: 'tz_autoshowroom_remove_car',
                    CarID: CarID
                }),
                success: function(data){
                }
            });
        } else {

        }

    })

}(jQuery));