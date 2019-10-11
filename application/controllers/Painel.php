<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Painel extends CI_Controller {

	public function index()
	{
		if(!empty($this->session->userdata('usuario'))){
			redirect(base_url() . "painel/dashboard");
		}else{
			$this->load->view('login');
		}
	}

	public function login(){
		if($_SERVER['REQUEST_METHOD'] !== 'POST'){
			$this->load->view('login');
		}else{
			$data['alert'] = "alert-validate";
			$data['mensagem'] = "Usuário ou senha incorretos";

			$this->load->library("form_validation");
			$this->form_validation->set_rules('usuario', 'Usuário', 'required');
			$this->form_validation->set_rules('pass', 'Senha', 'required');

			if($this->form_validation->run()){
			
				$usuario = $this->input->post("usuario", true);
				$senha = $this->input->post("pass", true);

				$this->load->model("usuarios");
				$getUser = $this->usuarios->getUser($usuario);
				if(!empty($getUser)){
					foreach ($getUser as $campo)
					{
						$email = $campo->cont_email;
						$hash = $campo->cont_senha;
					}
					if(password_verify($senha, $hash)){
						$session_data = array(
							'usuario' => $usuario,
							'logado' => true
						);
	
						$this->session->set_userdata($session_data);
						redirect(base_url() . "painel/dashboard");
					}else{
						$this->load->view('login', $data);
					}
				}else{
					$this->load->view('login', $data);
				}
			}else{
				$this->load->view('login', $data);
			}
		}
		
	}

	public function dashboard(){
		if($this->session->userdata('usuario') != '' && $this->session->userdata('logado') === true){
			$data['title'] = "Dashboard";
			$data['activeDashboard'] = "active ";
			$this->dashboard->show('dashboard', $data);
		}else{
			redirect(base_url() . "painel");
		}
	}

	public function novaEmpresa(){
		if(strcmp($_SERVER['REQUEST_METHOD'], 'POST') === 0){
			if($this->session->userdata('usuario') != '' && $this->session->userdata('logado') === true){
				$ip = getenv('REMOTE_ADDR') ?? $_SERVER["REMOTE_ADDR"];
				
				$this->load->helper( array( 'form' ,  'url' ));
				$this->load->library( 'form_validation' );
				$this->load->database();

				$data = array();

				$data['EMP_NOME'] = $this->input->post('nomeFantasia', true);
				$data['EMP_CNAE'] = $this->input->post('cnae', true);
				$data['EMP_QTD_EMP'] = $this->input->post('qtdColaboradores', true);
				$data['EMP_EMAIL'] = $this->input->post('email', true);
				$data['EMP_TELEFONE'] = $this->input->post('telefone', true);
				$data['EMP_TELEFONE2'] = $this->input->post('telefone', true);

				$this->form_validation->set_data($data);

				$this->form_validation->set_rules($ip, 'IP Cliente', 'trim|valid_ip');
				$this->form_validation->set_rules('EMP_NOME', 'Nome Fantasia da Empresa', 'trim|required');
				$this->form_validation->set_rules('EMP_CNAE', 'CNAE', 'trim|required');
				$this->form_validation->set_rules('EMP_QTD_EMP', 'Quantidade de colaboradores', 'trim|required');
				$this->form_validation->set_rules('EMP_EMAIL', 'E-mail do responsável', 'trim|required|is_unique[empresa.emp_email]');
				$this->form_validation->set_rules('EMP_TELEFONE', 'Telefone', 'trim|required');
				$this->form_validation->set_rules('EMP_TELEFONE2', 'Celular', 'trim|required');

				if($this->form_validation->run()){
					$this->load->model("EmpresaCliente");
					$this->EmpresaCliente->adicionarEmpresaCliente($data);
				}else{
					$data['title'] = "Adicionar Empresa";
					$data['activeAddEmpresa'] = "active ";
					$data['alert'] = "alert-validate";
					$this->dashboard->show('adicionar-empresa.php', $data);
				}
			}
		}else{
			if($this->session->userdata('usuario') != '' && $this->session->userdata('logado') === true){
				$data['title'] = "Adicionar Empresa";
				$data['activeAddEmpresa'] = "active ";
				$this->dashboard->show('adicionar-empresa.php', $data);
			}else{
				redirect(base_url() . "painel");
			}
		}
	}

	public function sair(){
		$this->session->unset_userdata('usuario');
		$this->session->unset_userdata('logado');
		$this->session->sess_destroy();
		$this->load->view('sair');
	}
}