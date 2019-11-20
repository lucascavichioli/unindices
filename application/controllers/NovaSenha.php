<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NovaSenha extends CI_Controller {

	public function index()
	{
		$this->load->view('nova-senha');
	}

	public function recuperaSenha(){
		if(strcmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0){
			$this->load->view('nova-senha');
		}else{
			$email = $this->input->post('email', true);

			$this->load->model("Usuarios");
			$existe = $this->Usuarios->getUser($email);

			//verifica se email existe
			if(!empty($existe)){

				$rand = rand(1, 9999999);
				$token = str_replace("/", "B", $this->token($email.$rand));

				//cadastra data de solicitação e token
				$this->load->model("TokensSenhas");
				$this->TokensSenhas->inserir($token, $email);

				//monta o link
				// coletamos o schema, Ex: http ou https
				$schema = filter_input(INPUT_SERVER, 'REQUEST_SCHEME') ; 
				// coletamos o host, EX: www.meu-site.com
				$host = filter_input(INPUT_SERVER, 'HTTP_HOST') ;
				// montamos o link, Ex: http://www.meu-site.com/reset/password/token/a1cbas23asda4rt5w6ut
				$link = "{$schema}://{$host}/novasenha/reset/{$token}";

				$message = "Olá";
				$this->load->library('email');
			
				$this->email->from("lucascavica@gmail.com", 'UNINDICES');
				$this->email->subject("Recuperação de Senha");
				$this->email->to("lucasnatan@unifebe.edu.br"); 
				$this->email->message("Olá! <br> <br> <br> Para realizar a alteração de senha, acesse este link: {$link} <br> <br> <br> O link tem validade de 1 dia.");
				$enviado = $this->email->send();

				if($enviado){
					$data['class'] = "alert alert-primary";
					$data['success'] = "Foi enviado um e-mail para redefinição de senha!";
				}else{
					$data['class'] = "alert alert-danger";
					$data['success'] = "Ocorreu um erro ao enviar o e-mail";
				}
				$this->load->view('nova-senha', $data);
			}else{
				$data['class'] = "alert alert-danger";
				$data['success'] = "Este e-mail não está cadastrado";
				$this->load->view('nova-senha', $data);
			}
		}
	}

	private function token($string){
		return password_hash($string, PASSWORD_DEFAULT);
	}

	private function validate($token){

		$this->load->model('TokensSenhas');
		$data = $this->TokensSenhas->get($token);
		
		if(empty($data)){
			redirect(base_url() . "novasenha");
		}
		
		$getDate = $data[0]->data_solicitacao;
		
		$dateStart = new \DateTime($getDate);
		$dateNow   = new \DateTime(date('Y-m-d'));

		$dateDiff = $dateStart->diff($dateNow);

        return $dateDiff->days <= 1;
	}

	public function reset($token){
	
		if($this->validate($token)){
			if(strcmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0){
				$data['token'] = $token;
				$this->load->view('reset-senha', $data);
			}else{

				$this->load->helper( array( 'form' ,  'url' ));
				$this->load->library( 'form_validation' );

				$key = $this->input->post('key', true);
				$ip = $this->input->ip_address();

				$data = array();

				$data['senha'] = $this->input->post('senha', true);
				$data['senha2'] = $this->input->post('senhaConfirma', true);

				
				$this->form_validation->set_data($data);
				$this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]');
				$this->form_validation->set_rules('senha2', 'Confirmação de senha', 'trim|required|matches[senha]|min_length[6]');
				
				if($this->form_validation->run()){
					$this->load->model('TokensSenhas');
					$tokens = $this->TokensSenhas->get($key);
	
					$this->load->model('Usuarios');
					$user = $this->Usuarios->getUser($tokens[0]->email);
					
					unset($data['senha2']);
					$alterou = $this->Usuarios->alterarSenha($ip, $user[0]->cont_id, $data);
					
					if($alterou){
						$data['class'] = "alert alert-success";
						$data['success'] = "Senha alterada com sucesso!";
						$this->load->view('login', $data);
					}else{
						$data['class'] = "alert alert-warning";
						$data['success'] = "Erro de banco de dados! Contate um Administrador";
						$this->load->view('reset-senha', $data);
					}
				}else{
					$data['alert'] = "alert-validate";
					$data['mensagem'] = "Digite uma senha valida!";
					$this->load->view("reset-senha", $data);
					//var_dump($this->form_validation->error_array());
				}
			}
		}else{
			$data['class'] = "alert alert-danger";
			$data['success'] = "Prazo para alteração de senha expirado! Solicite novamente";
			$this->load->view('login', $data);
		}
	}

}
