<!DOCTYPE html>
<html>
<head>
	<title>Soleil</title>
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

		function render() {
		    renderer.render(scene, camera);
		    sphere.rotation.x += 0.003;
		    requestAnimationFrame(render);
		}

		render();
	</script>
</body>
</html>