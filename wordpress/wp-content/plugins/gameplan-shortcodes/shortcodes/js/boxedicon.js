// JavaScript Document
(function() {
    tinymce.PluginManager.add('shortcode_boxed', function(editor, url) {
		editor.addButton('shortcode_boxed', {
			text: '',
			tooltip: 'Boxed Icon',
			icon: 'icon-boxed-icon',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Boxed Icon',
					body: [
						{type: 'textbox', name: 'number_item', label: 'Number of Item'},
						{type: 'listbox', 
							name: 'style', 
							label: 'Style', 
							'values': [
								{text: 'Fancy Box', value: 'style-1'},
								{text: 'Solid Box', value: 'style-2'},
								{text: 'Classic Box', value: 'style-3'}
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
					],
					onsubmit: function(e) {
						var uID =  Math.floor((Math.random()*100)+1);
						var numberitem = e.data.number_item;
						var style = e.data.style;
						var animation = e.data.animation;
						var shortcode = '[boxed style="'+style+'" animation="'+animation+'"]<br class="nc"/>';
						for(i=0;i<numberitem;i++){
							j=i+1;
								shortcode+= '[boxed_item  title="Boxed title ' + j + '" link="Boxed link '+j+' " color_tt="" bg_ttcolor="" bg_color="" icon="icon-star"]Content here[/boxed_item]<br class="nc"/>';
							}
						shortcode+= '[/boxed]<br class="nc"/>';
						// Insert content when the window form is submitted
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();

