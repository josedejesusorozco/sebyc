<?php

namespace sebyc;

use Illuminate\Database\Eloquent\Model;

class Estimacion extends Model
{
	private $part1 = "
		DECLARE @genero NVARCHAR(50), @epiteto NVARCHAR(50), @condicion NVARCHAR(50), @clave_ecoregion_n2 NVARCHAR(10);
		DECLARE @diametro FLOAT, @altura FLOAT, @latitud FLOAT, @longitud FLOAT;

		SELECT
			@genero = a.genero
			, @epiteto = a.epiteto
			, @diametro = a.diametro
			, @altura = a.altura
			, @condicion = a.condicion
			, @latitud = a.latitud
			, @longitud = a.longitud
		FROM
			pimof.dbo.arboles a
		WHERE
			id = @id_arboles

		SELECT
			TOP 1 @clave_ecoregion_n2 = eco.CVEECON2
		FROM
			Estimaciones_old.dbo.shape_ecorregiones_2008 eco
		WHERE
			geom.STIntersects(geography::Point(   @latitud  ,   @longitud  , 4326  )) = 1


		SELECT
			TOP 1 m.*
		FROM
			pimof.dbo.modelos AS m
		WHERE
			1 = 1
			--AND m.genero = @genero
			--AND m.epiteto = @epiteto
			--AND m.epiteto IS NULL
			--AND m.genero IS NULL
			--AND m.clave_ecoregion_n2 = @clave_ecoregion_n2
		ORDER BY
			CAST((m.diametro_max - m.diametro_min)/5 AS INTEGER) DESC
			, m.numero_arboles DESC
			, m.r2 DESC
	";



	private $str_binomio = "
			AND m.genero = @genero
			AND m.epiteto = @epiteto
	";

	private $str_genero = "
			AND m.genero = @genero
			AND m.epiteto IS NULL
	";

	private $str_genero_spp = "
			AND m.genero = @genero
	";

	private $str_ecoregion = "
			AND m.clave_ecoregion_n2 = @clave_ecoregion_n2
	";

	private $str_rango = "
			AND ((@diametro BETWEEN m.diametro_min AND m.diametro_max) OR (m.diametro_min IS NULL AND m.diametro_max IS NULL))
	";

	private $str_general = "
			AND m.genero IS NULL
			AND m.epiteto IS NULL
			AND m.clave_ecoregion_n2 IS NULL
	";



	public function prepara_lista($id_arboles) {

		$this->part1 = str_replace('@id_arboles', $id_arboles, $this->part1);
		return $this->part1 ;

	}

}
