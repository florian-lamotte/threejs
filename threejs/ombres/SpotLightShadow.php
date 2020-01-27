<!DOCTYPE html>
<html>
<head>
	<title>Spot</title>
	<style type="text/css">
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
		renderer.shadowMap.enabled = true;
		renderer.shadowMap.cullFace = THREE.CullFaceBack;
		renderer.shadowMap.type = THREE.PCFSoftShadowMap;
		renderer.setSize(window.innerWidth, window.innerHeight);
		document.body.appendChild(renderer.domElement);

		var camera = new THREE.PerspectiveCamera(70, window.innerWidth/window.innerHeight, 0.1, 1000);
		camera.position.z = 100;
		scene.add(camera);

		var light = new THREE.SpotLight(0xffffff, 1);  // color, intensity, distance, decay
		light.position.set(10, 10, 10);
		light.castShadow = true;
		scene.add(light);

		var sphereGeometry = new THREE.SphereBufferGeometry(5, 50, 50);
		var sphereMaterial = new THREE.MeshStandardMaterial({ color: 0xff0000 });
		var sphere = new THREE.Mesh(sphereGeometry, sphereMaterial);
		sphere.castShadow = true;
		sphere.receiveShadow = false;
		scene.add(sphere);

		var planeGeometry = new THREE.PlaneBufferGeometry(400, 400, 32, 32);
		var planeMaterial = new THREE.MeshStandardMaterial({ color: 0xf0f0f0 });
		var plane = new THREE.Mesh(planeGeometry, planeMaterial);
		plane.position.set(-20, -10, -10);
		plane.rotateX(-1);
		plane.receiveShadow = true;
		scene.add(plane);

		var gui = new dat.GUI();
		var variables = { 
			color: light.color.getHex(),
			intensity: light.intensity,
			x: light.position.x,
			y: light.position.y,
			z: light.position.z,
			sphereRadius: 1,
			shadowRadius: light.shadow.radius,
			bias: light.shadow.bias,
			mapSizeWidh: light.shadow.mapSize.width,
			mapSizeHeight: light.shadow.mapSize.height
		};

		var changements = function(){
			light.color = new THREE.Color(variables.color);
			light.intensity = variables.intensity;
			light.position.x = variables.x;
			light.position.y = variables.y;
			light.position.z = variables.z;
			light.shadow.radius = variables.shadowRadius;
			light.shadow.bias = variables.bias;
			light.shadow.mapSize.width = variables.mapSizeWidh;
			light.shadow.mapSize.height = variables.mapSizeHeight;
		}

		gui.addColor(variables, 'color').onChange(changements);
		gui.add(variables, 'intensity', 0, 50).step(1).onChange(changements);
		gui.add(variables, 'x', -10, 20).step(1).onChange(changements);
		gui.add(variables, 'y', -10, 20).step(1).onChange(changements);
		gui.add(variables, 'z', -10, 20).step(1).onChange(changements);
		gui.add(variables, 'sphereRadius', 0, 3).step(0.1).onChange(function(e){ sphere.scale.set(e,e,e); });
		gui.add(variables, 'shadowRadius', 0, 10).step(0.1).onChange(changements);
		gui.add(variables, 'bias', 0, 1).step(0.0001).onChange(changements);
		gui.add(variables, 'mapSizeWidh', 0, 2048).step(2).onChange(changements);
		gui.add(variables, 'mapSizeHeight', 0, 2048).step(2).onChange(changements);

		function render(){
			requestAnimationFrame(render);
			renderer.render(scene, camera);
		}

		render();
	</script>
</body>
</html>