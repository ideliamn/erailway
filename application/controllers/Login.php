<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
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
		$this->load->view('auth/login');
	}

	public function store()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->db->trans_begin();
		try {

			$email_or_phone = $this->input->post('email_or_phone', true);
			$password = $this->input->post('password', true);

			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('email', $email_or_phone);
			$this->db->or_where('phone', $email_or_phone);
			$user = $this->db->get()->row();
			// var_dump($this->input->post('email_or_phone'));die;

			if (!$user) {
				throw new Exception("User dengan e-mail atau nomor handphone tersebut tidak ditemukan!");
			}

			if (!password_verify($password, $user->password)) {
				throw new Exception("Password yang anda masukkan salah!");
			}

			$data = [
				'id' => $user->id,
				'name' => $user->name,
				'email' => $user->email,
				'phone' => $user->phone
			];

			$this->session->set_userdata($data);

			$this->db->trans_commit();
			echo json_encode(['status' => true, 'message' => 'Berhasil login!']);
			die;
		} catch (Exception $e) {
			$this->db->trans_rollback();
			echo json_encode(['status' => false, 'message' => $e->getMessage()]);
		}
	}
}
