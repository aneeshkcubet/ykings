// JavaScript Document
(function() {
    tinymce.PluginManager.add('shortcode_countdown_clock', function(editor, url) {
		editor.addButton('shortcode_countdown_clock', {
			text: '',
			tooltip: 'Countdown Clock',
			icon: 'icon-countdown',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Countdown Clock',
					body: [
						{type: 'textbox', name: 'year', label: 'Year (ex: 2015)'},
						{type: 'textbox', name: 'month', label: 'Month (ex: 12)'},
						{type: 'textbox', name: 'day', label: 'Day (ex: 31)'},
						{type: 'textbox', name: 'hour', label: 'Hour (ex: 23)'},
						{type: 'textbox', name: 'minute', label: 'Minute (ex: 59)'},
						
						{type: 'textbox', name: 'color_count', label: 'Background Color', value :'#', id:'newcolorpicker_clock1'},
						{type: 'textbox', name: 'color_count2', label: 'Text Color', value :'#', id:'newcolorpicker_clock2'},
						{type: 'textbox', name: 'color_count3', label: 'Unit Color', value :'#', id:'newcolorpicker_clock3'},
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
						var year = e.data.year;
						var month = e.data.month;
						var day = e.data.day;
						var hour = e.data.hour;
						var minute = e.data.minute;
						var bg_color = 'bg_color="'+e.data.color_count+'"';
						var text_color = 'text_color="'+e.data.color_count2+'"';
						var unit_color = 'unit_color="'+e.data.color_count3+'"';
						var animation = e.data.animation;
						var  shortcode= '[countdown   year="'+year+'" month="'+month+'" day="'+day+'" hour="'+hour+'" minute="'+minute+'" '+bg_color+' '+text_color+' '+unit_color+' animation="'+ animation +'"]';
						// Insert content when the window form is submitted
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();


