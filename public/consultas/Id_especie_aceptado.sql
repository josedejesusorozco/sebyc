--SELECT MuestreoNacional.dbo.getEspecieAceptada('Tetramerium nervosum')
--SELECT * FROM Catalogos.especie WHERE id = MuestreoNacional.dbo.getEspecieAceptada('Tetramerium nervosum')



SELECT
	a.*
	, MuestreoNacional.dbo.getEspecieAceptada(LTRIM(RTRIM(a.genero + ' ' + ISNULL(a.epiteto, '') + ' ' + ISNULL(a.categoria_infra, '') + ISNULL(a.infraespecie, '')))) AS id_especie
	, (SELECT id_genero FROM MuestreoNacional.Catalogos.especie WHERE id = MuestreoNacional.dbo.getEspecieAceptada(LTRIM(RTRIM(a.genero + ' ' + ISNULL(a.epiteto, '') + ' ' + ISNULL(a.categoria_infra, '') + ISNULL(a.infraespecie, ''))))) AS id_genero
	--, LTRIM(RTRIM(a.genero + ' ' + ISNULL(a.epiteto, '') + ' ' + ISNULL(a.categoria_infra, '') + ISNULL(a.infraespecie, ''))) AS especie
FROM
	pimof.dbo.arboles a
