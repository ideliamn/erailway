<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$query_schedule = "SELECT 
		s.id,
		(SELECT name FROM stations WHERE id = s.station_from_id) AS station_from_name,
		(SELECT name FROM stations WHERE id = s.station_to_id) AS station_to_name,
		s.depart_time,
		s.arrive_time,
		s.price,
		t.name,
		t.class,
		(
		(SELECT t2.seats_number FROM trains t2 JOIN schedules s2 ON s2.train_id = t2.id WHERE s2.id = s.id)
		-
		(SELECT COUNT(*) AS booked_seats FROM seats s3 JOIN bookings_detail bd ON bd.seat_id = s3.id JOIN bookings b2 ON b2.id = bd.booking_id JOIN payments p ON p.booking_id = b2.id WHERE b2.schedule_id = s.id
		) AS remaining_seats
		FROM 
		schedules s
		JOIN trains t ON s.train_id = t.id
		WHERE 
		s.station_from_id = ".$this->input->post('station_from')."
		AND s.station_to_id = ".$this->input->post('station_to')."
		AND DATE(s.depart_time) = '".$this->input->post('depart_time')."'";
		$data['schedule'] = $this->db->query($query_schedule)->result();
		// var_dump($data);die;
		$this->load->view('schedule/index', $data);
	}
}
