// JavaScript Document
(function() {
    tinymce.PluginManager.add('shortcode_timeline', function(editor, url) {
		editor.addButton('shortcode_timeline', {
			text: '',
			tooltip: 'Timeline',
			icon: 'icon-timeline',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Smartcontent Box',
					body: [
						{type: 'textbox', name: 'number_item', label: 'Number of Item'},
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
						var numberitem = e.data.number_item;
						var shortcode = '[vc_row][vc_column width=""][timeline animation="'+e.data.animation +'"]';
						for(i=0;i<numberitem;i++){
							j=i+1;
								shortcode+= '[timeline_item  title="timeline title ' + j + '" text="Content '+j+'"]';
							}
						shortcode+= '[/timeline][/vc_column][/vc_row]';
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();
