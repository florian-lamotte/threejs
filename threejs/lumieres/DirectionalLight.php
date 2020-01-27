<!DOCTYPE html>
<html>
<head>
	<title>Lumière directionnelle</title>
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
		/* Lumière émise dans une direction qui peut créer des ombres et avoir une position. 
		Les rayons sont infinis, parallèles et d'intensité constante. 
		Equivalent aux rayons du soleil, simule la lumière du jour. */

		var light = new THREE.DirectionalLight(0xffffff, 1); // color, intensity
		light.position.set(1, 1, 1);
		scene.add(light);

		var helper = new THREE.DirectionalLightHelper(light, 20);
		scene.add(helper);

		var gui = new dat.GUI();
		var variables = { 
			color: light.color.getHex(),
			intensity: light.intensity,
			x: light.position.x,
			y: light.position.y,
			z: light.position.z
		};

		var changements = function(){
			light.color = new THREE.Color(variables.color);
			light.intensity = variables.intensity;
			light.position.x = variables.x;
			light.position.y = variables.y;
			light.position.z = variables.z;
		}

		gui.addColor(variables, 'color').onChange(changements);
		gui.add(variables, 'intensity', 0, 50).step(1).onChange(changements);
		gui.add(variables, 'x', -10, 10).step(1).onChange(changements);
		gui.add(variables, 'y', -10, 10).step(1).onChange(changements);
		gui.add(variables, 'z', -100, 100).step(1).onChange(changements);
	</script>
</body>
</html>