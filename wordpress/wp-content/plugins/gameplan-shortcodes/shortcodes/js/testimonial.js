// JavaScript Document
(function() {
    tinymce.PluginManager.add('shortcode_testimonial', function(editor, url) {
		editor.addButton('shortcode_testimonial', {
			text: '',
			icon: 'icon-testimonial',
			tooltip: 'Testimonial',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Testimonial',
					body: [
						{type: 'textbox', name: 'number', label: 'Number of Item'},
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
						var uID =  Math.floor((Math.random()*100)+1);
						var number = e.data.number;
						var shortcode = '[testimonial]<br class="nc"/>';
						for(i=0;i<number;i++){
							j=i+1;
								shortcode+= '[testimonial_item  title="Testimonial title ' + j + '" name="Testimonial name '+j+' " position="Testimonial position '+j+' " company="Testimonial company '+j+' " animation="'+e.data.animation+'"]Content here[/testimonial_item]<br class="nc"/>';
							}
						shortcode+= '[/testimonial]<br class="nc"/>';

						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();
