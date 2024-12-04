<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Calendar</title>
    <link rel="stylesheet" href="includes/calendar.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
</head>
<body>
    <div id="calendar"></div>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: function(fetchInfo, successCallback, failureCallback) {
                    $.ajax({
                        url: 'data/getPreventiveCalendar.php',
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            let events = data.map(item => ({
                                title: `${item.equipo}`,
                                start: item.fechaProgramada,
                                extendedProps: {
                                    tecnico: item.nombre
                                }
                            }));
                            successCallback(events);
                        },
                        error: function() {
                            failureCallback();
                        }
                    });
                },
                eventContent: function(arg) {
                    let customHtml = `
                        <div>
                            <div style="font-weight: bold;">${arg.event.title}</div>
                            <div>${arg.event.extendedProps.tecnico}</div>
                        </div>
                    `;
                    return { html: customHtml };
                }
            });
            calendar.render();
        });
    </script>
</body>
</html>
