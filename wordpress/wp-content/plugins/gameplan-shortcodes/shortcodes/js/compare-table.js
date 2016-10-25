// JavaScript Document
(function() {
    tinymce.PluginManager.add('ct_shortcode_compare_table', function(editor, url) {
		editor.addButton('ct_shortcode_compare_table', {
			text: '',
			tooltip: 'Compare table',
			icon: 'icon-compare-table',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Compare table',
					body: [
						{type: 'textbox', name: 'column', label: 'Number of column', value: '3'},
						{type: 'textbox', name: 'row', label: 'Number of row', value: '5'},
						{type: 'listbox', 
							name: 'style', 
							label: 'Style', 
							'values': [
								{text: 'Style 1', value: 'tb-style-1'},
								{text: 'Style 2', value: 'tb-style-2'},
							]
						},
						{type: 'textbox', name: 'color_compa1', label: 'Background Color highlight', value: '#', id:'newcolorpicker_cp1'},
						{type: 'textbox', name: 'color_compa2', label: 'Background Color', value: '#', id:'newcolorpicker_cp2'},
					],
					onsubmit: function(e) {
						var uID =  Math.floor((Math.random()*100)+1);
						var column = e.data.column;
						var row = e.data.row;
						var style = e.data.style;
						var color = e.data.color_compa1;
						var bg_color = e.data.color_compa2;
						var shortcode = '[comparetable id="comparetable_'+uID+'" class="'+style+'"]<br class="nc"/>';
						for(i=0;i<column;i++){
							if(style != 'compare-table-2'){
								if(i == 0)
									shortcode+= '[c-column class="tb-left" column="'+column+'" '+bg_color+']<br class="nc"/>';
								else if(i == 1)
									shortcode+= '[c-column class="tb-center" column="'+column+'" '+bg_color+']<br class="nc"/>';
								else
									shortcode+= '[c-column  class="tb-right" column="'+column+'" '+bg_color+']<br class="nc"/>';	
							}else{
								if(i == 0)
									shortcode+= '[c-column class="compare-table-feature" column="'+column+'" '+bg_color+']<br class="nc"/>';
								else if(i == 1)
									shortcode+= '[c-column class="tb-left" column="'+column+'" '+bg_color+']<br class="nc"/>';
								else if(i == 2)
									if(column<4)
										shortcode+= '[c-column class="tb-center compare-table-column-2" column="'+column+'" '+bg_color+']<br class="nc"/>';
									else
										shortcode+= '[c-column class="tb-center" column="'+column+'" '+bg_color+']<br class="nc"/>';
								else if(i == 3)
									shortcode+= '[c-column class="compare-table-copper" column="'+column+'" '+bg_color+']<br class="nc"/>';
								else
									shortcode+= '[c-column column="'+column+'" '+bg_color+']<br class="nc"/>';	
							}
							for(j=0; j<row; j++){
								if(style != 'compare-table-2'){
									if(j==0){
										shortcode+= '[c-row class="row-first" ]Content here….[/c-row]<br class="nc"/>';
										shortcode+= '[c-row]Content here….[/c-row]<br class="nc"/>';
									}
									else if(j==1){
										var colorshortcode = '';
										if(color != 'undefined' && color != null)
											colorshortcode = 'color="' + color + '"';
										shortcode+= '[c-row class="hight-light" '+ colorshortcode +']Content here….[/c-row]<br class="nc"/>';	
									}else
										shortcode+= '[c-row]Content here….[/c-row]<br class="nc"/>';
								}else{
									if(j==0 && i!=0)
										shortcode+= '[c-row class="row-first"][/c-row]<br class="nc"/>';
									else if(j==1)
										if(i==0)
											shortcode+= '[c-row class="hight-light" ][/c-row]<br class="nc"/>';
										else{
											var colorshortcode = '';
											if(color != 'undefined' && color != null)
												colorshortcode = 'color="' + color + '"';		
											shortcode+= '[c-row class="hight-light" '+colorshortcode+']Content here….[/c-row]<br class="nc"/>';	
										}
									else if(j!=0)
										shortcode+= '[c-row]Content here….[/c-row]<br class="nc"/>';
								}
							}
							shortcode += '[/c-column]<br class="nc"/>';
						}
						shortcode+= '[/comparetable]<br class="nc"/>';
						// Insert content when the window form is submitted
						editor.insertContent(shortcode);
					}
				});
			}
		});
	});
})();

