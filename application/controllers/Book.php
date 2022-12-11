<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Book extends CI_Controller
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
		$this->load->library('form_validation');
		$this->load->helper('form');

		$data['book_amount'] = $this->input->get('book_amount') ? $this->input->get('book_amount') : 1;

		$query_schedule = "SELECT 
		s.id,
		(SELECT name FROM stations WHERE id = s.station_from_id) AS station_from_name,
		(SELECT name FROM stations WHERE id = s.station_to_id) AS station_to_name,
		s.depart_time,
		s.arrive_time,
		s.price,
		t.name,
		t.class
		FROM 
		schedules s
		JOIN trains t ON s.train_id = t.id
		WHERE 
		s.id = " . $this->input->get('id');
		$data['schedule'] = $this->db->query($query_schedule)->row();

		$query_total_seats = "SELECT t2.seats_number AS total_seats FROM trains t2 JOIN schedules s2 ON s2.train_id = t2.id WHERE s2.id = " . $this->input->get('id');
		$total_seats = ($this->db->query($query_total_seats)->row())->total_seats;

		$query_booked_seats = "SELECT COUNT(*) AS booked_seats FROM seats s3 JOIN bookings_detail bd ON bd.seat_id = s3.id JOIN bookings b2 ON b2.id = bd.booking_id JOIN payments p ON p.booking_id = b2.id WHERE b2.schedule_id = " . $this->input->get('id');
		$booked_seats = ($this->db->query($query_booked_seats)->row())->booked_seats;

		$remaining_seats = $total_seats - $booked_seats;

		// echo json_encode([$total_seats, $booked_seats, $remaining_seats]);die;

		$query_available_seats = "SELECT s.* FROM seats s WHERE s.id NOT IN (SELECT bd.seat_id FROM bookings_detail bd JOIN bookings b ON b.id = bd.booking_id JOIN payments p ON b.id = p.booking_id WHERE b.schedule_id = " . $this->input->get('id') . ") ORDER BY s.id ASC LIMIT " . $remaining_seats;
		// echo ($query_available_seats);die;
		$data['available_seats'] = $this->db->query($query_available_seats)->result();

		// echo json_encode($data);die;
		$this->load->view('book/index', $data);
	}

	public function store()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->db->trans_begin();
		try {
			// check if same seat is selected
			$seat = [];
			foreach ($this->input->post('seat') as $s) {
				$seat[] = $s;
			}
			if (count(array_unique($seat)) < count($seat)) {
				throw new Exception('Penumpang tidak bisa memilih bangku yang sama!');
			}

			$name = [];
			foreach ($this->input->post('name') as $n) {
				$name[] = $n;
			}

			$nik = [];
			foreach ($this->input->post('nik') as $n) {
				$nik[] = $n;
			}

			$data_booking = [
				'user_id' => $this->session->id,
				'schedule_id' => $this->input->post('schedule_id'),
				'booking_time' => date('Y-m-d H:i:s')
			];
			$this->db->insert('bookings', $data_booking);
            $booking_id = $this->db->insert_id();

			$data_booking_detail = [];
			for ($i=0; $i<=($this->input->post('book_amount'))-1; $i++) {
				// var_dump($i);
				$data_booking_detail[] = [
					'booking_id' => $booking_id,
					'name' => $name[$i],
					'nik' => $nik[$i],
					'seat_id' => $seat[$i]
				];
			};
			// die;
			// var_dump($data_booking_detail);die;

			$this->db->insert_batch('bookings_detail', $data_booking_detail);

			if ($this->db->trans_status() === FALSE) {
				throw new Exception('Transaction failed!');
			} else {
				$this->db->trans_commit();
				echo json_encode(['status' => true, 'message' => 'Sukses pesan tiket!']);
			}
		} catch (Exception $e) {
			$this->db->trans_rollback();
			echo json_encode(['status' => false, 'message' => $e->getMessage()]);
		}
	}
}
