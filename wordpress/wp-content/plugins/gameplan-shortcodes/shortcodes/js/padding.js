// JavaScript Document
(function() {
    tinymce.PluginManager.add('shortcode_padding', function(editor, url) {
		editor.addButton('shortcode_padding', {
			text: '',
			icon: 'icon-padding',
			tooltip: 'Margin',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Margin',
					body: [
						{type: 'textbox', name: 'margin-top', label: 'Margin Top (EX: 10px)'},
						{type: 'textbox', name: 'margin-bottom', label: 'Margin Bottom (EX: 10px)'},
						{type: 'listbox', 
							name: 'animation', 
							label: 'Animation', 
							'values': [
								{text: 'No', value: ''},
								{text: 'Top To Bottom', value: 'top-to-bottom'},
								{text: 'Bottom To Top', value: 'bottom-to-top'},
								{text: 'Left To Right', value: 'left-to-right'},
								{text: 'Right To Left', value: 'right-to-left'},
								{text: 'Appear', value: 'appear'}
							]
						},
					],
					onsubmit: function(e) {
						// Insert content when the window form is submitted
						editor.insertContent('[margin   top="'+e.data.margin_top+'" bottom="'+e.data.margin_bottom+'" ]');
					}
				});
			}
		});
	});
})();
