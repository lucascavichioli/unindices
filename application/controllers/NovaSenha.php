<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NovaSenha extends CI_Controller {

	public function index()
	{
		$this->load->view('nova-senha');
	}

	public function recuperaSenha(){
		if(strcmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0){
			$this->load->view('cadastro-contabilidade');
		}else{
			$email = $this->input->post('email', true);

			$this->load->model("Usuarios");
			$existe = $this->Usuarios->getUser($email);

			//verifica se email existe
			if(!empty($existe)){

				$rand = rand(1, 99999);
				$token = $this->token($email.$rand);

				//cadastra data de solicitação e token
				$this->load->model("TokensSenhas");
				$this->TokensSenhas->inserir($data, $token);

				//monta o link
				// coletamos o schema, Ex: http ou https
				$schema = filter_input(INPUT_SERVER, 'REQUEST_SCHEME') ; 
				// coletamos o host, EX: www.meu-site.com
				$host = filter_input(INPUT_SERVER, 'HTTP_HOST') ;
				// montamos o link, Ex: http://www.meu-site.com/reset/password/token/a1cbas23asda4rt5w6ut
				$link = "{$schema}://{$host}/novasenha/reset/{$token}";

				//envia email
			}
		}
	}

	private function token($string){
		return password_hash($string, PASSWORD_DEFAULT);
	}

	private function validate($token){

		$dateStart = new \DateTime($data->getCreatedAt() );
        $dateNow   = new \DateTime(date('Y-m-d'));

        $dateDiff = $dateStart->diff($dateNow);

        return $dateDiff->days >= 1;
	}

	public function reset($token){
		
		if($this->validate($token)){
			//exibe formulario de alteracao de senha
		}else{
			//exibe mensagem de erro avisando que expirou o prazo
		}

	}

}
