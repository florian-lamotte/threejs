<!DOCTYPE html>
<html>
<head>
	<title>Planète</title>
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
		var renderer = new THREE.WebGLRenderer({antialias: true});
		renderer.setSize(window.innerWidth, window.innerHeight);
		document.body.appendChild(renderer.domElement);

		var camera = new THREE.PerspectiveCamera(45, window.innerWidth/window.innerHeight, 0.1, 1000);
		camera.position.z = 180;
		scene.add(camera);

		var pointLight = new THREE.PointLight(0xffffff);
		pointLight.position.set(0, 300, 200);
		scene.add(pointLight);

		var texture = new THREE.TextureLoader().load("c1f8c82130526d164923baf63a05e1b0.jpg");
		var geometry = new THREE.SphereGeometry(50, 40, 40);
		var material = new THREE.MeshLambertMaterial({map: texture});
		var planete = new THREE.Mesh(geometry, material);
		scene.add(planete);

		var textureLune = new THREE.TextureLoader().load("moon_1024.jpg");
		var geometryLune = new THREE.SphereGeometry(5, 40, 40);
		var materialLune = new THREE.MeshLambertMaterial({map: textureLune});
		var lune = new THREE.Mesh(geometryLune, materialLune);
		lune.position.x = 70;
		scene.add(lune);

		var starGeometry = new THREE.SphereGeometry(200, 50, 50);
		var starMaterial = new THREE.MeshPhongMaterial({
			map: new THREE.TextureLoader().load("2048x1024.png"),
			side: THREE.DoubleSide,
			shininess: 0
		});
		var star = new THREE.Mesh(starGeometry, starMaterial);
		scene.add(star);

		var upVector = new THREE.Vector3(0, -1, 0);

		var gui = new dat.GUI();
		var vecteur = { x: upVector.getComponent(0), y: upVector.getComponent(1), z: upVector.getComponent(2) };
		gui.add(vecteur, 'x', -50, 50).step(1).onChange(function(value){ upVector.setX(value); });
		gui.add(vecteur, 'y', -50, 50).step(1).onChange(function(value){ upVector.setY(value); });
		gui.add(vecteur, 'z', -50, 50).step(1).onChange(function(value){ upVector.setZ(value); });

		function render() {
		    renderer.render(scene, camera);

			var axis = planete.position.clone().sub(upVector).normalize();
		    planete.rotation.y += 0.001;
		    lune.rotation.y += 0.01;
			lune.position.applyAxisAngle(axis, 0.01);

		    requestAnimationFrame(render);
		}

		render();
	</script>
</body>
</html>