<?php

namespace sebyc;

use Illuminate\Database\Eloquent\Model;
use DB;

class arbol extends Model
{
     public $fillable = ['genero', 'epiteto', 'categoria_infra', 'infraespecie', 'numero_arbol', 'numero_tallo', 'tallos', 'diametro', 'altura', 'condicion', 'latitud', 'longitud', 'tabla', 'id_tabla'];

    
     public function prepara_arboles() {

     	$query ="
     		TRUNCATE TABLE pimof.dbo.estimaciones
			
			INSERT INTO
				pimof.dbo.estimaciones(id_arboles, d130, ht, created_at, updated_at)
			SELECT
				a.id AS id_arboles
				, a.diametro
				, a.altura
                , GETDATE()
                , GETDATE()
			FROM
				pimof.dbo.arboles a
     	";

     	$arboles = DB::insert($query);

    	if($arboles) {
    		return $this->actualiza_ecoregiones();
    	}
    	return 'error';
     }

    public function actualiza_ecoregiones() {

        $query = "
            UPDATE
                pimof.dbo.arboles
            SET
                clave_ecoregion_n2 = (SELECT TOP 1 eco.CVEECON2 FROM Estimaciones_old.dbo.shape_ecorregiones_2008 eco WHERE geom.STIntersects(geography::Point(latitud, longitud  , 4326  )) = 1)
        ";

        $arboles = DB::update($query);

        if($arboles) {
            return 'hecho';
        }

        return 'error';
    }

    public function cuenta_registros() {

     	$query = "
            SELECT 'arboles' AS tabla, COUNT(*) AS registros FROM pimof.dbo.arboles
            UNION ALL
            SELECT 'modelos' AS tabla, COUNT(*) AS registros FROM pimof.dbo.modelos
            UNION ALL
            SELECT 'densidades' AS tabla, COUNT(*) AS registros FROM pimof.dbo.densidades
            UNION ALL
            SELECT 'fracciones' AS tabla, COUNT(*) AS registros FROM pimof.dbo.fracciones
     	";

     	return DB::select($query);
    }
}
