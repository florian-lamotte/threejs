<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cylindre</title>
	<style>
		body { margin:0; }
		canvas { width:100%; height:100%; }
	</style>
</head>
<body>
	<script src="../threejs-master/three.js"></script>
	<script src="../dat.gui.min.js"></script>
	<script src="../resize.js"></script>
	<script>
		var scene = new THREE.Scene;
		var renderer = new THREE.WebGLRenderer({ antialias: true });
		renderer.setSize(window.innerWidth, window.innerHeight);
		document.body.appendChild(renderer.domElement);

		var camera = new THREE.PerspectiveCamera(45, window.innerWidth/window.innerHeight, 0.1, 1000);
		camera.position.z = 100;

		var textureLoader = new THREE.TextureLoader();
		textureLoader.crossOrigin = true;
		var texture = new THREE.TextureLoader().load('Stone wall texture 4770x3178.jpg');
		var geometry = new THREE.CylinderGeometry(8, 8, 50, 32);
		var material = new THREE.MeshStandardMaterial( {color: 0x57554D, roughness: 0.5, metalness: 1, bumpMap: texture} );
		var mesh = new THREE.Mesh( geometry, material );
		scene.add( mesh );

		var sphereGeometry = new THREE.SphereGeometry( 0.5, 32, 32 );

		var light = new THREE.PointLight(0xff0040, 1, 50);
		scene.add(light);
		var sphere = new THREE.Mesh(sphereGeometry, new THREE.MeshBasicMaterial({ color: 0xff0040 }));
		light.add(sphere);

		light2 = new THREE.PointLight( 0x0040ff, 1, 50 );
		scene.add( light2 );
		var sphere2 = new THREE.Mesh(sphereGeometry, new THREE.MeshBasicMaterial({ color: 0x0040ff }));
		light2.add(sphere2);

		light3 = new THREE.PointLight( 0x80ff80, 1, 50 );
		scene.add( light3 );
		var sphere3 = new THREE.Mesh(sphereGeometry, new THREE.MeshBasicMaterial({ color: 0x80ff80 }));
		light3.add(sphere3);

		var gui = new dat.GUI();

		var lumiere1 = gui.addFolder('Lumière 1');
		var lumiere2 = gui.addFolder('Lumière 2');
		var lumiere3 = gui.addFolder('Lumière 3');

		var variables = { 
			color: material.color.getHex(),
			roughness: material.roughness,
			metalness: material.metalness,
			colorLight: light.color.getHex(),
			intensity: light.intensity,
			colorLight2: light2.color.getHex(),
			intensity2: light2.intensity,
			colorLight3: light3.color.getHex(),
			intensity3: light3.intensity
		};

		var variables_lumiere1 = {
			colorLight: light.color.getHex(),
			intensity: light.intensity
		}

		var changements = function(){
			material.color = new THREE.Color(variables.color);
			material.roughness = variables.roughness;
			material.metalness = variables.metalness;
			light.color = new THREE.Color(variables_lumiere1.colorLight);
			light.intensity = variables_lumiere1.intensity;
			light2.color = new THREE.Color(variables.colorLight2);
			light2.intensity = variables.intensity2;
			light3.color = new THREE.Color(variables.colorLight3);
			light3.intensity = variables.intensity3;
		}

		gui.addColor(variables, 'color').onChange(changements);
		gui.add(variables, 'roughness', 0, 1).step(0.01).onChange(changements);
		gui.add(variables, 'metalness', 0, 1).step(0.01).onChange(changements);
		lumiere1.addColor(variables_lumiere1, 'colorLight').onChange(changements);
		lumiere1.add(variables_lumiere1, 'intensity', 0, 3).step(0.1).onChange(changements);
		lumiere2.addColor(variables, 'colorLight2').onChange(changements);
		lumiere2.add(variables, 'intensity2', 0, 3).step(0.1).onChange(changements);
		lumiere3.addColor(variables, 'colorLight3').onChange(changements);
		lumiere3.add(variables, 'intensity3', 0, 3).step(0.1).onChange(changements);

		function render(){
			requestAnimationFrame(render);

			var time = Date.now() * 0.0005;

			light.position.x = Math.sin( time * 0.7 ) * 30;
			light.position.y = Math.cos( time * 0.5 ) * 40;
			light.position.z = Math.cos( time * 0.3 ) * 30;

			light2.position.x = Math.cos( time * 0.3 ) * 30;
			light2.position.y = Math.sin( time * 0.5 ) * 40;
			light2.position.z = Math.sin( time * 0.7 ) * 30;

			light3.position.x = Math.sin( time * 0.7 ) * 30;
			light3.position.y = Math.cos( time * 0.3 ) * 40;
			light3.position.z = Math.sin( time * 0.5 ) * 30;

		    renderer.render(scene, camera);
		}

		render();
	</script>
</body>
</html>