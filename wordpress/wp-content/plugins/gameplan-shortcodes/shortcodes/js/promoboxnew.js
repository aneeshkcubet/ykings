// JavaScript Document
(function() {
    tinymce.PluginManager.add('shortcode_promoboxnew', function(editor, url) {
		editor.addButton('shortcode_promoboxnew', {
			text: '',
			icon: 'icon-promobox',
			tooltip: 'Promo box',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Promo box',
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
						var shortcode = '[promoboxnew animation="'+e.data.animation+'"]<br class="nc"/>';
						for(i=0;i<number;i++){
							j=i+1;
								shortcode+= '[promoboxnew_item  title="Promo title ' + j + '" background="" link=""]Content here[/promoboxnew_item]<br class="nc"/>';
							}
						shortcode+= '[/promoboxnew]<br class="nc"/>';
						
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();
