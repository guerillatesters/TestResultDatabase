			// When the document is loaded perform an ajax query using jquery.
			// Callback is used to return the data when the ajax data is ready.
            function DisplayTable(filters) {				
				$.ajax({  
					url: "router.php?headers",  
					cache: false,
					dataType : "json"
					}).done(function( data ) {	
						
						// Pass filter through to api
						var filter="";
						$.each( filters, function(key, value){
							filter += "&filter[" + key + "]=" + value;
						});
						
						// If datatable has already been created then only update it
						if (oDataTable != null) 
						{								
							oDataTable.fnReloadAjax( 'router.php?tableData' + filter); 
						}
						else
						{
							// Iterate through all of the header data and add it to the table on the main page
							for (i=0; i < data.aaData.length; i++)
							{												
							   $('#headers').append('<th>' + data.aaData[i] + '</th>');
							}		
							
							// Using the jquery plugin (datatables) perfrom an ajax query of the table data
							oDataTable = $('#example').dataTable( {									
								"bProcessing": true,								
								"sPaginationType": "full_numbers",
								"bPaginate": false,
								"iDisplayLength": 50,
								"sAjaxSource": 'router.php?tableData' + filter,
								"sDom": 'CT<"H"lfr>tip<"F">',  //<"H"Cr><"F"ip>

								"bJQueryUI": true,
								"oTableTools": {        
									"aButtons": [
                                    {
										"sExtends": "xls",
										"sButtonText": "[Save to Excel]"
									}],
									"sSwfPath": "./TableTools-2.1.4/media/swf/copy_csv_xls_pdf.swf"
								}
							} );
						}
						
					});
								
			};
