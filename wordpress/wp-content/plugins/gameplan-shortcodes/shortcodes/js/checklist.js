// JavaScript Document
(function() {
    tinymce.PluginManager.add('ct_checklist', function(editor, url) {
		editor.addButton('ct_checklist', {
			text: '',
			tooltip: 'Checklist',
			icon: 'icon-checklist',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Checklist',
					body: [
						{type: 'textbox', name: 'icon', label: 'Icon of checklist (ex: icon-angle-right)'},
						{type: 'listbox', 
							name: 'type', 
							label: 'Type of checklist', 
							'values': [
								{text: 'Default', value: 'default'},
								{text: 'Boxed', value: 'boxed'}
							]
						},
					],
					onsubmit: function(e) {
						var uID =  Math.floor((Math.random()*100)+1);
						// Insert content when the window form is submitted
						editor.insertContent('[checklist id="checklist_'+uID+'" icon="'+e.data.icon+'" type="'+e.data.type+'"]'+tinymce.activeEditor.selection.getContent()+'[/checklist]<br class="nc"/>');
					}
				});
			}
		});
	});
})();

