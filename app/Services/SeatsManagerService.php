<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class SeatsManagerService
{
    public function checkAvailableSeats($busNumber, $date, $hour, $passengersCapacity): int
    {
        return $this->checkEmptySeats($busNumber, $date, $hour, $passengersCapacity);
    }

    public function makeReservation($busNumber, $date, $hour, $passengersCapacity): array
    {
        if ($this->checkEmptySeats($busNumber, $date, $hour, $passengersCapacity) > 0) {
            return $this->addReservation($busNumber, $date, $hour);
        } else {
            $response = array('Info' => 'All seats has been reserved');

            return $response;
        }
    }

    private function checkEmptySeats($busNumber, $date, $hour, $passengersCapacity): int
    {
        $count;

        try {
            $count = DB::table('buses')
                ->select(DB::raw('count(*) as count'))
                ->where('busNumber', '=', $busNumber)
                ->where('date', '=', $date)
                ->where('hour', '=', $hour)
                ->get();
        } catch (Exception $e) {
            $response = array();
            $response[] = "Database counting seats error.";
            $response[] = $e;

            return $response;
        }

        return (int) ($passengersCapacity - $count[0]->count);
    }

    private function addReservation($busNumber, $date, $hour): array
    {
        $reservationId;

        try {
            $reservationId = DB::table('buses')->insertGetId(
                ['busNumber' => $busNumber,
                    'date' => $date,
                    'hour' => $hour]);
        } catch (Exception $e) {
            $response = array();
            $response[] = "Reservation failed.";
            $response[] = "Database insert error.";
            $response[] = $e;

            return $response;
        }

        $response = array();
        $response[] = "Reservation has been made succesfully.";
        $response[] = "Reservation id: " . $reservationId;

        return $response;
    }

    public function cancelReservation($reservationId): array
    {
        try {
            DB::table('buses')->delete(['reservationId' => $reservationId]);
        } catch (Exception $e) {
            $response = array();
            $response[] = "Cancelation failed.";
            $response[] = "Database delete error.";
            $response[] = $e;

            return $response;
        }

        $response = array();
        $response[] = "Cancelation has been made succesfully.";
        $response[] = "Cancelation id: " . $reservationId;

        return $response;
    }
}
