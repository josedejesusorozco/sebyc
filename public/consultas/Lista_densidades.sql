SELECT
	IIF(e.genero = '-', '', e.genero) AS genero
	, IIF(e.nombre = '-', '', e.nombre) AS epiteto
	, ISNULL(eco.clave_eco2, '') AS clave_ecoregion_n2
	, m.constante_a AS valor
	, m.diametro_min
	, m.diametro_max
	, m.numero_arboles
	, m.r2
	, m.id AS id_modelo
FROM
	ypsilon.biomasa.bio_modelo_alometrico m
LEFT JOIN
	ypsilon.biomasa.bio_rel_modelo_especie me ON(me.id_bio_modelo_alometrico = m.id)
LEFT JOIN
	ypsilon.catalogos.especie e ON(e.id = me.id_especie)
LEFT JOIN
	ypsilon.biomasa.bio_rel_modelo_ecorregiones_mexico eco ON(eco.id_bio_modelo_alometrico = m.id)
WHERE
	m.id_bio_variable_res = 8
	AND m.activo IN (1, 2)