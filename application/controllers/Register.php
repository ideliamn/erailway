<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
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
		$this->load->view('auth/register');
	}

	public function store()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('nik', 'nik', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('phone', 'phone', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');

		$this->db->trans_begin();
		try {
			if ($this->form_validation->run() == false) {
				throw new Exception(validation_errors());
			}

			$check_email = $this->db->get_where('users', ['email' => $this->input->post('email')])->row();
			if ($check_email) {
				throw new Exception('E-mail sudah terdaftar sebelumnya!');
			}

			$check_phone = $this->db->get_where('users', ['phone' => $this->input->post('phone')])->row();
			if ($check_phone) {
				throw new Exception('Nomor handphone sudah terdaftar sebelumnya!');
			}

			$userData = [
				'name' => htmlspecialchars($this->input->post('name')),
				'email' => htmlspecialchars($this->input->post('email')),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'phone' => htmlspecialchars($this->input->post('phone')),
				'nik' => htmlspecialchars($this->input->post('nik')),
			];

			$this->db->insert('users', $userData);

			if ($this->db->trans_status() === FALSE) {
				throw new Exception('Transaction failed!');
			} else {
				$this->db->trans_commit();
				echo json_encode(['status' => true, 'message' => 'Sukses daftar!']);
			}
		} catch (Exception $e) {
			$this->db->trans_rollback();
			echo json_encode(['status' => false, 'message' => $e->getMessage()]);
		}
	}
}
