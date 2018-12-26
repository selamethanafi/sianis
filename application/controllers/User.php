<?php
class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','fungsi'));
		$pendaftaran_mandiri = $this->config->item('pendaftaran_mandiri');
		if(empty($pendaftaran_mandiri))
			{
			redirect('login');
			}

		else
		{
			$this->load->library(array('session', 'form_validation', 'email'));
			$this->load->database();
			$this->load->model('User_model');
		}

	}
	

	function index()
	{
		$this->register();
	}

    function register()
    {
		//set validation rules
		$this->form_validation->set_rules('username', 'Nama Pengguna (username)', 'trim|required|alpha_dash|min_length[2]|max_length[30]|is_unique[tbllogin.username]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tbllogin.email]');
		$this->form_validation->set_rules('password', 'Kata Sandi', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Kata sandi lagi', 'trim|required|matches[password]');

		if ($this->form_validation->run() == FALSE)
        {
			// fails
			$this->load->view('user_registration_view');
        }
		else
		{
			//insert the user registration details into database
			$options = array('cost' => 8);
			$psw = $this->input->post('password');
			if(!empty($psw))
			{
				$psw = password_hash($psw, PASSWORD_BCRYPT, $options);
			}

			$data = array(
				'username' => nopetik($this->input->post('username')),
				'nama' => nopetik($this->input->post('nama')),
				'email' => nopetik($this->input->post('email')),
				'status' => nopetik($this->input->post('akses')),
				'psw' => $psw
			);
			
			// insert form data into database
			if ($this->User_model->insertUser($data))
			{
				// send email
				$subject = 'Pendaftaran';
				$message = 'Yang terhormat '.$this->input->post('nama').', <br /><br />Anda telah terdaftar di Sianis, mohon bersabar akun Anda akan diaktifkan oleh Admin.<br /> <br /><br />Terima kasih<br />Tim Sianis';
				if ($this->User_model->sendEmail($this->input->post('email'),$subject,$message))
				{
					// successfully sent mail
					$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Anda berhasil mendaftar. Mohon bersabar, akun Anda akan diaktifkan oleh Admin.</div>');
					redirect('user/register');
				}
				else
				{
					// error
					$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Galat, coba lagi nanti!</div>');
					redirect('user/register');
				}
			}
			else
			{
				// error
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Galat, coba lagi nanti!</div>');
				redirect('user/register');
			}
		}
	}
	
	function validasi($hash=NULL)
	{
		if ($this->User_model->Validasi_Email($hash))
		{
			$data['valid'] = '1';
			$this->load->view('email_valid',$data);
		}
		else
		{
			$data['valid'] = '0';
			$this->load->view('email_valid',$data);

		}
	}
	function lupasandi()
	{
		$this->load->view('lupa_sandi');
	}

}
