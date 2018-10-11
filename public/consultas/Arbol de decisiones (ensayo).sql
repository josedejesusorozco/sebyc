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
	id = 2

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
	AND m.genero IS NULL
	AND m.epiteto IS NULL
	AND m.clave_ecoregion_n2 IS NULL
ORDER BY
	CAST((m.diametro_max - m.diametro_min)/5 AS INTEGER) DESC
	, m.numero_arboles DESC
	, m.r2 DESC

--SELECT * FROM pimof.dbo.modelos WHERE genero = @genero

