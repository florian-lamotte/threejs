<!DOCTYPE html>
<html>
<head>
	<title>Lumière rectangulaire</title>
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
	<script src="https://threejs.org/examples/js/lights/RectAreaLightUniformsLib.js"></script>
	<script>
		/* Lumière émise par la face d'une surface restangulaire, ne pouvant pas créer d'ombres. 
		Equivalent à l'éclairage d'une fenêtre. */

		var light = new THREE.RectAreaLight(0xffffff, 1, 50, 50); // color, intensity, width, height
		light.position.z = -10;
		scene.add(light);

		var helper = new THREE.RectAreaLightHelper(light, 20);
		scene.add(helper);

		var gui = new dat.GUI();
		var variables = { 
			color: light.color.getHex(),
			intensity: light.intensity,
			width: light.width,
			height: light.height,
			x: light.position.x,
			y: light.position.y,
			z: light.position.z
		};

		var changements = function(){
			light.color = new THREE.Color(variables.color);
			light.intensity = variables.intensity;
			light.width = variables.width;
			light.height = variables.height;
			light.position.x = variables.x;
			light.position.y = variables.y;
			light.position.z = variables.z;
		}

		gui.addColor(variables, 'color').onChange(changements);
		gui.add(variables, 'intensity', 0, 50).step(1).onChange(changements);
		gui.add(variables, 'width', 1, 100).step(1).onChange(changements);
		gui.add(variables, 'height', 1, 100).step(1).onChange(changements);
		gui.add(variables, 'x', -50, 50).step(1).onChange(changements);
		gui.add(variables, 'y', -50, 50).step(1).onChange(changements);
		gui.add(variables, 'z', -50, 10).step(1).onChange(changements);
	</script>
</body>
</html>