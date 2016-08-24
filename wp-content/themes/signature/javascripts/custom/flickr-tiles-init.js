 jQuery(document).ready(function($) {

    
    flickrPull({
        limit: 6,
        target: "#flickrPull",
        size: 'q', // 240
        userId: user_id,
        sort: 'date-posted-desc'
    });
    

}); 