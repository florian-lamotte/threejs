<!DOCTYPE html>
<html>
<head>
	<title>Lumière ambiante</title>
	<style type="text/css">
		body { margin:0; }
		canvas { width:100%; height:100%; }
	</style>
</head>
<body>
	<script src="../threejs-master/three.js"></script>
	<script src="../dat.gui.min.js"></script>
	<script src="../resize.js"></script>
	<script src="base.js"></script>
	<script>
		/* Illumine uniformément tous les objets de la scène, ne peut pas créer d'ombres et n'a pas de direction. 
		Elle évite le noir total. */

		var light = new THREE.AmbientLight(0x404040, 1); // color, intensity
		scene.add(light);

		var gui = new dat.GUI();
		var variables = { 
			color: light.color.getHex(),
			intensity: light.intensity
		};

		var changements = function(){
			light.color = new THREE.Color(variables.color);
			light.intensity = variables.intensity;
		}

		gui.addColor(variables, 'color').onChange(changements);
		gui.add(variables, 'intensity', 0, 50).step(1).onChange(changements);
	</script>
</body>
</html>