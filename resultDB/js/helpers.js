			function CreateListBox($data, $boxName, $type){
				var chosencontent = "";						
				var boxType = "";
				
				if ($type == "multiple") {
					$boxType = $type;
				};
				var ListBox = '<select data-placeholder="Choose a filter..." class="chzn-' + $boxName + '" name="'+ $boxName + 
				'" id="'+ $boxName + '" style="width:150px;" size="2" ' + $type + ' >';
				$.each( $data, function(key, value){
					ListBox += '<option value=\"' + value + '\">' + value + '</option>';							
				});				
				ListBox += '</select>';
				return ListBox;
			}
						
