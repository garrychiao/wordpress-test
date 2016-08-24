 jQuery(document).ready(function($) {

    $("#flickr-gallery").each(function(){
        var api_key = $(this).data('api-key');
        var user_id = $(this).data('user');
        var secret_key = $(this).data('secrey-key');
        var photoset_id = $(this).data('photoset-id');

        $(this).flickrGallery({
                //FLICKR API KEY
                Key: api_key,
                //Secret
                Secret: secret_key,
                //FLICKR user ID
                User: user_id,
                //Flickr PhotoSet ID
                PhotoSet: photoset_id,
                /*-- VIEWBOX SETTINGS --*/ 
                Speed   : 400,    //Speed of animations
                navigation  : 1,    //(true) Navigation (arrows)
                keyboard  : 1,    //(true) Keyboard navigation 
                numberEl  : 1     //(true) Number elements
        });
    });
    

}); 