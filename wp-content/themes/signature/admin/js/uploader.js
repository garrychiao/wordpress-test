function register_upload_button_event(obj){    
    var parent = jQuery(obj).parent();
    var button = jQuery(this);
    formfield = parent.find('input[type=hidden]').first().attr('name');  
    //tb_show('', 'media-upload.php?post_id=0&type=image&TB_iframe=1&width=640&height=554');
    //alert(formfield);
    wp.media.editor.open(button);
   
    window.send_to_editor = function(html) {       
        imgurl = jQuery('img',html).attr('src');        
        parent.find( jQuery('input[type=hidden]') ).val(imgurl);
        parent.find( jQuery('.image_preview') ).attr('src', imgurl).show();        
        
        tb_remove();
    }
}

function register_remove_button_event(obj){    
    var answer = confirm("Are you sure to remove this image?")	
    if (answer){
        var parent = jQuery(obj).parent();
    
        var txt =  parent.find('input[type=hidden]').first();
        var img = parent.find( jQuery('.image_preview') ).first();
    
        txt.val('');
        img.attr('src', '').hide();
    }
}