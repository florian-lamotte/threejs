<!DOCTYPE html>
<html>
<head>
	<title>Ampoule</title>
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
		/* Lumière émise d'un point dans toutes les directions dont la puissance s'estompe avec la distance, pouvant créer des ombres. 
		Equivalent à une ampoule. */

		var light = new THREE.PointLight(0xffffff, 1, 100, 2); // color, intensity, distance, decay
		light.position.set(1, 1, 20);
		scene.add(light);

		var helper = new THREE.PointLightHelper(light, 20);
		scene.add(helper);

		var gui = new dat.GUI();
		var variables = { 
			color: light.color.getHex(),
			intensity: light.intensity,
			distance: light.distance,
			decay: light.decay,
			x: light.position.x,
			y: light.position.y,
			z: light.position.z
		};

		var changements = function(){
			light.color = new THREE.Color(variables.color);
			light.intensity = variables.intensity;
			light.distance = variables.distance;
			light.decay = variables.decay;
			light.position.x = variables.x;
			light.position.y = variables.y;
			light.position.z = variables.z;
		}

		gui.addColor(variables, 'color').onChange(changements);
		gui.add(variables, 'intensity', 0, 50).step(1).onChange(changements);
		gui.add(variables, 'distance', -1, 200).step(1).onChange(changements);
		gui.add(variables, 'decay', -1, 40).step(1).onChange(changements);
		gui.add(variables, 'x', -50, 50).step(1).onChange(changements);
		gui.add(variables, 'y', -50, 50).step(1).onChange(changements);
		gui.add(variables, 'z', -50, 50).step(1).onChange(changements);
	</script>
</body>
</html>