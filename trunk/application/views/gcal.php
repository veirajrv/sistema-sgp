<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<link rel='stylesheet' type='text/css' href='http://elp21.no-ip.info:4085/SGP/files/fullcalendar/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='http://elp21.no-ip.info:4085/SGP/files/fullcalendar/fullcalendar.print.css' media='print' />
<script src="http://elp21.no-ip.info:4085/SGP/files/js/jquery-1.6.2.min.js" type="text/javascript"> </script>
<script src="http://elp21.no-ip.info:4085/SGP/files/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"> </script>
<script type='text/javascript' src='http://elp21.no-ip.info:4085/SGP/files/fullcalendar/fullcalendar.min.js'></script>
<script type='text/javascript' src='http://elp21.no-ip.info:4085/SGP/files/fullcalendar/gcal.js'></script>
<script type='text/javascript'>

	$(document).ready(function() {
	
		$('#calendar').fullCalendar({
		
			// US Holidays
			//events: 'http://www.google.com/calendar/feeds/usa__en%40holiday.calendar.google.com/public/basic',
			
			eventClick: function(event) {
				// opens events in a popup window
				window.open(event.url, 'gcalevent', 'width=700,height=600');
				return false;
			},
			
			loading: function(bool) {
				if (bool) {
					$('#loading').show();
				}else{
					$('#loading').hide();
				}
			}
			
		});
		
	});

</script>
<style type='text/css'>

	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		}
		
	#loading {
		position: absolute;
		top: 5px;
		right: 5px;
		}

	#calendar {
		width: 900px;
		margin: 0 auto;
		}

</style>
</head>
<body>
<div id='loading' style='display:none'>loading...</div>
<div id='calendar'></div>
</body>
</html>