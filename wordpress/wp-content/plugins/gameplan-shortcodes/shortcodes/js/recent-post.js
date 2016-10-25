// JavaScript Document
(function() {
    tinymce.PluginManager.add('shortcode_recentpost', function(editor, url) {
		editor.addButton('shortcode_recentpost', {
			text: '',
			icon: 'icon-recentpost',
			tooltip: 'Recent post',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Recent post',
					body: [
						{type: 'listbox', 
							name: 'showmetadata', 
							label: 'Show metadata', 
							'values': [
								{text: 'Yes', value: '1'},
								{text: 'No', value: '0'},
							]
						},
						{type: 'textbox', name: 'count', label: 'Posts count'},
						{type: 'textbox', name: 'width', label: 'Width per post(Width of post in slide (> 100). Ex: 260)'},
						{type: 'textbox', name: 'posttypes', label: 'Post types'},
						{type: 'textbox', name: 'posts_in', label: 'Post/Page IDs'},
						{type: 'textbox', name: 'categories', label: 'Categories'},
						{type: 'listbox', 
							name: 'orderby', 
							label: 'Order by', 
							'values': [
								{text: 'Date', value: 'date'},
								{text: 'Author', value: 'author'},
								{text: 'Modified', value: 'modified'},
								{text: 'Random', value: 'rand'},
								{text: 'Comment count', value: 'comment_count'},
								{text: 'Menu order', value: 'menu_order'},
							]
						},
						{type: 'listbox', 
							name: 'orderby_da', 
							label: 'Order', 
							'values': [
								{text: 'Descending', value: 'DESC'},
								{text: 'Ascending', value: 'ASC'},
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
						editor.insertContent('[recent-post showmetadata="'+e.data.showmetadata+'" count="'+e.data.count+'" width="'+e.data.width+'"  posts_in="'+e.data.posts_in+'" orderby="'+e.data.orderby+'" order="'+e.data.orderby_da+'" posttypes="'+e.data.posttypes+'" categories="'+e.data.categories+'" animation="'+ e.data.animation +'"]');
					}
				});
			}
		});
	});
})();
