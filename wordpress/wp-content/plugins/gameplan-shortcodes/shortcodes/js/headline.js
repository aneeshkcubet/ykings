// JavaScript Document
(function() {
    tinymce.PluginManager.add('shortcode_headline', function(editor, url) {
		editor.addButton('shortcode_headline', {
			text: '',
			icon: 'icon-headline',
			tooltip: 'Headline',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Headline',
					body: [
						{type: 'textbox', name: 'number', label: 'Number of post to show'},
						{type: 'textbox', name: 'cat', label: 'Categories ID'},
						{type: 'textbox', name: 'posttypes', label: 'Post types'},
						{type: 'textbox', name: 'posts_in', label: 'Icon in font Awesome (http://fortawesome.github.io/Font-Awesome/3.2.1/)'},
						{type: 'listbox', 
							name: 'link', 
							label: 'Link', 
							'values': [
								{text: 'Yes', value: 'yes'},
								{text: 'No', value: 'no'},
							]
						},
						{type: 'listbox', 
							name: 'sortby', 
							label: 'Order by', 
							'values': [
								{text: 'Date', value: 'date'},
								{text: 'Title', value: 'title'},
								{text: 'Random', value: 'rand'},
							]
						},
						{type: 'textbox', name: 'color_headline', label: 'Color for icon'},
						{type: 'textbox', name: 'color_headline1', label: 'Color'},
						{type: 'textbox', name: 'color_headline2', label: 'Background'},
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
						editor.insertContent('[headline  number="'+e.data.number+'" posttypes="'+e.data.posttypes+'" icon="'+e.data.icon+'" link="'+e.data.linkshow+'" sortby="'+e.data.sortby+'" coloricon="'+e.data.coloricon+'" color="'+e.data.color+'" background="'+e.data.background+'" animation="'+ animation +'"]');
					}
				});
			}
		});
	});
})();
