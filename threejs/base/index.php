<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Base Three.js</title>
	<style>
		body { margin:0; }
		canvas { width:100%; height:100%; }
	</style>
</head>
<body>
	<script src="../threejs-master/three.js"></script>
	<script src="../resize.js"></script>
	<script>
		var scene = new THREE.Scene();
		var camera = new THREE.PerspectiveCamera(45, window.innerWidth/window.innerHeight, 1, 1000);
		var renderer = new THREE.WebGLRenderer();
		renderer.setSize(window.innerWidth, window.innerHeight);
		document.body.appendChild(renderer.domElement);

		var texture = new THREE.TextureLoader().load("2_no_clouds_4k.jpg");

		var geometry = new THREE.BoxGeometry( 1, 1, 1 );
		var material = new THREE.MeshBasicMaterial( { map: texture } );
		var cube = new THREE.Mesh( geometry, material );
		scene.add( cube );

		camera.position.z = 5;

		var animate = function () {
			requestAnimationFrame( animate );

			cube.rotation.x += 0.003;
			cube.rotation.y += 0.003;

			renderer.render(scene, camera);
		};

		animate();
	</script>
</body>
</html>