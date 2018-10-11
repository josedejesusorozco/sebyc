SELECT
	TOP 1000
	arb.genero
	, arb.epiteto
	, arb.categoria_infra
	, arb.infraespecie
	, arb.numero_arbol
	, arb.numero_tallo
	, arb.tallos
	, arb.diametro
	, arb.altura
	, CASE WHEN arb.id_condicion IS NULL OR arb.id_condicion = 1 THEN 'Vivo' WHEN arb.id_condicion = 2 THEN 'Muerto' ELSE 'Tocón' END AS condicion
	, arb.latitud
	, arb.longitud
	, arb.tabla
	, arb.id_arbol AS id_tabla
FROM
(
	SELECT
		'caracteristica_arbolado' AS tabla
		, CASE WHEN ls.anio_levantamiento < 2009 THEN  1  WHEN ls.anio_levantamiento BETWEEN 2009 AND 2013 THEN  2 ELSE 3 END AS ciclo
		, CASE WHEN ls.anio_levantamiento < 2009 THEN  'Muestreo'  WHEN ls.anio_levantamiento BETWEEN 2009 AND 2013 THEN  'Remuestreo' ELSE 'Recuperación' END AS periodo
		, u.folio_historico AS conglomerado
		, us.folio AS sitio
		, ls.anio_levantamiento
		, a.id AS id_arbol
		, a.numero_arbol
		, a.numero_tallo
		, a.numero_tallos_pencas AS tallos
		, a.id_condicion
		, ISNULL(IIF(g.nombre = '-', '', g.nombre), '') AS genero
		, ISNULL(IIF(e.nombre = '-', '', e.nombre), '') AS epiteto
		, ISNULL(IIF(ev.tipo = '-', '', ev.tipo), '') AS categoria_infra
		, ISNULL(IIF(ev.nombre = '-', '', ev.nombre), '') AS infraespecie
		, LTRIM(RTRIM(ISNULL(g.nombre, '') + ' ' + IIF(e.nombre = '-', '', e.nombre) + ' ' + ISNULL(ev.tipo, '') + ' ' + ISNULL(ev.nombre, ''))) AS especie
		, a.diametro_altura_pecho AS diametro
		, a.altura_total AS altura
		, c.lat AS latitud
		, c.long AS longitud
	FROM
		MuestreoNacional.Sistema.unidad_muestreo u
	INNER JOIN
		MuestreoNacional.Sistema.unidad_muestreo us ON (us.id_unidad_muestreo_padre = u.id)
	INNER JOIN
		MuestreoNacional.Sistema.levantamiento ls ON (ls.id_unidad_muestreo = us.id)
	INNER JOIN
		MuestreoNacional.Satelites.caracteristica_arbolado a ON (a.id_levantamiento = ls.id)
	LEFT JOIN
		MuestreoNacional.Catalogos.especie e ON (e.id = a.id_especie)
	LEFT JOIN
		MuestreoNacional.Catalogos.genero g ON (g.id = e.id_genero)
	LEFT JOIN
		MuestreoNacional.Catalogos.especie_variedad ev ON (ev.id_especie = e.id)
	LEFT JOIN	
		MuestreoNacional.Sistema.coordenada c ON (c.id = ls.id_coordenada)
	WHERE
		u.id_proyecto = 1
		AND ls.anio_levantamiento BETWEEN 2004 AND 2014

		AND (a.diametro_altura_pecho IS NOT NULL AND a.diametro_altura_pecho <> 0)
		AND (a.altura_total IS NOT NULL AND a.altura_total <> 0)
		AND a.id_condicion = 1

	UNION

	SELECT
		'caracteristica_vegetacion_mayor' AS tabla
		, CASE WHEN ls.anio_levantamiento < 2009 THEN  1  WHEN ls.anio_levantamiento BETWEEN 2009 AND 2013 THEN  2 ELSE 3 END AS ciclo
		, CASE WHEN ls.anio_levantamiento < 2009 THEN  'Muestreo'  WHEN ls.anio_levantamiento BETWEEN 2009 AND 2013 THEN  'Remuestreo' ELSE 'Recuperación' END AS periodo
		, u.folio_historico AS conglomerado
		, us.folio AS sitio
		, ls.anio_levantamiento
		, v.id AS id_arbol
		, v.numero_arbol
		, v.numero_tallo
		, v.numero_tallos AS tallos
		, v.id_condicion
		, ISNULL(IIF(g.nombre = '-', '', g.nombre), '') AS genero
		, ISNULL(IIF(e.nombre = '-', '', e.nombre), '') AS epiteto
		, ISNULL(IIF(ev.tipo = '-', '', ev.tipo), '') AS categoria_infra
		, ISNULL(IIF(ev.nombre = '-', '', ev.nombre), '') AS infraespecie
		, LTRIM(RTRIM(ISNULL(g.nombre, '') + ' ' + IIF(e.nombre = '-', '', e.nombre) + ' ' + ISNULL(ev.tipo, '') + ' ' + ISNULL(ev.nombre, ''))) AS especie
		, v.diametro_altura_pecho AS diametro
		, v.altura_total AS altura
		, c.lat AS latitud
		, c.long AS longitud
	FROM
		MuestreoNacional.Sistema.unidad_muestreo u
	INNER JOIN
		MuestreoNacional.Sistema.unidad_muestreo us ON (us.id_unidad_muestreo_padre = u.id)
	INNER JOIN
		MuestreoNacional.Sistema.levantamiento ls ON (ls.id_unidad_muestreo = us.id)
	INNER JOIN
		MuestreoNacional.Satelites.caracteristica_vegetacion_mayor v ON (v.id_levantamiento = ls.id)
	LEFT JOIN
		MuestreoNacional.Catalogos.especie e ON (e.id = v.id_especie)
	LEFT JOIN
		MuestreoNacional.Catalogos.genero g ON (g.id = e.id_genero)
	LEFT JOIN
		MuestreoNacional.Catalogos.especie_variedad ev ON (ev.id_especie = e.id)
	LEFT JOIN	
		MuestreoNacional.Sistema.coordenada c ON (c.id = ls.id_coordenada)
	WHERE
		u.id_proyecto = 1
		AND ls.anio_levantamiento BETWEEN 2004 AND 2014

		AND (v.diametro_altura_pecho IS NOT NULL AND v.diametro_altura_pecho <> 0)
		AND (v.altura_total IS NOT NULL AND v.altura_total <> 0)
		AND v.id_condicion = 1
) AS arb

/*ORDER BY
	RAND(arb.id_arbol)*/
