var car_dealer = {};

(function ($) {
    /*
     * Cleans the form URL from empty parameters on submit
     */
    $('.vehicle-search-form').submit( function() {
        $(this).find( "input[type='number']" ).filter(function(){
            return ($(this).attr( 'min' ) == $(this).attr( 'value' ) || $(this).attr( 'max' ) == $(this).attr( 'value' ));
        }).attr( 'disabled', 'disabled' );

        $(this).find( "input[type='search']" ).filter(function(){
            return ! $(this).val();
        }).attr( 'disabled', 'disabled' );

        $(this).find( "select" ).filter(function(){
            return ! ( $(this).val() && $(this).val() != '-1');
        }).attr( 'disabled', 'disabled' );


    })

    /*
     * Disables all models that do not fit the selected make
     */
    $('#car_dealer_field_vehicle_type').on('change',function(){
        var makeName = $(this).find( 'option:selected' ).attr( 'data-type' );

        $('#car_dealer_field_make option')
        // first, disable all options
        .attr( 'disabled', 'disabled' )
        // activate the corresponding models
        .filter( '[data-type="' + $.trim( makeName ) + '"], [value="-1"]' ).removeAttr( 'disabled' )
        // remove previous value
        .parent().val( -1 );
    });
    $('#car_dealer_field_make').on('change',function(){
        var makeName = $(this).find( 'option:selected' ).attr( 'data-make' );

        $('#car_dealer_field_model option')
        // first, disable all options
        .attr( 'disabled', 'disabled' )
        // activate the corresponding models
        .filter( '[data-make="' + $.trim( makeName ) + '"], [value="-1"]' ).removeAttr( 'disabled' )
        // remove previous value
        .parent().val( -1 );
    });

}(jQuery));