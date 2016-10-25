// JavaScript Document
(function() {
    tinymce.PluginManager.add('ct_heading', function(editor, url) {
		editor.addButton('ct_heading', {
			text: '',
			tooltip: 'Heading',
			icon: 'icon-heading',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Heading',
					body: [
						{type: 'textbox', name: 'icon', label: 'Icon Font Awesome (Ex: icon-leaf)'},
						{type: 'textbox', name: 'heading', label: 'Heading text'},
						{type: 'textbox', name: 'color', label: 'Color', value: '#', id:'newcolorpicker_h1'},
						{type: 'listbox', 
							name: 'firstword', 
							label: 'First Word Different', 
							'values': [
								{text: 'Yes', value: 'yes'},
								{text: 'No', value: 'no'}
							]
						},
						{type: 'listbox', 
							name: 'dotted', 
							label: 'Show dotted', 
							'values': [
								{text: 'Yes', value: 'yes'},
								{text: 'No', value: 'no'}
							]
						},
					],
					onsubmit: function(e) {
						var uID =  Math.floor((Math.random()*100)+1);
						// Insert content when the window form is submitted
						editor.insertContent('[heading icon="'+e.data.icon+'" heading="'+e.data.heading+'" color="'+e.data.color+'" firstword="'+e.data.firstword+'" dotted="'+e.data.dotted+'"][/heading]<br class="nc"/>');
					}
				});
			}
		});
	});
})();

