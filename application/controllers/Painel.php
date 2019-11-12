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
			
				$usuarioLogin = $this->input->post("usuario", true);
				$senhaLogin = $this->input->post("pass", true);

				$usuario = $this->security->xss_clean($usuarioLogin);
				$senha = $this->security->xss_clean($senhaLogin);

				$this->load->model("usuarios");
				$getUser = $this->usuarios->getUser($usuario);
				if(!empty($getUser)){
					foreach ($getUser as $campo)
					{
						$contId = $campo->cont_id;
						if($campo->cont_rec_cnpj != null){
							$cadastro = $campo->cont_rec_cnpj;
						}else{
							$cadastro = $campo->cont_crc;
						}
						$email = $campo->cont_email;
						$hash = $campo->cont_senha;
					}
					if(password_verify($senha, $hash)){
						$session_data = array(
							'cont_id' => $contId,
							'cadastro' => $cadastro,
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
			$data['tituloGrafico'] = "EMPRESAS CONTRIBUINTES";
			$data['grafico'] = "<canvas id='bigDashboardChart'></canvas>";
			
			$usuario = $this->session->userdata('usuario');
			$this->load->model("usuarios");
			$getUser = $this->usuarios->getUser($usuario);
			$data['contId'] = $getUser[0]->cont_id;
			$this->load->model("empresaclientemodel");
			$getEmp = $this->empresaclientemodel->listaEmpresaCliente($this->session->userdata('cont_id'));
			$data['empresas'] = $getEmp;
			//carrega empresas e atribui a variavel data
			$this->dashboard->show('dashboard', $data);
		}else{
			redirect(base_url() . "painel");
		}
	}

	public function novaEmpresa(){
		if(strcmp($_SERVER['REQUEST_METHOD'], 'POST') === 0){
			if($this->session->userdata('usuario') != '' && $this->session->userdata('logado') === true){
				$ip = getenv('REMOTE_ADDR') ?? $_SERVER["REMOTE_ADDR"];
				//$teste = $this->input->ip_address();
				
				$this->load->helper( array( 'form' ,  'url' ));
				$this->load->library( 'form_validation' );
				$this->load->database();

				$data = array();

				
				
				$data['EMP_NOME'] = $this->input->post('nomeFantasia', true);
				$data['EMP_CNAE'] = $this->input->post('cnae', true);
				$data['EMP_CNAE_SECUNDARIO'] = $this->input->post('cnaeSec', true);
				$data['EMP_QTD_EMP'] = $this->input->post('qtdColaboradores', true);
				$data['EMP_UF'] = $this->input->post('uf', true);
				$data['EMP_EMAIL'] = $this->input->post('email', true);
				$data['EMP_TELEFONE'] = $this->input->post('telefone', true);
				$data['EMP_TELEFONE2'] = $this->input->post('celular', true);

				$this->form_validation->set_data($data);

				$data['EMP_CONT_ID'] = $this->session->userdata('cont_id');

				$this->form_validation->set_rules($ip, 'IP Cliente', 'trim|valid_ip');
				$this->form_validation->set_rules('EMP_NOME', 'Nome Fantasia da Empresa', 'trim|required');
				$this->form_validation->set_rules('EMP_CNAE', 'CNAE', 'trim|required');
				$this->form_validation->set_rules('EMP_CNAE_SECUNDARIO', 'CNAEs Secundários', 'trim');
				$this->form_validation->set_rules('EMP_UF', 'UF', 'trim');
				$this->form_validation->set_rules('EMP_QTD_EMP', 'Quantidade de colaboradores', 'trim|required');
				$this->form_validation->set_rules('EMP_EMAIL', 'E-mail do responsável', 'trim');
				$this->form_validation->set_rules('EMP_TELEFONE', 'Telefone', 'trim');
				$this->form_validation->set_rules('EMP_TELEFONE2', 'Celular', 'trim');

				if($this->form_validation->run()){
					$this->load->model("EmpresaClienteModel");
					$inseriu = $this->EmpresaClienteModel->adicionarEmpresaCliente($data, $ip);
					if($inseriu){
						redirect(base_url() . "painel/dashboard");
					}else{
						redirect(base_url() . "painel/novaEmpresa");
					}
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
				$data['contId'] = $this->session->userdata('cont_id');
				//$this->load->model('Cnae');
				//$data['cnaes'] = $this->Cnae->get();
				$this->dashboard->show('adicionar-empresa.php', $data);
			}else{
				redirect(base_url() . "painel");
			}
		}
	}

		

	public function alterarSenha($contId){
		if(empty($this->session->userdata('usuario'))){
			redirect(base_url() . "painel/login");
		}
		$id = base64_decode($contId);
		$data['title'] = "Alteração de senha";
		$data['contId'] = $id;

		if($_SERVER['REQUEST_METHOD'] !== 'POST'){
			$this->dashboard->show('alterar-senha', $data);
		}else{
			$ip = $this->input->ip_address();
			
			$this->load->helper( array( 'form' ,  'url' ));
			$this->load->library( 'form_validation' );

			$data = array();

			$data['senha'] = $this->input->post('senha', true);
			$data['senha2'] = $this->input->post('confirmarSenha', true);

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('senha2', 'Confirmação de senha', 'trim|required|matches[senha]|min_length[6]');

			if($this->form_validation->run()){
				unset($data['senha2']);
				$this->load->model("Usuarios");
				$this->Usuarios->alterarSenha($ip, $id, $data);

				redirect(base_url() . "painel/dashboard");
			}else{
				$data['alert'] = "alert-validate";
				$data['mensagem'] = "Digite uma senha valida!";
				$this->dashboard->show("alterar-senha", $data);
				//var_dump($this->form_validation->error_array());
			}

		}
	}

	public function dadosCadastrais(){
		if(empty($this->session->userdata('usuario'))){
			redirect(base_url() . "painel/login");
		}

		if($_SERVER['REQUEST_METHOD'] === 'GET'){
			$this->load->model('Usuarios');
			$cont = $this->Usuarios->getDadosCadastrais($this->session->userdata('cont_id'));

			foreach ($cont as $key => $value) {
				foreach ($value as $k => $v) {
					$data[$k] = $v;
				}
			}
			$data['title'] = 'Dados Cadastrais';
			$this->dashboard->show("dados-cadastrais", $data);
		}else{
				$this->load->helper( array( 'form' ,  'url' ));
				$this->load->library( 'form_validation' );
				$id = $this->session->userdata('cont_id');
				$data['CONT_ID'] = $this->input->post('contId', true);
				$data['CONT_EMAIL'] = $this->input->post('email', true);
				$data['CONT_RESPONSAVEL'] = $this->input->post('responsavel', true);
				$data['CONT_TELEFONE'] = $this->input->post('telefone', true);
				$data['CONT_TELEFONE2'] = $this->input->post('celular', true);
				$ip = $this->input->ip_address();

				$this->form_validation->set_data($data);

				$this->form_validation->set_rules('CONT_RESPONSAVEL', 'Responsável', 'trim');
				$this->form_validation->set_rules('CONT_EMAIL', 'E-mail do responsável', 'trim|valid_email');
				$this->form_validation->set_rules('CONT_TELEFONE', 'Telefone', 'trim');
				$this->form_validation->set_rules('CONT_TELEFONE2', 'Celular', 'trim');

				

				if($this->form_validation->run()){
					$this->load->model('Usuarios');
					$atualizou = $this->Usuarios->atualizarDadosCadastrais($ip, $id, $data);
					print_r($atualizou);
					if($atualizou){
						$this->session->unset_userdata('usuario');
						$this->session->set_userdata('usuario', $data['CONT_EMAIL']);
						redirect(base_url() . "painel/dadoscadastrais/". base64_encode($id));
					}else{
						redirect(base_url() . "painel");
					}
				}else{
					$data['title'] = "Dados Cadastrais";
					$data['alert'] = "alert-validate";
					$this->load->model('Usuarios');
					$cont = $this->Usuarios->getDadosCadastrais($this->session->userdata('cont_id'));
					foreach ($cont as $key => $value) {
						foreach ($value as $k => $v) {
							$data[$k] = $v;
						}
					}
					$this->dashboard->show('dados-cadastrais', $data);
				}
			}
	
		}

	public function sair(){
		$this->session->unset_userdata('cont_id');
		$this->session->unset_userdata('usuario');
		$this->session->unset_userdata('logado');
		$this->session->sess_destroy();

		$data['title'] = "Logout";
		$this->load->view('sair', $data);
	}

	public function empresasContribuintes(){
		$this->load->model('EmpresaClienteModel');
		$resultado = $this->EmpresaClienteModel->listaEmpresasContribuintes();

		print json_encode($resultado);
	}

}