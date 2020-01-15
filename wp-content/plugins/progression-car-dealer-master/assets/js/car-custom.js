var car_dealer = {};

(function ($) {
    /*
     * Cleans the form URL from empty parameters on submit
     */
    $('.submit-vehicle-type').on('change',function(){
        var makeName = $(this).find( 'option:selected' ).attr( 'data-type' );

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

}(jQuery));