// JavaScript Document
(function() {
    tinymce.PluginManager.add('shortcode_button', function(editor, url) {
		editor.addButton('shortcode_button', {
			text: '',
			tooltip: 'Button',
			icon: 'icon-button',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Button',
					body: [
						{type: 'textbox', name: 'text', label: 'Text'},
						{type: 'textbox', name: 'links', label: 'Link'},
						{type: 'textbox', name: 'icon', label: 'Icon Font Awesome (icon-star)'},
						{type: 'listbox', 
							name: 'size', 
							label: 'Button Size', 
							'values': [
								{text: 'Small', value: 'small'},
								{text: 'Big', value: 'big'},
							]
						},
						{type: 'textbox', name: 'color', label: 'Text Color', value: '#', id:'newcolorpicker_button1'},
						{type: 'textbox', name: 'text_color_hover', label: 'Text Color Hover', value: '#', id:'newcolorpicker_button2'},
						{type: 'textbox', name: 'bgcolor', label: 'Background Color', value: '#', id:'newcolorpicker_button3'},
						{type: 'textbox', name: 'bg_color_hover', label: 'Background Color Hover', value: '#', id:'newcolorpicker_button4'},
					],
					onsubmit: function(e) {
						var uID =  Math.floor((Math.random()*100)+1);
						var icon = ' icon="'+e.data.icon+'"';
						var text = e.data.text;
						var links = e.data.links;
						var size = e.data.size;
						var text_color = 'text_color="'+e.data.color+'"';
						var text_color_hover = 'text_color_hover="'+e.data.text_color_hover+'"';
						var bg_color = 'bg_color="'+e.data.bgcolor+'"';
						var bg_color_hover = 'bg_color_hover="'+e.data.bg_color_hover+'"';
						var shortcode = '[button id="button_'+uID+'" size="'+size+'" link="'+links+'" '+icon+' '+text_color+' '+bg_color+' '+text_color_hover+' '+bg_color_hover+']'+text+'[/button]<br class="nc"/>';
						// Insert content when the window form is submitted
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();