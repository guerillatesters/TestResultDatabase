			// When the document is loaded perform an ajax query using jquery
			// Callback is used to return the data when the ajax data is ready
			function DisplaySelectTable(filters) {
				// Pass filter through to api
				var filter="";
				$.each( filters, function(key, value){
					filter += "&filter[" + key + "]=" + value;
				});								
				$.ajax({  					
					url: "router.php?sortedTableData" + filter,  
					cache: false,
					dataType : "json"
					}).done(function( data ) {						
						// Using jquery iterate through each of the labels returned from the ajax query
						// and add them to the table on the main page
						$.each( data.labels, function(i, n){						    
						    $('#headers2').append('<th>' + n + '</th>');
						});
						
						if (oTrendDataTable != null) 
						{														
							oTrendDataTable.fnReloadAjax( 'router.php?sortedTableData' + filter); 
						}
						else
						{							
							// Pass the table data to datatable (jquery plugin) for further processing
							oTrendDataTable = $('#example2').dataTable( 
									{
									"bProcessing": true,
									"bJQueryUI": true,
									"sPaginationType": "full_numbers",
									"bPaginate": false,
									"iDisplayLength": 50,
									"sDom": 'CT<"H"lfr>tip<"F">', //"sDom": '<"clear">lfripCT',
									"oTableTools": {        
										"aButtons": [
	                                    {
											"sExtends": "xls",
											"sButtonText": "[Save to Excel]"
										}],
										"sSwfPath": "./TableTools-2.1.4/media/swf/copy_csv_xls_pdf.swf"
									},
									"aaData": data.aaData
									});							
						}
					});
								
			};
