<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mybooking extends CI_Controller
{

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
		$query_mybooking = "SELECT 
		u.name AS user_name, u.email, u.phone, 
		b.booking_time, b.id,
		sc.depart_time, sc.arrive_time, sc.price, 
		t.name AS train_name, t.class, 
		(SELECT st.name FROM stations st WHERE st.id = sc.station_from_id) AS station_from,
		(SELECT st.name FROM stations st WHERE st.id = sc.station_to_id) AS station_to,
		(SELECT COUNT(*) FROM bookings_detail bd WHERE bd.booking_id = b.id) AS ticket_count
		FROM bookings b 
		JOIN schedules sc ON sc.id = b.schedule_id 
		JOIN trains t ON t.id = sc.train_id 
		JOIN users u ON u.id = b.user_id 
		WHERE b.user_id = " . $this->session->id;
		$data['mybooking'] = $this->db->query($query_mybooking)->result();

		$this->load->view('mybooking/index', $data);
	}

	public function detail()
	{
		$query_mybooking = "SELECT 
		u.name AS user_name, u.email, u.phone, 
		b.booking_time, 
		sc.depart_time, sc.arrive_time, sc.price, 
		t.name AS train_name, t.class,
		bd.name AS passenger_name, bd.nik, 
		se.seat_number,
		(SELECT st.name FROM stations st where st.id = sc.station_from_id) AS station_from,
		(SELECT st.name FROM stations st where st.id = sc.station_to_id) AS station_to,
		(SELECT COUNT(*) FROM bookings_detail bd WHERE bd.booking_id = b.id) AS ticket_count
		FROM bookings b 
		JOIN bookings_detail bd ON b.id = bd.booking_id 
		JOIN schedules sc ON sc.id = b.schedule_id 
		JOIN trains t ON t.id = sc.train_id 
		JOIN seats se ON se.id = bd.seat_id 
		JOIN users u ON u.id = b.user_id 
		WHERE b.id = " . $this->input->get('id');
		$data['mybooking'] = $this->db->query($query_mybooking)->result();

		$this->load->view('mybooking/detail', $data);
	}
}
