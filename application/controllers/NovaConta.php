<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NovaConta extends CI_Controller {

	public function index()
	{
		$this->load->view('nova-conta');
	}

	public function contabilidade(){
		if(strcmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0){
			$this->load->view('cadastro-contabilidade');
		}else{

			$ip = getenv('REMOTE_ADDR') ?? $_SERVER["REMOTE_ADDR"];
			
			$this->load->helper( array( 'form' ,  'url' ));
			$this->load->library( 'form_validation' );
			$this->load->database();

			$data = array();

			$cnpjPost = $this->input->post('cnpj');

			$data['nomeEmpresa'] = $this->input->post('nomeEmpresa');
			$data['atvEmpresa'] = $this->input->post('atvEmpresa');
			$data['responsavel'] = $this->input->post('responsavel');
			$data['telefone'] = $this->input->post('telefone');

			$data['email'] = $this->input->post('email');
			$data['senha'] = $this->input->post('senha');
			$data['senhaConfirmada'] = $this->input->post('senhaConfirmada');


			$cnpj = preg_replace("/[^0-9]/", "", $cnpjPost);
			$cnpj = filter_var($cnpj, FILTER_SANITIZE_NUMBER_INT);

			$data['cnpj'] = $cnpj;

			$this->form_validation->set_data($data);
					//dados empresa contabilidade
					$this->form_validation->set_rules($ip, 'IP Cliente', 'trim|valid_ip');
					$this->form_validation->set_rules('cnpj', 'CNPJ', 'trim|required|is_unique[receitaws.rec_cnpj]');

					//dados para contato
					$this->form_validation->set_rules('nomeEmpresa', 'Nome da Empresa', 'trim|required');
					$this->form_validation->set_rules('atvEmpresa', 'CNAE Empresa', 'trim|required');
					$this->form_validation->set_rules('responsavel', 'Responsavel da empresa', 'trim|required');
					$this->form_validation->set_rules('telefone', 'Telefone Empresa', 'trim|required');

					//dados de login
					$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[usuarios.cont_email]');
					$this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]');
					$this->form_validation->set_rules('senhaConfirmada', 'Confirmação de senha', 'trim|required|matches[senha]|min_length[6]');
			
				
			if($this->form_validation->run()){
				$this->load->helper('cnpj');
				$this->load->helper('receitaws');
				if(valida_cnpj($cnpj)){
					$json = apiReceita($cnpj);
					if(!empty($json)){
						$objCnpj = processaDadosCnpj($json);
						$this->load->model("receitaws");
						$status = $this->receitaws->inserir($objCnpj);
						if($status){
							$this->load->model("usuarios");
							$this->usuarios->inserirContabilidade($data, $ip);
						}
						//envia e-mail
						$this->load->view('login');
					}else{
						$data['cnpj'] = $cnpjPost;
						$data['erro'] = "alert-validate";
						$data['mensagem'] = "Erro ao consultar os dados. Tente novamente mais tarde!";
						$this->load->view('cadastro-contabilidade', $data);
					}
				}else{
					$data['mensagem'] = "CNPJ inválido!";
					$this->load->view('cadastro-contabilidade', $data);
				}
			}else{
				$data['cnpj'] = $cnpjPost;
				$data['erro'] = "alert-validate";
				$data['mensagem'] = "Este CNPJ já existe.";
				$this->load->view('cadastro-contabilidade', $data);
			}
			//var_dump($this->form_validation->error_array());
		}
	}

	public function contador(){
		if(strcmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0){
			$this->load->view('cadastro-contador');
		}else{

		}
		//$this->load->view('cadastro-contador');
	}
}
