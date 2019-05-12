<?php

namespace App\Http\Controllers;

use App\Services;
use Illuminate\Http\Request;

class SeatsManagerController extends Controller
{
    private $seatsManagerService;

    public function __construct()
    {
        $this->seatsManagerService = new Services\SeatsManagerService();
    }

    public function checkAvailableSeats($busNumber, $date, $hour, $passengersCapacity = 25): int
    {
        return $this->seatsManagerService->checkAvailableSeats($busNumber, $date, $hour, $passengersCapacity);
    }

    public function makeReservation(Request $request): array
    {
        if ($request->has('busNumber') and $request->has('date') and $request->has('hour')) {
            $busNumber = $request->post('busNumber');
            $date = $request->post('date');
            $hour = $request->post('hour');
            $passengersCapacity = $request->has('passengersCapacity') ? $request->post('passengersCapacity') : 25;

            return $this->seatsManagerService->makeReservation($busNumber, $date, $hour, $passengersCapacity);
        } else {
            $response = array('Info' => 'Missing one or more parameters',
                'busNumber' => $request->post('busNumber'),
                'date' => $request->post('date'),
                'hour' => $request->post('hour'));

            return $response;
        }
    }

    public function cancelReservation(Request $request): array
    {
        if ($request->has('reservationId')) {
            return $this->seatsManagerService->cancelReservation($request->post('reservationId'));
        } else {
            $response = array('Info' => 'Missing reservationId parameter',
                'reservationId' => $request->post('reservationId'));

            return $response;
        }
    }
}
