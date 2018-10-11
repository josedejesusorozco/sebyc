SELECT
	ypsilon.dbo.formula_php(m.id) AS ecuacion
	, m.constante_a
	, m.constante_b
	, m.constante_c
	, m.constante_d
	, m.constante_e
	, m.constante_f
	, m.constante_g
	, m.constante_h
	, m.constante_i
	, m.constante_j
	, m.constante_k
	, e.genero
	, e.nombre AS epiteto
	, ISNULL(eco.clave_eco2, '') AS clave_ecoregion_n2
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
	m.id_bio_variable_res = 9
	AND m.activo IN (1, 2)
	AND m.id_bio_componente_arbol = 2
	AND (m.id_bio_variable_x IN(1, 3) OR m.id_bio_variable_x IS NULL)
	AND (m.id_bio_variable_y IN(1, 3) OR m.id_bio_variable_y IS NULL)
	AND (m.id_bio_variable_z IN(1, 3) OR m.id_bio_variable_z IS NULL)
	AND (m.id_bio_variable_v IN(1, 3) OR m.id_bio_variable_v IS NULL)
	AND (m.id_bio_variable_w IN(1, 3) OR m.id_bio_variable_w IS NULL)