			// When the document is loaded perform an ajax query using jquery
			// Callback is used to return the data when the ajax data is ready
			var gHeaders = new Array();
			var oDataTable = null;
			var gButton = "";
			$(document).ready(function() {				
				$.ajax({  
					url: "router.php?RetrieveTableFields",  
					cache: false,
					dataType : "json"
					}).done(function( data ) {	
						
						var header="";
						var content="";
						var chosen;
						var chosencontent = "";
						gHeaders.length = 0;
						// Data returned is an array of Table column names and their distinct values
						$.each( data, function(key, value){
							
							$first = 0;
							$.each( value, function(secondKey, field){	
								// The first row is the name of the table
								if ($first == 0)
								{
									// Create a select option box for each table column
									gHeaders.push(field);
									header += '<td>' + field + "</td>";
									content += '<td><select data-placeholder="Choose a filter..." class="chzn-select' + field + '" name="' + field + '" id="' + field + '" style="width:150px;" multiple size="2">';
									//content += '<option value=null>Not selected</option>';
									++$first;
									chosen = '$(".chzn-select' + field + '").chosen();';
								}
								else
								{
									// Add the selectable fields here
									content += '<option value=\"' + field + '\">' + field + '</option>';
								}
								
							});
							content += '</select></td>';
							chosencontent += '<script type="text/javascript">' + chosen + '</script>';
						});						

						// Add the select option box to the main page
						$('#menu').append('<button id="buttonres">Apply filters and show results</button>');						
						$('#menu').append('<table border="1" cellspacing="0"><tr >' + header + '</tr><tr >' + content + "</tr></table>");
						$('#choice').append(chosencontent);
						
											
						$("#buttonres").button().on("click", function(){
							if ((gButton == "trend") && (oDataTable != null)) {
								oDataTable.fnDestroy();
								oDataTable = null;
								$('#headers').empty();
							}
							gButton = "normal";
							var returnObj={};
							for (i=0; i < gHeaders.length ; i++)
							{
								if ($('#' + gHeaders[i]).val())
								{								   
							       returnObj[gHeaders[i]] = $('#' + gHeaders[i]).val();							       
								}
							};
                            return DisplayTable(returnObj)
                         } );
						
						
					} );					
			} );
