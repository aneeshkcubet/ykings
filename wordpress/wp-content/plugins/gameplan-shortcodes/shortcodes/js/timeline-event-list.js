// JavaScript Document
(function() {
    tinymce.PluginManager.add('ct_shortcode_timeline_event', function(editor, url) {
		editor.addButton('ct_shortcode_timeline_event', {
			text: '',
			icon: 'icon-timeline-event',
			tooltip: 'Timeline event list',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Timeline event list',
					body: [
						{type: 'textbox', name: 'ids', label: 'Ids'},
						{type: 'textbox', name: 'categories', label: 'Categories'},
						{type: 'listbox', 
							name: 'emonth', 
							label: 'Show Events this month only:', 
							'values': [
								{text: '1', value: '1'},
								{text: '2', value: '2'},
								{text: '3', value: '3'},
								{text: '4', value: '4'},
								{text: '5', value: '5'},
								{text: '6', value: '6'},
								{text: '7', value: '7'},
								{text: '8', value: '8'},
								{text: '9', value: '9'},
								{text: '10', value: '10'},
								{text: '11', value: '11'},
								{text: '12', value: '12'}
							]
						},
						{type: 'textbox', name: 'year', label: 'Year'},
						{type: 'checkbox', 
							name: 'show_past', 
							label: 'Show event past', 
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
						var show_past = e.data.show_past;
						if(show_past){show_past ='yes'}
						else {show_past =''}
						editor.insertContent('[timeline_event  ids="'+e.data.ids+'" categories="'+e.data.categories+'" emonth="'+e.data.emonth+'" year="'+e.data.year+'" eventold="'+show_past+'" animation="'+e.data.animation +'"]');
					}
				});
			}
		});
	});
})();
