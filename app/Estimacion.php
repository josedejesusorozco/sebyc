<?php

namespace sebyc;

use Illuminate\Database\Eloquent\Model;
use DB;

class Estimacion extends Model
{

	private $part1 = "
		UPDATE
			pimof.dbo.estimaciones
		SET
			id_modelos = arb.id_moledos
			, ecuacion = arb.ecuacion
			, biomasa_nivel = 
	";

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
						, m.id AS id_moledos
						, m.ecuacion
						, m.diametro_min
						, m.diametro_max
						, m.numero_arboles
						, m.r2
					FROM
						pimof.dbo.arboles a
					INNER JOIN
						pimof.dbo.estimaciones e ON(e.id_arboles = a.id AND e.id_modelos IS NULL)
					INNER JOIN
						pimof.dbo.modelos m ON(
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

	private $str_ecoregion = "
					AND m.clave_ecoregion_n2 = a.clave_ecoregion_n2
	";

	private $str_rango = "
					AND ((a.diametro BETWEEN m.diametro_min AND m.diametro_max) OR (m.diametro_min IS NULL AND m.diametro_max IS NULL))
	";

	private $str_general = "
					AND m.genero IS NULL
					AND m.epiteto IS NULL
					AND m.clave_ecoregion_n2 IS NULL
	";


	public function arbol_decisiones() {
		
		$arboles = $this->nivel1();
	}

	public function nivel1() {

		$query = $this->part1 . '1' . $this->part2 . $this->str_binomio . $this->str_ecoregion . $this->str_rango . $this->part3;

		DB::update($query);
		
		return $this->nivel2();
	}

	public function nivel2() {

		$query = $this->part1 . '2' . $this->part2 . $this->str_binomio. $this->str_rango . $this->part3;

		DB::update($query);
		
		return $this->nivel3();
	}

	public function nivel3() {

		$query = $this->part1 . '3' . $this->part2 . $this->str_genero . $this->str_ecoregion . $this->str_rango . $this->part3;

		DB::update($query);
		
		return $this->nivel4();
	}

	public function nivel4() {

		$query = $this->part1 . '4' . $this->part2 . $this->str_genero . $this->str_rango . $this->part3;

		DB::update($query);
		
		return $this->nivel5();
	}

	public function nivel5() {

		$query = $this->part1 . '5' . $this->part2 . $this->str_genero_spp . $this->str_ecoregion . $this->str_rango . $this->part3;

		DB::update($query);
		
		return $this->nivel6();
	}

	public function nivel6() {

		$query = $this->part1 . '6' . $this->part2 . $this->str_genero_spp . $this->str_rango . $this->part3;

		DB::update($query);
		
		return $this->nivel7();
	}

	public function nivel7() {

		$query = $this->part1 . '7' . $this->part2 . $this->str_binomio . $this->str_ecoregion . $this->part3;

		DB::update($query);
		
		return $this->nivel8();
	}

	public function nivel8() {

		$query = $this->part1 . '8' . $this->part2 . $this->str_binomio . $this->part3;

		DB::update($query);
		
		return $this->nivel9();
	}

	public function nivel9() {

		$query = $this->part1 . '9' . $this->part2 . $this->str_genero . $this->str_ecoregion . $this->part3;

		DB::update($query);
		
		return $this->nivel10();
	}

	public function nivel10() {

		$query = $this->part1 . '10' . $this->part2 . $this->str_genero . $this->part3;

		DB::update($query);
		
		return $this->nivel11();
	}

	public function nivel11() {

		$query = $this->part1 . '11' . $this->part2 . $this->str_genero_spp . $this->str_ecoregion . $this->part3;

		DB::update($query);
		
		return $this->nivel12();
	}

	public function nivel12() {

		$query = $this->part1 . '12' . $this->part2 . $this->str_genero_spp . $this->part3;

		DB::update($query);
		
		return $this->nivel13();
	}

	public function nivel13() {

		$query = $this->part1 . '13' . $this->part2 . $this->str_ecoregion . $this->str_rango . $this->part3;

		DB::update($query);
		
		return $this->nivel14();
	}

	public function nivel14() {

		$query = $this->part1 . '14' . $this->part2 . $this->str_ecoregion . $this->part3;

		DB::update($query);
		
		return $this->nivel15();
	}

	public function nivel15() {

		$query = $this->part1 . '15' . $this->part2 . $this->str_general . $this->part3;

		DB::update($query);

		return 'hecho';
	}

}
