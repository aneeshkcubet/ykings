// JavaScript Document
(function() {
    tinymce.PluginManager.add('ct_font_icons', function(editor, url) {
		editor.addButton('ct_font_icons', {
			text: '',
			tooltip: 'Icon',
			icon: 'icon-icon',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Icon',
					body: [
						{type: 'textbox', name: 'icon', label: 'Icon Font Awesome (Ex: icon-leaf)'},
						{type: 'listbox', 
							name: 'effect', 
							label: 'Icon Effect', 
							'values': [
								{text: 'Effect 1', value: 'effect-1'},
								{text: 'Effect 2', value: 'effect-2'}
							]
						},
						{type: 'listbox', 
							name: 'size', 
							label: 'Icon Size', 
							'values': [
								{text: 'Big', value: 'big'},
								{text: 'Small', value: 'small'}
							]
						},
						{type: 'listbox', 
							name: 'type', 
							label: 'Icon type', 
							'values': [
								{text: 'Circle', value: 'circle'},
								{text: 'Square', value: 'square'}
							]
						},
						{type: 'textbox', name: 'links', label: 'Icon link'},
						{type: 'textbox', name: 'color_1', label: 'Icon color', value: '#', id:'newcolorpicker_i1'},
						{type: 'textbox', name: 'color_2', label: 'Background Color', value: '#', id:'newcolorpicker_i2'},
					],
					onsubmit: function(e) {
						var uID =  Math.floor((Math.random()*100)+1);
						var icon = e.data.icon;								
						var effect = e.data.effect;
						var size = 'size="'+e.data.size+'"';
						var type = 'type="'+e.data.type+'"';
						var links = 'link="'+e.data.links+'"';
						var text_color = 'text_color="'+e.data.color_1+'"';
						var bg_color = 'bg_color="'+e.data.color_2+'"';
						
						var shortcode = '[cticon id="icon_'+uID+'" effect="'+effect+'" '+size+' icon="'+icon+'" '+text_color+' '+bg_color+' '+links+' '+type+'][/cticon]<br class="nc"/>';
						// Insert content when the window form is submitted
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();

