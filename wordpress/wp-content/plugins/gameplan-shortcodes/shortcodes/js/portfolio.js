// JavaScript Document
(function() {
    tinymce.PluginManager.add('shortcode_portfolio', function(editor, url) {
		editor.addButton('shortcode_portfolio', {
			text: '',
			icon: 'icon-portfolio',
			tooltip: 'Portfolio',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Recent post',
					body: [
						{type: 'textbox', name: 'ids', label: 'Project IDs'},
						{type: 'textbox', name: 'number_item', label: 'Number of items'},
						{type: 'listbox', 
							name: 'order', 
							label: 'Order by', 
							'values': [
								{text: 'Date', value: 'created'},
								{text: 'Name', value: 'name'},
							]
						},
						{type: 'listbox', 
							name: 'style', 
							label: 'Styles', 
							'values': [
								{text: 'Modern grid', value: 'modern_grid'},
								{text: 'Classic grid', value: 'classic_grid'},
								{text: 'Carousel', value: 'carousel'},
							]
						},
						{type: 'listbox', 
							name: 'columns', 
							label: 'Portfolio column', 
							'values': [
								{text: '6', value: '6'},
								{text: '5', value: '5'},
								{text: '4', value: '4'},
								{text: '3', value: '3'},
							]
						},
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
						editor.insertContent('[portfolio  ids="'+e.data.ids+'" items="'+e.data.number_item+'" style="'+e.data.style+'" columns="'+e.data.columns+'" animation="'+ e.data.animation +'"]');
					}
				});
			}
		});
	});
})();
