<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()	
	{
		parent::__construct();
		// $this->load->model('admin/viagem_model');
		$this->load->model('admin/obras_model');
		$this->load->model('admin/cliente_model');
		$this->load->model('admin/funcionarios_model');
		$this->load->model('admin/frotas_model');
		$this->load->model('admin/rdos_model');
	}
	

    public function index(){

		$data['title'] = 'Obras - Dashboard';
		$today = strtotime('today UTC');
        $obras = $this->obras_model->lista_obras_ativas();

		$i = 0;
		foreach($obras as $key => $obra){

			
			$str = file_get_contents('https://api.openweathermap.org/data/2.5/weather?lat='.$obra->lat.'&lon='.$obra->long.'&appid=feb5462396f97b8b52681a625c73a22d&lang=pt_br&units=metric');
			$res = json_decode($str);

			$rdo = $this->rdos_model->lista_rdos_by_obra_id_data($obra->id, $today);
			// echo '<pre>';
			// print_r(date('d/m/Y',$rdo[0]->data));
			// echo '<br>';
			// print_r(date('d/m/Y',$today));
			

			$lista[$i]['obra'] 			= $obra->nome;
			$lista[$i]['data_criacao']  = date('d/m/Y',$rdo[0]->data);
			$lista[$i]['cidade'] 		= $res->name;
			$lista[$i]['h_inicio'] 		= $rdo[0]->horario_inicio_exp;
			$lista[$i]['temperatura'] 	= $res->main->temp;
			$lista[$i]['vento'] 		= $res->wind->speed;
			$lista[$i]['descricao'] 	= $res->weather[0]->description;
			$lista[$i]['icone'] 		= $res->weather[0]->icon;
			
			if(date('d/m/Y',$rdo[0]->data) == date('d/m/Y',$today)){
				$lista[$i]['hoje'] 		= 1;
			}else{
				$lista[$i]['hoje'] 		= 0;
			}


			if(isset($rdo[0]->id)){

				$funcionarios 	= $this->frotas_model->lista_funcionarios_rdo_nome($rdo[0]->id);

				$ii = 0;
				foreach($funcionarios as $key => $fun){

					$frota 	= $this->frotas_model->carro_por_usuario_rdo($rdo[0]->id, $fun->funcionario_id);
					
					$lista[$i]['funcionario'][$ii]['nome'] = $fun->nome;
					$lista[$i]['funcionario'][$ii]['checkin'] = $fun->checkin;
					$lista[$i]['funcionario'][$ii]['checkout'] = $fun->checkout;
					// echo '<pre><br>';
					// print_r($fun);
					// echo '</pre></br>';
					if($frota[0]){
						$lista[$i]['funcionario'][$ii]['carro'] = $frota[0]->nome.' ['.$frota[0]->placa.']';
					}
					$ii++;
				}
				$i++;
			}
			$i++;
		}

		
		$data['obras'] = $lista;
		// p($data);

        $this->load->view('dashboard', $data);
    }



		// $i = 0;
        // foreach ($cats as $cat) {
        //     $cats = $this->pack_model->get_packs_per_cat_id($cat->id);
        //     if (count($cats) > 0) {
        //         $lista[$i]['cat_id'] = $cat->id;
        //         $lista[$i]['cat_name'] = $cat->name;
        //         $ii = 0;
        //         foreach ($cats as $pack) {
        //             $lista[$i]['pack'][$ii]['pack_id'] = $pack->pack_id;
        //             $lista[$i]['pack'][$ii]['order'] = $pack->order;
        //             $lista[$i]['pack'][$ii]['Name'] = $pack->Name;
        //             $lista[$i]['pack'][$ii]['subtitle'] = $pack->subtitle;
        //             $lista[$i]['pack'][$ii]['description'] = $pack->description;
        //             $lista[$i]['pack'][$ii]['valid_for'] = $pack->valid_for;
        //             $lista[$i]['pack'][$ii]['Price'] = $pack->Price;
        //             $lista[$i]['pack'][$ii]['ProgramId'] = $pack->ProgramId;
        //             $lista[$i]['pack'][$ii]['Program'] = $pack->Program;
        //             $ii++;
        //         }
        //         $i++;
        //     }
        // }

}

