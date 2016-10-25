// JavaScript Document
(function() {
    tinymce.PluginManager.add('shortcode_divider', function(editor, url) {
		editor.addButton('shortcode_divider', {
			text: '',
			tooltip: 'Divider',
			icon: 'icon-divider',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Divider',
					body: [
						{type: 'listbox', 
							name: 'colorstyle', 
							label: 'Color Style', 
							'values': [
								{text: 'Light', value: 'colorstyle_1'},
								{text: 'Dark', value: 'colorstyle_2'}
							]
						},
						{type: 'listbox', 
							name: 'style', 
							label: 'Divider style', 
							'values': [
								{text: 'Dotted', value: 'style_1'},
								{text: 'Double dotted', value: 'style_2'},
								{text: 'Solid grey', value: 'style_3'},
								{text: '1px Solid grey', value: 'style_4'},
								{text: 'Solid color', value: 'style_5'},
								{text: 'Drop shadow', value: 'style_6'},
							]
						},
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
						{type: 'textbox', name: 'paddingtop', label: 'Padding Top (Ex:20)'},
						{type: 'textbox', name: 'paddingbottom', label: 'Padding Bottom (Ex:20)'},
					],
					onsubmit: function(e) {
						var uID =  Math.floor((Math.random()*100)+1);
						
						// Insert content when the window form is submitted
						editor.insertContent('[divider colorstyle="'+e.data.colorstyle+'" dividerstyle="'+e.data.style+'" paddingtop="'+e.data.paddingtop+'" paddingbottom="'+e.data.paddingbottom+'" animation="'+e.data.animation+'" ]<br class="nc"/>');
					}
				});
			}
		});
	});
})();

