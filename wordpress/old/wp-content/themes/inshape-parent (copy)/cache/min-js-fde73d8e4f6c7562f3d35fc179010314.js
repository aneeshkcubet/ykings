jQuery(document).ready(function(){var tfMegamenu={draggedNavsHtml:null,domElements:{menuContainer:jQuery('.menu'),level0Switches:jQuery('.tf_megamenu_nav_parent_switch'),},initDraggedDefaults:function(){jQuery.ajax({url:ajaxurl,type:'post',dataType:'json',data:{action:'tfuse_ajax_megamenu',tf_action:'ajax_optcontainer_defaults'},beforeSend:function(){},success:function(data){tfMegamenu.draggedNavsHtml=data;}});},domElementsInit:function(){this.domElements.menuContainer.on('tfuse_textarea_check',function(){jQuery(this).find('p[class="description"] textarea').each(function(){var $textarea=jQuery(this);$textarea.css('width','98%');$textarea.closest('.description').css('width','100%');});});this.domElements.menuContainer.on('change','.tf_megamenu_nav_parent_switch',function(){jQuery(this).trigger('megamenu_switch_activated');});this.domElements.menuContainer.on('megamenu_switch_activated','.tf_megamenu_nav_parent_switch',function(){var show=this.checked;jQuery(this).closest('.menu-item').nextAll().each(function(){$this=jQuery(this);if($this.attr('class').indexOf('menu-item-depth-0')!==-1){return false;}
if($this.attr('class').indexOf('menu-item-depth-1')!==-1){if(show){$this.find('.tf_megamenu_optcontainer').show();}else{$this.find('.tf_megamenu_optcontainer').hide();}}});});this.domElements.menuContainer.on('change','.tf_megamenu_template_select',function(){$this=jQuery(this);var optionsContainer=$this.closest('.tf_megamenu_optcontainer').find('.tf_megamenu_uncommun_opts');var template=$this.val();var name=$this.attr('name');var navId=name.substring(name.indexOf('[')+1,name.indexOf(']'));jQuery.ajax({url:ajaxurl,type:'post',dataType:'html',data:{action:'tfuse_ajax_megamenu',tf_action:'ajax_template_chooser',tf_megamenu_template:template,tf_megamenu_nav_id:navId},beforeSend:function(){},success:function(data){optionsContainer.find('.tf_megamenu_template_options').remove();optionsContainer.prepend(data);jQuery('.menu').trigger('tfuse_textarea_check');TFE.trigger('tf-megamenu-template-changed');}});});},onDomReady:function(){this.domElements.level0Switches.trigger('megamenu_switch_activated');this.domElements.menuContainer.trigger('tfuse_textarea_check');setInterval(tfMegamenu.refreshMenuState,1000);},refreshMenuState:function(){jQuery('.menu-item-depth-0').find('.tf_megamenu_optcontainer').show();tfMegamenu.domElements.level0Switches.trigger('megamenu_switch_activated');},wpOverrides:function(){if(typeof wpNavMenu===undefined){return;}
wpNavMenu.addItemToMenu=function(menuItem,processMethod,callback){var menu=jQuery('#menu').val(),nonce=jQuery('#menu-settings-column-nonce').val();processMethod=processMethod||function(){};callback=callback||function(){};params={'action':'tfuse_ajax_megamenu','tf_action':'ajax_add_menu_item','menu':menu,'menu-settings-column-nonce':nonce,'menu-item':menuItem};jQuery.post(ajaxurl,params,function(menuMarkup){var ins=jQuery('#menu-instructions');processMethod(menuMarkup,params);if(!ins.hasClass('menu-instructions-inactive')&&ins.siblings().length)
ins.addClass('menu-instructions-inactive');callback();});};wpNavMenu.eventOnClickMenuSave=function(clickedEl){jQuery('.menu-item').each(function(index,element){$this=jQuery(this);var elementId=$this.attr('id');var navId=elementId.substring(elementId.lastIndexOf('-')+1);var megamenuOptContainer=$this.find('.tf_megamenu_optcontainer');megamenuOptContainer.find(':input').attr('name',function(index,oldName){return(oldName!==undefined?oldName.replace(/%%NAV_ID%%/,navId):oldName);});});var locs='',menuName=jQuery('#menu-name'),menuNameVal=menuName.val();if(!menuNameVal||menuNameVal==menuName.attr('title')||!menuNameVal.replace(/\s+/,'')){menuName.parent().addClass('form-invalid');return false;}
jQuery('#nav-menu-theme-locations select').each(function(){locs+='<input type="hidden" name="'
+this.name+'" value="'
+jQuery(this).val()+'" />';});jQuery('#update-nav-menu').append(locs);this.menuList.find('.menu-item-data-position').val(function(index){return index+1;});window.onbeforeunload=null;return true;};var modigyMegaMenuOpts=function(element,depth){var html=depth>1?'':tfMegamenu.draggedNavsHtml['depth_'+depth];jQuery(element).find('.tf_megamenu_optcontainer').html(html);};jQuery.fn.extend({updateDepthClass:function(current,prev){return this.each(function(){var t=jQuery(this);prev=prev||t.menuItemDepth();jQuery(this).removeClass('menu-item-depth-'+prev).addClass('menu-item-depth-'+current);modigyMegaMenuOpts(this,current);});},shiftDepthClass:function(change){return this.each(function(index,element){var t=jQuery(this),depth=t.menuItemDepth();jQuery(this).removeClass('menu-item-depth-'+depth).addClass('menu-item-depth-'+(depth+change));modigyMegaMenuOpts(this,depth+change);});}});},init:function(){this.initDraggedDefaults();this.domElementsInit();this.wpOverrides();this.onDomReady();}};tfMegamenu.init();});
/* end of /wp-content/themes/inshape-parent/framework/extensions/megamenu/static/js/megamenu_admin.js */
