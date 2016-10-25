// JavaScript Document
(function() {
    tinymce.PluginManager.add('shortcode_carousel', function(editor, url) {
		editor.addButton('shortcode_carousel', {
			text: '',
			tooltip: 'Carousel',
			icon: 'icon-carousel',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Carousel',
					body: [
						{type: 'textbox', name: 'name', label: 'Name'},
						{type: 'textbox', name: 'number_item', label: 'Number of Item'},
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
						var name = e.data.name;
						var animation = e.data.animation;
						var shortcode = '[carousel  name="'+ name +'" animation="'+animation+'"]<br class="nc"/>';
						for(i=0;i<numberitem;i++){
							j=i+1;
								shortcode+= '[carousel_item  title=" Carousel title ' + j + '" width="200"]Content here[/carousel_item]<br class="nc"/>';
							}
						shortcode+= '[/carousel]<br class="nc"/>';
						// Insert content when the window form is submitted
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();