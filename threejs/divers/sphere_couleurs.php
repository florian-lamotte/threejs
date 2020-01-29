<!DOCTYPE html>
<html>
<head>
	<title>Sphère colorée</title>
	<style type="text/css">
		body { margin:0; }
		canvas { width:100%; height:100%; }
	</style>
</head>
<body>
	<script src="../threejs-master/three.js"></script>
	<script src="../resize.js"></script>
	<script>
		var scene = new THREE.Scene;
		var renderer = new THREE.WebGLRenderer({antialias: true});
		renderer.setSize(window.innerWidth, window.innerHeight);
		document.body.appendChild(renderer.domElement);

		var camera = new THREE.PerspectiveCamera(45, window.innerWidth/window.innerHeight, 0.1, 1000);
		camera.position.z = 100;
		scene.add(camera);

		var pointLight = new THREE.PointLight(0xffffff);
		pointLight.position.set(0, 300, 200);
		scene.add(pointLight);

		var geometry = new THREE.SphereGeometry(50, 40, 40);
		var material = new THREE.MeshLambertMaterial({color: 0xCC0000});
		var sphere = new THREE.Mesh(geometry, material);
		scene.add(sphere);

		var geometry2 = new THREE.SphereGeometry(50, 40, 40);
		var material2 = new THREE.MeshLambertMaterial({color:0xFF530D});
		var sphere2 = new THREE.Mesh(geometry2, material2);
		scene.add(sphere2);

		var geometry3 = new THREE.SphereGeometry(50, 40, 40);
		var material3 = new THREE.MeshLambertMaterial({color:0xFFB435});
		var sphere3 = new THREE.Mesh(geometry3, material3);
		scene.add(sphere3);

		function render() {
		    renderer.render(scene, camera);
		    sphere.rotation.x += 0.003;
		    sphere2.rotation.y += 0.003;
		    sphere3.rotation.z += 0.003;
		    requestAnimationFrame(render);
		}

		render();
	</script>
</body>
</html>