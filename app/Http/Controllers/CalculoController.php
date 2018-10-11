<?php

namespace sebyc\Http\Controllers;

use Illuminate\Http\Request;
use sebyc\Arbol;
use sebyc\Estimacion;
use sebyc\Densidad;
use sebyc\Fraccion;

class CalculoController extends Controller
{
    public function cuenta_registros(Request $request) {

    	$arbol = new Arbol();
    	$resultado = $arbol->cuenta_registros();

    	return response()->json([
            "mensaje" => $resultado
        ]);
    }

    public function prepara_arboles(Request $request) {

    	$arbol = new Arbol();
    	$resultado = $arbol->prepara_arboles();

        return response()->json([
            "mensaje" => $resultado
        ]);

    }

    public function arbol_biomasa() {

    	$estima = new Estimacion();
    	$resultado = $estima->arbol_decisiones();

        return response()->json([
            "mensaje" => $resultado
        ]);
    }

    public function arbol_densidad() {
    	
    	$estima = new Densidad();
    	$resultado = $estima->arbol_decisiones();

        return response()->json([
            "mensaje" => $resultado
        ]);
    }

    public function arbol_carbono() {

    	$estima = new Fraccion();
    	$resultado = $estima->arbol_decisiones();

        return response()->json([
            "mensaje" => $resultado
        ]);
    }

    public function calcula_biomasa() {

        $result = \DB::table('pimof.dbo.estimaciones AS e')
            ->select([
                'id'
                , 'd130'
                , 'ht'
                , 'densidad'
                , 'ecuacion'
                , 'fraccion'
            ])
            ->whereNotNull('d130')
            ->whereNotNull('ht')
            //->whereBetween('id', array($inicio, $fin))
            //->whereNotNull('DB_id_modelo')
            //->take(100)
            ->get();
            //dd($result);

        foreach ($result as $registro) {

        	$ecuacion = str_replace('[d130]', $registro->d130, $registro->ecuacion);
        	$ecuacion = str_replace('[Ht]', $registro->ht, $ecuacion);
        	$biomasa = eval('return ' . $ecuacion . ';');
        	$carbono = eval('return ' . $biomasa * $registro->fraccion . ';');

            $update = \DB::table('pimof.dbo.estimaciones')
                ->where('id', '=', $registro->id)
                ->update([
                    'biomasa' => $biomasa
                    , 'carbono' => $carbono
                    , 'updated_at' => \DB::raw('GETDATE()')
                ]);
        }

        return response()->json([
            "mensaje" => 'hecho'
        ]);
    }

    public function muestra_resultados() {

    	//$datos = array(['name' => 'chuy', 'power' => 'programar'], ['name' => 'chuy', 'power' => 'programar']);
    	//dd($datos);
    	/*https://zinoui.com/blog/css-tables-tutorial*/
    	/*https://vuejs.org/v2/examples/grid-component.html*/
    	/*http://webgenio.com/2017/01/14/40-bonitas-plantillas-tablas-css/*/

    	$result = \DB::table('pimof.dbo.estimaciones AS e')
    		->leftJoin('pimof.dbo.arboles AS a', 'a.id', '=', 'e.id_arboles')
            ->select([
                'e.id'
                , 'a.genero'
                , 'a.epiteto'
                , 'e.d130'
                , 'e.ht'
                , 'e.densidad'
                , 'e.ecuacion'
                , 'e.fraccion'
                , 'e.biomasa'
                , 'e.carbono'
            ])
            ->get();

            //dd($result);
		
		$tabla = '
			<table id="miTablaPersonalizada" class="table table-striped table-responsive">
				<thead>
					<tr>
						<th>id</th>
						<th>Especie</th>
						<th>d130</th>
						<th>ht</th>
						<th>Densidad</th>
						<th>Fracción</th>
						<th>Ecuación</th>
						<th>Carbono</th>
					</tr>
				</thead>
				<tbody>
			';

        foreach ($result as $registro) {

        	$tabla .= '
        			<tr>
						<td>' . $registro->id . '</td>
						<td>' . $registro->genero . ' ' . $registro->epiteto . '</td>
						<td>' . round($registro->d130, 1) . '</td>
						<td>' . round($registro->ht, 1) . '</td>
						<td>' . round($registro->densidad, 2) . '</td>
						<td>' . round($registro->fraccion, 2) . '</td>
						<td>' . $registro->ecuacion . '</td>
						<td><b>' . round($registro->carbono, 2) . '</b></td>
					</tr>
        	';
        }

        $tabla .= '
        		</tbody>
			</table>
			';
		
		return response($tabla);
    }

    public function muestra_resultados2() {

    	//$datos = array(['name' => 'chuy', 'power' => 'programar'], ['name' => 'chuy', 'power' => 'programar']);
    	//dd($datos);

    	$result = \DB::table('pimof.dbo.estimaciones AS e')
    		->leftJoin('pimof.dbo.arboles AS a', 'a.id', '=', 'e.id_arboles')
            ->select([
                'e.id'
                , 'a.genero'
                , 'a.epiteto'
                , 'd130'
                , 'ht'
                , 'densidad'
                , 'ecuacion'
                , 'fraccion'
                , 'biomasa'
                , 'carbono'
            ])
            ->get();
		
		$tabla = '
			<table class="zui-table zui-table-highlight-all">
				<thead>
					<tr>
						<th>id</th>
						<th>Especie</th>
						<th>d130</th>
						<th>ht</th>
						<th>Densidad</th>
						<th>Fraccion</th>
						<th>Ecuacion</th>
						<th>carbono</th>
					</tr>
				</thead>
				<tbody>
			';

        foreach ($result as $registro) {

        	$tabla .= '
        			<tr>
						<td>' . $registro->id . '</td>
						<td>' . $registro->genero . ' ' . $registro->epiteto . '</td>
						<td>' . round($registro->d130, 1) . '</td>
						<td>' . round($registro->ht, 1) . '</td>
						<td>' . round($registro->densidad, 2) . '</td>
						<td>' . round($registro->fraccion, 2) . '</td>
						<td>' . round($registro->ecuacion, 2) . '</td>
						<td>' . round($registro->carbono, 2) . '</td>
					</tr>
        	';



        	$tabla .= '
					</tr>
        	';

        }

        $tabla .= '
        		</tbody>
			</table>
			';
		
		return response($tabla);
    }
}
