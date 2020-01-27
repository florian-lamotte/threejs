<!DOCTYPE html>
<html>
<head>
	<title>Spot lumineux</title>
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
		/* Lumière émisse à partir d'un point vers une seule direction sous la forme d'un cône qui augmente en taille avec la distance. Elle peut créer des ombres. */

		var light = new THREE.SpotLight(0xffffff, 1); // color, intensity, distance, angle, penumbra, decay
		light.position.set(100, 100, 0);
		scene.add(light);

		var helper = new THREE.SpotLightHelper(light, 10);
		scene.add(helper);

		var gui = new dat.GUI();
		var variables = { 
			color: light.color.getHex(),
			intensity: light.intensity,
			distance: light.distance,
			decay: light.decay,
			angle: light.angle,
			penumbra: light.penumbra,
			x: light.position.x,
			y: light.position.y,
			z: light.position.z
		};

		var changements = function(){
			light.color = new THREE.Color(variables.color);
			light.intensity = variables.intensity;
			light.distance = variables.distance;
			light.decay = variables.decay;
			light.angle = variables.angle;
			light.penumbra = variables.penumbra;
			light.position.x = variables.x;
			light.position.y = variables.y;
			light.position.z = variables.z;
		}

		gui.addColor(variables, 'color').onChange(changements);
		gui.add(variables, 'intensity', 0, 10).step(1).onChange(changements);
		gui.add(variables, 'distance', 0, 200).step(1).onChange(changements);
		gui.add(variables, 'decay', 0, 40).step(1).onChange(changements);
		gui.add(variables, 'angle', 0, 6).step(0.1).onChange(changements);
		gui.add(variables, 'penumbra', 0, 1).step(0.01).onChange(changements);
		gui.add(variables, 'x', -50, 200).step(1).onChange(changements);
		gui.add(variables, 'y', -50, 200).step(1).onChange(changements);
		gui.add(variables, 'z', -50, 200).step(1).onChange(changements);
	</script>
</body>
</html>