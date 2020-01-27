<!DOCTYPE html>
<html>
<head>
	<title>Lumière hemisphérique</title>
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
		/* Lumière positionnée au-dessus de la scène, avec un dégradé de la couleur du ciel vers la couleur du sol. Ne peut pas créer d'ombres.
		Elle simule un éclairage venant du ciel et du sol pour ajouter par exemple un reflet sur un objet. */

		var light = new THREE.HemisphereLight(0xE82DC5, 0x392DFF, 1); // skyColor, groundColor, intensity
		light.position.set(1, 1, 1);
		scene.add(light);

		var helper = new THREE.HemisphereLightHelper(light, 20);
		scene.add(helper);

		var gui = new dat.GUI();
		var variables = { 
			skyColor: light.color.getHex(), 
			groundColor: light.groundColor.getHex(),
			intensity: light.intensity,
			x: light.position.x,
			y: light.position.y,
			z: light.position.z
		};

		var changements = function(){
			light.color = new THREE.Color(variables.skyColor);
			light.groundColor = new THREE.Color(variables.groundColor);
			light.intensity = variables.intensity;
			light.position.x = variables.x;
			light.position.y = variables.y;
			light.position.z = variables.z;
		}

		gui.addColor(variables, 'skyColor').onChange(changements);
		gui.addColor(variables, 'groundColor').onChange(changements);
		gui.add(variables, 'intensity', 0, 50).step(1).onChange(changements);
		gui.add(variables, 'x', -50, 50).step(1).onChange(changements);
		gui.add(variables, 'y', -50, 50).step(1).onChange(changements);
		gui.add(variables, 'z', -50, 50).step(1).onChange(changements);
	</script>
</body>
</html>