// JavaScript Document
(function() {
    tinymce.PluginManager.add('shortcode_facelike', function(editor, url) {
		editor.addButton('shortcode_facelike', {
			text: '',
			tooltip: 'Facebook like button',
			icon: 'icon-facebook-like',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Facebook like button',
					body: [
						{type: 'textbox', name: 'links', label: 'Facebook Page URL'},
						{type: 'textbox', name: 'width', label: 'Width (ex:450)'},
						{type: 'listbox', 
							name: 'layout', 
							label: 'Layout Style', 
							'values': [
								{text: 'Standard', value: 'standard'},
								{text: 'Button_count', value: 'button_count'},
								{text: 'Box_count', value: 'box_count'}
							]
						},
						{type: 'listbox', 
							name: 'colorscheme', 
							label: 'Color scheme', 
							'values': [
								{text: 'Light', value: 'light'},
								{text: 'Dark', value: 'dark'}
							]
						},
						{type: 'checkbox', name: 'btnsend', label: 'Send Button'},
						{type: 'checkbox', name: 'btnshow', label: 'Show Faces'},
					],
					onsubmit: function(e) {
						var uID =  Math.floor((Math.random()*100)+1);
						// Insert content when the window form is submitted
						editor.insertContent('[facebook id="facebook_'+uID+'" links="'+e.data.links+'" width="'+e.data.width+'" layout="'+e.data.layout+'"  colorscheme="'+e.data.colorscheme+'" sendbutton="'+e.data.btnsend+'" showfaces="'+e.data.btnshow+'" ]<br class="nc"/>');
					}
				});
			}
		});
	});
})();


