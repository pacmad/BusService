<!DOCTYPE html>
<html>

<head>
    <title>BusService</title>
</head>

<body>

    <h1>BusService</h1>
    <p>Service provides endpoints for managing seats in the buses for sale.</p>
    <p>For now there are avaiable following features:</p>
    <ul>
        <li>checkAvailableSeats: www.busservice.com/api/seats/{busNumber}/{date}/{hour}/{passengersCapacity?}</li>
        <pre>Payload request example: www.busservice.com/api/seats/13/2019-05-15/7:00/30</pre>
        <li>makeReservation: www.busservice.com/api/reservation</li>
        <pre>
        Payload request example:
        {
	      "busNumber": "13",
	      "date": "2019-05-15",
	      "hour": "7:00"
        }
        </pre>
        <li>cancelReservation: www.busservice.com/api/cancelReservation</li>
        <pre>
        Payload request example:
        {
	      "reservationId": "5"
        }
        </pre>
    </ul>
</body>

</html>
