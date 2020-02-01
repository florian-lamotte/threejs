<!DOCTYPE html>
<html>
<head>
	<title>Forêt</title>
	<style>
		body { margin:0; }
		canvas { width:100%; height:100%; }
	</style>
</head>
<body>
	<script src="../threejs-master/three.js"></script>
	<script src="../threejs-master/OrbitControls.js"></script>
	<script src="../dat.gui.min.js"></script>
	<script src="../resize.js"></script>
	<script>
		var scene = new THREE.Scene;
		var renderer = new THREE.WebGLRenderer({antialias: true});
		renderer.setSize(window.innerWidth, window.innerHeight);
		renderer.shadowMap.enabled = true;
		renderer.shadowMap.cullFace = THREE.CullFaceBack;
		renderer.shadowMap.type = THREE.PCFSoftShadowMap;
		document.body.appendChild(renderer.domElement);

		var camera = new THREE.PerspectiveCamera(45, window.innerWidth/window.innerHeight, 0.1, 1000);
		camera.position.set(0, 100, 220);

		var light = new THREE.DirectionalLight(0xffffff, 1.5);
		light.position.set(140, 200, 200);
		scene.add(light);

		light.castShadow = true;
		light.shadow.mapSize.width = 2048;
		light.shadow.mapSize.height = 2048;
		light.shadow.camera.left = -100;
		light.shadow.camera.right = 100;
		light.shadow.camera.top = 100;
		light.shadow.camera.bottom = -100;
		light.shadow.camera.far = 3500;
		light.shadow.bias = -0.0001;

		var helper = new THREE.DirectionalLightHelper(light, 20);
		scene.add(helper);

	    var ambientLight = new THREE.AmbientLight(0xE84F0E, 0.3);
	    scene.add(ambientLight);

 		var sphereTexture = new THREE.TextureLoader().load("texture_leaves_by_kuschelirmel_stock.jpg");
		var sphereGeometry = new THREE.SphereBufferGeometry(12, 50, 50);
		var sphereMaterial = new THREE.MeshLambertMaterial({ map: sphereTexture });

		var cylinderTexture = new THREE.TextureLoader().load("frontend-large.jpg");
		var cylinderGeometry = new THREE.CylinderGeometry(2, 2, 30, 32);
		var cylinderMaterial = new THREE.MeshLambertMaterial({ map: cylinderTexture });

		var texture = new THREE.TextureLoader().load("grasslight-big.jpg");
		var geometry = new THREE.BoxGeometry(200, 200, 10);
		var material = new THREE.MeshLambertMaterial({ map: texture });
		var box = new THREE.Mesh(geometry, material);
		box.rotation.set(- Math.PI * 0.5, 0, 0);
		box.receiveShadow = true;
		scene.add(box);

		for(var i = 0; i < 30; i++){
			var group = new THREE.Group();

			var sphere = new THREE.Mesh(sphereGeometry, sphereMaterial);
			sphere.castShadow = true;
			sphere.receiveShadow = false;
			sphere.position.y = 30;

			var cylinder = new THREE.Mesh(cylinderGeometry, cylinderMaterial);
			cylinder.castShadow = true;
			cylinder.receiveShadow = false;
			cylinder.position.y = 10;

			group.add(sphere);
			group.add(cylinder);

			group.position.x = Math.random() * 2 - 1;
			group.position.z = Math.random() * 2 - 1;
			group.position.normalize();
			group.position.multiplyScalar(Math.random() * 100);
			
			scene.add(group);
		}

		var controls = new THREE.OrbitControls(camera, renderer.domElement);
		controls.maxPolarAngle = Math.PI * 0.45;
		controls.addEventListener('change', function(){ renderer.render(scene, camera); });

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
		gui.add(variables, 'intensity', 0, 2).step(0.1).onChange(changements);
		gui.add(variables, 'x', -500, 500).step(1).onChange(changements);
		gui.add(variables, 'y', -500, 500).step(1).onChange(changements);
		gui.add(variables, 'z', -500, 500).step(1).onChange(changements);

		function render(){
		    renderer.render(scene, camera);
		    requestAnimationFrame(render);
		}

		render();
	</script>
</body>
</html>