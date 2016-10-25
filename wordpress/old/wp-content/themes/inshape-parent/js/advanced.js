jQuery(document).ready(function($) {
   
    
    /*------------------------------week labels addable-----------------------------------------------*/
    var label_title = 'Week';
    
    var count = jQuery('.in-shape_content_weeks').find('.div-table-tr').length;
    
    jQuery('.in-shape_content_weeks').find('.div-table-first-body').children('.div-table-tr:first').before('<div class="titledesc">'+label_title+ ' 1</div><div style="clear:both"></div>');
        
    for(var j = 0; j < (count-2); j++)
    {
        jQuery('.in-shape_content_weeks').find('.div-table-first-body').children('.div-table-tr:eq('+(j)+')').after('<div class="titledesc">'+label_title+ ' ' +(j+2)+'</div><div style="clear:both"></div>');
    }
    
    var title_length = jQuery('#in-shape_content_weeks').find('.div-table-first-body').find('.titledesc').length;

    for(var i = 0; i < title_length; i++)
    {
        jQuery('#in-shape_content_weeks').find('.titledesc:eq('+i+')').text(label_title +' '+ (i+1));
    }
        
    jQuery('.in-shape_content_weeks .div-table-last-body .add.button.btq_shopping_add_row').on('click',function(){
        var count = jQuery('.in-shape_content_weeks').find('.div-table-tr').length;
        
        jQuery('.in-shape_content_weeks').find('.div-table-first-body').children('.div-table-tr:last').after('<div class="titledesc">'+label_title+ ' ' +count+'</div><div style="clear:both"></div>');
    });
    
    
    jQuery('#in-shape_content_weeks').children('.div-table-last-body').children('.add.button.btq_shopping_delete_rows').click(function(){
        
        jQuery('#in-shape_content_weeks').find('.div-table-delete-checkbox-row').children('input:checked').each(function(i){
            var title = jQuery(this).parents('.div-table-tr').prev().prev().prev();
            var title2 = jQuery(this).parents('.div-table-tr').prev().prev();
            
            jQuery(this).parents('.div-table-tr').prev().remove();
                        
            if(title.hasClass('titledesc'))
            {
                title.remove();
            }
            else if(title2.hasClass('titledesc')){
                title2.remove();
            }
        });
        
        var title_length = jQuery('#in-shape_content_weeks').find('.div-table-first-body').find('.titledesc').length;

        for(var i = 0; i < title_length; i++)
        {
            jQuery('#in-shape_content_weeks').find('.titledesc:eq('+i+')').text(label_title +' '+ (i+1));
        }
    });
    
    //------------------------------------------------/
    jQuery('.over_thumb ').bind('click', function(){
 
       window.setTimeout(function(){
           var sel = jQuery('#slider_design_type').val(); 
           if(sel == 'home'){
                jQuery('#slider_type').html('<option value="">Choose your slider type</option><option value="custom">Manually, I\'ll upload the images myself</option>');            }
            else if(sel == 'stories' || sel == 'workouts')
            {
                jQuery('#slider_type').html('<option value="">Choose your slider type<option value="categories">Automatically, fetch images from categories</option><option value="posts">Automatically, fetch images from posts</option>');
            }
            else if(sel == 'workout')
            {
                jQuery('#slider_type').html('<option value="">Choose your slider type<option value="posts">Automatically, fetch images from posts</option>');
            }
       },12);
    });

    /*-----------------------------------------*/
            
       //hide /show addable button on click
      if(!$('#in-shape_footer_socials').is(':checked')){
        jQuery('.in-shape_facebook,.in-shape_twitter,.in-shape_vimeo,.in-shape_google').hide();
        }
            $('#in-shape_footer_socials').live('change',function () {
            if(!jQuery(this).is(':checked'))
            {
                jQuery('.in-shape_facebook,.in-shape_twitter,.in-shape_vimeo,.in-shape_google').hide();
            }
            else
            {
                jQuery('.in-shape_facebook,.in-shape_twitter,.in-shape_vimeo,.in-shape_google').show();
            }
        });

jQuery('.tfuse_selectable_code').live('click', function () {
        var r = document.createRange();
        var w = jQuery(this).get(0);
        r.selectNodeContents(w);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(r);
    });

  

    function getUrlVars() {
        urlParams = {};
        var e,
            a = /\+/g,
            r = /([^&=]+)=?([^&]*)/g,
            d = function (s) {
                return decodeURIComponent(s.replace(a, " "));
            },
            q = window.location.search.substring(1);
        while (e = r.exec(q))
            urlParams[d(e[1])] = d(e[2]);
        return urlParams;
    }
	 $("#slider_slideSpeed,#slider_play,#slider_pause,#in-shape_map_zoom").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
            // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
            // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    });

    jQuery('#in-shape_map_lat,#in-shape_map_long').keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 190 || event.keyCode == 110|| event.keyCode == 189 || event.keyCode == 109 || event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
            // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
            // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    });

   

    var options = new Array();
    
 
    
    options['in-shape_workout_weeks'] = jQuery('#in-shape_workout_weeks').val();
    jQuery('#in-shape_workout_weeks').bind('change', function() {
        options['in-shape_workout_weeks'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['in-shape_logo_type'] = jQuery('#in-shape_logo_type').val();
    jQuery('#in-shape_logo_type').bind('change', function() {
        options['in-shape_logo_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    
    options['in-shape_homepage_category'] = jQuery('#in-shape_homepage_category').val();
    jQuery('#in-shape_homepage_category').bind('change', function() {
        options['in-shape_homepage_category'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    //blog page
    options['in-shape_blogpage_category'] = jQuery('#in-shape_blogpage_category').val();
     jQuery('#in-shape_blogpage_category').bind('change', function() {
         options['in-shape_blogpage_category'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
    tfuse_toggle_options(options);

    function tfuse_toggle_options(options)
    {

        jQuery('.categories_select_category,#in-shape_logo,#in-shape_logo_text,#in-shape_logo_subtitle_text,#in-shape_home_page,#in-shape_categories_select_categ,.homepage_category_header_element').parents('.option-inner').hide();
        jQuery('#in-shape_home_page,#in-shape_categories_select_categ,.homepage_category_header_element').parents('.form-field').hide();        
        
         //logo type select
        if(options['in-shape_rating_type']=='esrb')
            jQuery('#in-shape_esrb').parents('.option-inner').show();
        else
            jQuery('#in-shape_pegi').parents('.option-inner').show();

        //logo type select
        if(options['in-shape_logo_type']=='text')
            jQuery('#in-shape_logo_text,#in-shape_logo_subtitle_text').parents('.option-inner').show();
        else
            jQuery('#in-shape_logo').parents('.option-inner').show();

        /*-----------------------------------------------------*/

        //homepage
       if(options['in-shape_homepage_category']=='specific'){
            jQuery('.in-shape_display_type_home').show();
            jQuery('.in-shape_categories_select_categ').next().show();
            jQuery('#in-shape_categories_select_categ').parents('.option-inner').show();
            jQuery('#in-shape_categories_select_categ').parents('.form-field').show();
            
            jQuery('#in-shape_content_top').parents('.postbox').show();
        }
        else if (options['in-shape_homepage_category']=='all')
        {
            jQuery('.in-shape_display_type_home').show();
            jQuery('.in-shape_categories_select_categ').next().show();
            if($('#in-shape_use_page_options').is(':checked')) 
                jQuery('#homepage-header,#homepage-shortcodes').removeAttr('style');
            
            jQuery('#in-shape_content_top').parents('.postbox').show();
        }
        else if(options['in-shape_homepage_category']=='page'){
            jQuery('#in-shape_home_page').parents('.option-inner').show();
            jQuery('#in-shape_home_page').parents('.form-field').show();
            jQuery('.in-shape_categories_select_categ').next().hide();
            
            jQuery('#in-shape_content_top').parents('.postbox').hide();
        } 
        
        
        //blog page
        if(options['in-shape_blogpage_category']=='all'){
            jQuery('.in-shape_categories_select_categ_blog').hide();
        }
        else if(options['in-shape_blogpage_category']=='specific'){
            jQuery('.in-shape_categories_select_categ_blog').show();
        } 
    }
});