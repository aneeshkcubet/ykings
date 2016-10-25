// JavaScript Document
(function() {
    tinymce.PluginManager.add('shortcode_member', function(editor, url) {
		editor.addButton('shortcode_member', {
			text: '',
			icon: 'icon-member',
			tooltip: 'Member',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Member',
					body: [
						{type: 'textbox', name: 'id', label: 'ID Member'},
						{type: 'textbox', name: 'color-member', label: 'Background Color', id: 'colorpicker_member'},
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
						editor.insertContent('[member  id="'+e.data.id+'" bg_color="'+e.data.bg_color+'" animation="'+ e.data.animation +'"]');
					}
				});
			}
		});
	});
})();
