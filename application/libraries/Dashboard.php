<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
// Dashboard adaptada de criative - tim
// https://demos.creative-tim.com/now-ui-dashboard/docs/1.0/getting-started/introduction.html

class Dashboard {
 
		function show($view, $data=array()){
 
			$CI = & get_instance();
 
			// carrega cabeçalho
			$CI->load->view('cabecalho',$data);

			// carrega menu lateral esquerdo
			$CI->load->view('menu-lateral',$data);
 
			// carrega corpo da página
			$CI->load->view($view,$data);
 
			// carrega scripts
			$CI->load->view('scripts',$data);
		}
}
