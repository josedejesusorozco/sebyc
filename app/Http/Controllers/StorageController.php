<?php
namespace sebyc\Http\Controllers;

//use Input;
use Excel;
use Illuminate\Http\Request;
Use sebyc\arboles;
use DB;
use Illuminate\Support\Facades\Input;

class StorageController extends Controller
{
    public function modelo_upload() {

    	/*https://laracasts.com/series/whats-new-in-laravel-5-3/episodes/12*/
    	/*http://librosweb.es/libro/css/capitulo_2/selectores_basicos.html*/

		$file = request()->file('archivo');
		$nombre = utf8_decode($file->getClientOriginalName());
		$destination = base_path() . '/public/uploads';
		$file->move($destination, $nombre);

		return back();
    }

    /*public function importa_arboles() {

		$file = request()->file('archivo');
		$nombre = utf8_decode($file->getClientOriginalName());
		$destination = base_path() . '/public/uploads';
		$file->move($destination, $nombre);

		return back();
    }*/

    public function importa_arboles() {

    	/*http://itsolutionstuff.com/post/laravel-5-import-export-to-excel-and-csv-using-maatwebsite-exampleexample.html*/
    	/*https://stackoverflow.com/questions/31696679/laravel-5-class-input-not-found*/
    	/*http://www.maatwebsite.nl/laravel-excel/docs/getting-started*/
    	/*https://www.youtube.com/watch?v=B_4LTVcod9g*/

		if(Input::hasFile('archivo')){
			$path = Input::file('archivo')->getRealPath();
			$data = Excel::load($path, function($reader) {
			})->get();
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
					$insert[] = [
						'genero' => $value->genero,
						'epiteto' => $value->epiteto,
						'categoria_infra' => $value->categoria_infra,
						'infraespecie' => $value->infraespecie,
						'numero_arbol' => $value->numero_arbol,
						'numero_tallo' => $value->numero_tallo,
						'tallos' => $value->tallos,
						'diametro' => $value->diametro,
						'altura' => $value->altura,
						'condicion' => $value->condicion,
						'latitud' => $value->latitud,
						'longitud' => $value->longitud,
						'tabla' => $value->tabla,
						'id_tabla' => $value->id_tabla
					];
					
					DB::table('arboles')->insert($insert);
					unset($insert);
				}
				/*if(!empty($insert)){
					DB::table('arboles')->insert($insert);
					//dd('Insert Record successfully.');
				}*/
			}
		}

		return back();
    }

    public function importa_modelos() {

		if(Input::hasFile('archivo')){
			$path = Input::file('archivo')->getRealPath();
			$data = Excel::load($path, function($reader) {
			})->get();
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
					$insert[] = [
						'ecuacion' => $value->ecuacion,
						'constante_a' => $value->constante_a,
						'constante_b' => $value->constante_b,
						'constante_c' => $value->constante_c,
						'constante_d' => $value->constante_d,
						'constante_e' => $value->constante_e,
						'constante_f' => $value->constante_f,
						'constante_g' => $value->constante_g,
						'constante_h' => $value->constante_h,
						'constante_i' => $value->constante_i,
						'constante_j' => $value->constante_j,
						'constante_k' => $value->constante_k,
						'genero' => $value->genero,
						'epiteto' => $value->epiteto,
						'clave_ecoregion_n2' => $value->clave_ecoregion_n2,
						'diametro_min' => $value->diametro_min,
						'diametro_max' => $value->diametro_max,
						'numero_arboles' => $value->numero_arboles,
						'r2' => $value->r2,
						'id_modelo' => $value->id_modelo
					];

					DB::table('modelos')->insert($insert);
					unset($insert);
				}

				/*if(!empty($insert)){
					DB::table('modelos')->insert($insert);
					dd('Insert Record successfully.');
				}*/
			}
		}

		return back();
    }

    public function importa_densidades() {

		if(Input::hasFile('archivo')){
			$path = Input::file('archivo')->getRealPath();
			$data = Excel::load($path, function($reader) {
			})->get();
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
					$insert[] = [
						'genero' => $value->genero,
						'epiteto' => $value->epiteto,
						'clave_ecoregion_n2' => $value->clave_ecoregion_n2,
						'valor' => $value->valor,
						'diametro_min' => $value->diametro_min,
						'diametro_max' => $value->diametro_max,
						'numero_arboles' => $value->numero_arboles,
						'r2' => $value->r2,
						'id_modelo' => $value->id_modelo
					];

					DB::table('densidades')->insert($insert);
					unset($insert);
				}
				/*if(!empty($insert)){
					DB::table('densidades')->insert($insert);
					dd('Insert Record successfully.');
				}*/
			}
		}

		return back();
    }

    public function importa_fracciones() {

		if(Input::hasFile('archivo')){
			$path = Input::file('archivo')->getRealPath();
			$data = Excel::load($path, function($reader) {
			})->get();
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
					$insert[] = [
						'genero' => $value->genero,
						'epiteto' => $value->epiteto,
						'clave_ecoregion_n2' => $value->clave_ecoregion_n2,
						'valor' => $value->valor,
						'diametro_min' => $value->diametro_min,
						'diametro_max' => $value->diametro_max,
						'numero_arboles' => $value->numero_arboles,
						'r2' => $value->r2,
						'id_modelo' => $value->id_modelo
					];

					DB::table('fracciones')->insert($insert);
					unset($insert);
				}
				
				/*if(!empty($insert)){
					DB::table('fracciones')->insert($insert);
					dd('Insert Record successfully.');
				}*/
			}
		}

		return back();
    }
}
