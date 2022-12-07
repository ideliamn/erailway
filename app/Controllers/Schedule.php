<?php

namespace App\Controllers;
$request = \Config\Services::request();

class Schedule extends BaseController
{
    public function search()
    {
        $db = db_connect();

        $input = $this->request->getVar();

        $schedule_query = "SELECT 
        s.id,
        (SELECT name FROM stations WHERE id = s.station_from_id) AS station_from_name,
        (SELECT name FROM stations WHERE id = s.station_to_id) AS station_to_name,
        s.depart_time,
        s.arrive_time,
        t.name,
        (
        (SELECT t2.seats_number FROM trains t2 JOIN schedules s2 ON s2.train_id = t2.id WHERE s2.id = s.id)
        -
        (SELECT COUNT(*) AS booked_seats FROM seats s3 JOIN bookings b ON s3.id = b.seat_id WHERE b.schedule_id = s.id)
        ) AS remaining_seats
        FROM 
        schedules s
        JOIN trains t ON s.train_id = t.id
        WHERE 
        s.station_from_id = ?
        AND s.station_to_id = ?
        AND DATE(s.depart_time) = ?";
        
        $schedule_get = $db->query($schedule_query, [$input['station_from'], $input['station_to'], $input['depart_date']]);
        $data['schedule'] = $schedule_get->getResultArray();
        // echo json_encode($data);die;

        return view('schedule/index', $data);
    }
}
