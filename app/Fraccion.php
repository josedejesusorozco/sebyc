<?php

namespace sebyc;

use Illuminate\Database\Eloquent\Model;
use DB;

class Fraccion extends Model
{

	private $part1 = "
		UPDATE
			pimof.dbo.estimaciones
		SET
			id_fracciones = arb.id_fracciones
			, fraccion = arb.valor
			, fraccion_nivel = ";

	private $part2 = "
		FROM
		(
			SELECT l.* FROM
			(
				SELECT
					ROW_NUMBER() OVER (
						PARTITION BY
							modelo.id_arboles

						ORDER BY
							CAST((modelo.diametro_max - modelo.diametro_min)/5 AS INTEGER) DESC
							, modelo.numero_arboles DESC
							, modelo.r2 DESC

					) AS prioridad, modelo.*
				FROM
				(
					SELECT
						a.id AS id_arboles
						, m.id AS id_fracciones
						, m.valor
						, m.diametro_min
						, m.diametro_max
						, m.numero_arboles
						, m.r2
					FROM
						pimof.dbo.arboles a
					INNER JOIN
						pimof.dbo.estimaciones e ON(e.id_arboles = a.id AND e.id_fracciones IS NULL)
					INNER JOIN
						pimof.dbo.fracciones m ON(
							1 = 1
	";

	private $part3 = "
				)
			) AS modelo
		) AS l
		WHERE
			l.prioridad = 1
	) AS arb
	WHERE
		pimof.dbo.estimaciones.id_arboles = arb.id_arboles
	";

	private $str_binomio = "
					AND (m.genero = a.genero AND m.epiteto = a.epiteto)
	";

	private $str_genero = "
					AND (m.genero = a.genero AND m.epiteto IS NULL)
	";

	private $str_genero_spp = "
					AND m.genero = a.genero
	";

	private $str_general = "
					AND (m.genero IS NULL AND m.epiteto IS NULL)
	";


	public function arbol_decisiones(/*$id_bio_variable_res, $id_inicio, $id_fin*/) {
		
		return $this->nivel1();
	}

	public function nivel1() {

		$query = $this->part1 . '1' . $this->part2 . $this->str_binomio . $this->part3;

		DB::update($query);
		
		return $this->nivel2();
	}

	public function nivel2() {

		$query = $this->part1 . '2' . $this->part2 . $this->str_genero . $this->part3;

		DB::update($query);
		
		return $this->nivel3();
	}

	public function nivel3() {

		$query = $this->part1 . '3' . $this->part2 . $this->str_genero_spp . $this->part3;

		DB::update($query);
		
		return $this->nivel4();
	}

	public function nivel4() {

		$query = $this->part1 . '4' . $this->part2 . $this->str_general . $this->part3;

		DB::update($query);
		
		return 'hecho';
	}
}
