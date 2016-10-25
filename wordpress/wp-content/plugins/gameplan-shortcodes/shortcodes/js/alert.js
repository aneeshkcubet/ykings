// JavaScript Document
(function() {
    tinymce.PluginManager.add('shortcode_alert', function(editor, url) {
		editor.addButton('shortcode_alert', {
			text: '',
			tooltip: 'Alert',
			icon: 'icon-alert',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Alert',
					body: [
						{type: 'textbox', name: 'message', label: 'Message'},
						{type: 'textbox', name: 'links', label: 'Link'},
						{type: 'textbox', name: 'icon', label: 'Icon Font Awesome (icon-star)'},
						{type: 'listbox', 
							name: 'style', 
							label: 'Style', 
							'values': [
								{text: 'Default', value: ''},
								{text: 'Border Style', value: 'border_style'},
							]
						},
						{type: 'textbox', name: 'color_a1', label: 'Color', value: '#e0e0e0', id:'newcolorpicker_alert1'},
						{type: 'textbox', name: 'color_a2', label: 'Border Color', value: '#e0e0e0', id:'newcolorpicker_alert2'},
						{type: 'textbox', name: 'color_a3', label: 'Background Color', value: '#E9E9E9', id:'newcolorpicker_alert3'},
						{type: 'listbox', 
							name: 'animation', 
							label: 'Animation', 
							'values': [
								{text: 'No', value: ''},
								{text: 'Top to bottom', value: 'top-to-bottom'},
								{text: 'Bottom to top', value: 'bottom-to-top'},
								{text: 'Left to right', value: 'left-to-right'},
								{text: 'Right to left', value: 'right-to-left'},
								{text: 'Appear', value: 'appear'}
							]
						},
					],
					onsubmit: function(e) {
						var uID =  Math.floor((Math.random()*100)+1);
						var icon = (e.data.icon) ? 'icon="'+e.data.icon+'"' : '';
						var color_a1 = e.data.color_a1 ? 'color="'+e.data.color_a1+'"' : '';
						var color_a2 = e.data.color_a2 ? 'bd_color="'+e.data.color_a2+'"' : '';
						var color_a3 = e.data.color_a3 ? 'background="'+e.data.color_a3+'"' : '';
						// Insert content when the window form is submitted
						editor.insertContent('[alert  id="alert_'+uID+'" message="'+e.data.message+'" link="'+e.data.links+'" style="'+e.data.style+'" '+icon+' '+color_a1+' '+color_a2+' '+color_a3+' animation="'+e.data.animation+'"]<br class="nc"/>');
					}
				});
			}
		});
	});
})();

