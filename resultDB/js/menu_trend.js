			// When the document is loaded perform an ajax query using jquery
			// Callback is used to return the data when the ajax data is ready
			var oTrendDataTable = null;
			$(document).ready(function() {					
				$.ajax({  
					url: "router.php?headers",  
					cache: false,
					dataType : "json"
					}).done(function( data ) {	
						
						var Table1="";
						var field="";						
						var chosencontent = "";						
												
						Table1 = CreateListBox(data.aaData, "First", "single");						
						Table2 = CreateListBox(data.aaData, "Second", "single");
						Table3 = CreateListBox(data.aaData, "Third", "single");
													
						chosencontent += '<script type="text/javascript">$(".chzn-First").chosen();</script>';
						chosencontent += '<script type="text/javascript">$(".chzn-Second").chosen();</script>';
						chosencontent += '<script type="text/javascript">$(".chzn-Third").chosen();</script>';							
							
						// Add the select option box to the main page
						$('#menu2').append('<button id="buttontrend">Apply filters and show results</button>');
						Table = '<table border="0">';
						Table += '<tr><td>' + Table1 + "</td><td>" +  Table2 + "</td><td>" + Table3 + '</td></tr>';
						Table += '<tr><td id="FirstL"></td><td id="SecondL"></td><td id="ThirdL"></td></tr>';
						Table += '<tr><td id="FirstLType"></td><td id="SecondLType"></td><td id="ThirdLType"></td></tr>';
						Table += '</table>'						
						$('#menu2').append(Table);						
										
						$('#choice2').append(chosencontent);
												
						
						$("#First").chosen().on("change", function(){
							$.ajax({  
								url: "router.php?RetrieveTableField&field=" + $("#First").val(),  
								cache: false,
								dataType : "json"
								}).done(function( data ) {
									$('#FirstL').html(CreateListBox(data, "FirstList", "multiple"));
									$('#FirstLType').html('<script type="text/javascript">$(".chzn-FirstList").chosen();</script>');									
								});						
						});
						
						$("#Second").chosen().on("change", function(){
							$.ajax({  
								url: "router.php?RetrieveTableField&field=" + $("#Second").val(),  
								cache: false,
								dataType : "json"
								}).done(function( data ) {								
									$('#SecondL').html(CreateListBox(data, "SecondList", "multiple"));
									$('#SecondLType').html('<script type="text/javascript">$(".chzn-SecondList").chosen();</script>');									
								});						
						});
						
						$("#Third").chosen().on("change", function(){
							$.ajax({  
								url: "router.php?RetrieveTableField&field=" + $("#Third").val(),  
								cache: false,
								dataType : "json"
								}).done(function( data ) {									
									$('#ThirdL').html(CreateListBox(data, "ThirdList", "multiple"));
									$('#ThirdLType').html('<script type="text/javascript">$(".chzn-ThirdList").chosen();</script>');
								});						
						});
						
						$("#buttontrend").button().on("click", function(){
							if (oTrendDataTable != null) {
								oTrendDataTable.fnDestroy();
								oTrendDataTable = null;
								$('#headers2').empty();
							}							
						   
							var returnObj={};
							/*if ($('#FirstList').val() != null) {
								returnObj[$("#First").val()] = $('#FirstList').val();
							}
							else {
								returnObj[$("#First").val()] = "";
							}
							if ($('#SecondList').val() != null) {
								returnObj[$("#Second").val()] = $('#SecondList').val();
							}
							else {
								returnObj[$("#Second").val()] = "";
							}
							if ($('#ThirdList').val() != null) {
								returnObj[$("#Third").val()] = $('#ThirdList').val();
							}
							else {
								returnObj[$("#Third").val()] = "";
							}*/
							if ($("#First").val() != null) && ($("#Second").val() != null) && ($("#Third").val() != null) ) {
								returnObj[$("#First").val()] = $('#FirstList').val();
								returnObj[$("#Second").val()] = $('#SecondList').val();
								returnObj[$("#Third").val()] = $('#ThirdList').val();									
		                        return DisplaySelectTable(returnObj)  
						    }
	                    } );							 									
					}); 														
								
			} );
