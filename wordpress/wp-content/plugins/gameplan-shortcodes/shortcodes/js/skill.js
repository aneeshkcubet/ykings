// JavaScript Document
(function() {
    tinymce.PluginManager.add('shortcode_skill', function(editor, url) {
		editor.addButton('shortcode_skill', {
			text: '',
			icon: 'icon-skill',
			tooltip: 'Counters',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Counters',
					body: [
						{type: 'listbox', 
							name: 'type', 
							label: 'Skill type', 
							'values': [
								{text: 'Counter Circle', value: 'counter_circle'},
								{text: 'Progress Bar', value: 'progress_bar'},
								{text: 'Content Box', value: 'content_box'},
							]
						},
						{type: 'textbox', name: 'values', label: 'Values (%)'},
						{type: 'textbox', name: 'speed', label: 'Speed (Ex: 1000)'},
						{type: 'listbox', 
							name: 'start_animation', 
							label: 'Start Animation', 
							'values': [
								{text: 'At appearance', value: 'appearance'},
								{text: 'When User scroll to', value: 'scroll'},
							]
						},
						{type: 'textbox', name: 'color_skill', label: 'Progress Color', id: 'colorpicker_skill'},
						{type: 'textbox', name: 'color_skill1', label: 'Background Color', id: 'colorpicker_skill1'},
						{type: 'textbox', name: 'color_skill2', label: 'Text Color', id: 'colorpicker_skill2'},
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
						editor.insertContent('[skill   type="'+e.data.type+'" values="'+e.data.values+'" speed="'+e.data.speed+'" start_animation="'+e.data.start_animation+'" color="'+e.data.color_skill+'" bg_color="'+e.data.color_skill1+'" text_color="'+e.data.color_skill2+'" animation="'+ e.data.animation +'"]<br class="nc"/>Content here<br class="nc"/>[/skill]');
					}
				});
			}
		});
	});
})();
