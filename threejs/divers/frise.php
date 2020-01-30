<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Frise</title>
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
		// inspiration d'origine: https://codepen.io/Mombasa/pen/ivdyC
		
		var scene = new THREE.Scene;
		var renderer = new THREE.WebGLRenderer({ antialias: true });
		renderer.setSize(window.innerWidth, window.innerHeight);
		document.body.appendChild(renderer.domElement);

		var camera = new THREE.PerspectiveCamera(45, window.innerWidth/window.innerHeight, 0.1, 10000);
		camera.position.z = 600;

		var frise = new THREE.TextureLoader().load('egyptian_friz_2.png');
		frise.minFilter = THREE.LinearFilter;
		frise.magFilter = THREE.LinearMipMapLinearFilter;
		var texture = new THREE.TextureLoader().load('specular_map.jpg');
		texture.minFilter = THREE.LinearFilter;
		texture.magFilter = THREE.LinearMipMapLinearFilter;
		var geometry = new THREE.PlaneGeometry(2000, 200, 32, 8);
		var material = new THREE.MeshPhongMaterial({color: 0xFFEFC4, shininess: 50, bumpMap: frise, map: texture, bumpScale: 0.20});
		var mesh = new THREE.Mesh( geometry, material );
		scene.add( mesh );

		var light = new THREE.PointLight(0xffc999, 1, 1000, 3);
		light.position.set(0, 0, 200);
		scene.add(light);

		var pointLightHelper = new THREE.PointLightHelper( light, 10 );
		scene.add( pointLightHelper );

		var gui = new dat.GUI();
		var variables = { 
			color: light.color.getHex(),
			intensity: light.intensity,
			x: light.position.x,
			y: light.position.y,
			z: light.position.z,
			shininess: material.shininess,
			bumpScale: material.bumpScale
		};

		var changements = function(){
			light.color = new THREE.Color(variables.color);
			light.intensity = variables.intensity;
			light.position.x = variables.x;
			light.position.y = variables.y;
			light.position.z = variables.z;
			material.shininess = variables.shininess;
			material.bumpScale = variables.bumpScale;
		}

		gui.addColor(variables, 'color').onChange(changements);
		gui.add(variables, 'intensity', 0, 3).step(0.1).onChange(changements);
		gui.add(variables, 'x', -400, 400).step(1).onChange(changements);
		gui.add(variables, 'y', -200, 200).step(1).onChange(changements);
		gui.add(variables, 'z', 0, 600).step(1).onChange(changements);
		gui.add(variables, 'shininess', 0, 100).step(1).onChange(changements);
		gui.add(variables, 'bumpScale', 0, 1).step(0.01).onChange(changements);

		function render(){
			requestAnimationFrame(render);
		    renderer.render(scene, camera);
		}

		render();
	</script>
</body>
</html>