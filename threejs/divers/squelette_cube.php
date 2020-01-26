<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Squelette cube</title>
	<style>
		body { margin:0; }
		canvas { width:100%; height:100%; }
	</style>
</head>
<body>
	<script src="../threejs-master/three.js"></script>
	<script src="../threejs-master/OrbitControls.js"></script>
	<script src="../resize.js"></script>
	<script>
		var scene, renderer, camera, controls;

		init();
		light();
		box();
		controls();
		render();

		function init(){
			scene = new THREE.Scene;
			renderer = new THREE.WebGLRenderer({ antialias: true });
			renderer.setSize(window.innerWidth, window.innerHeight);
			document.body.appendChild(renderer.domElement);

			camera = new THREE.PerspectiveCamera(45, window.innerWidth/window.innerHeight, 0.1, 1000);
			camera.position.z = 100;
		}

		function light(){
			var light = new THREE.AmbientLight(0xffffff);
			scene.add(light);
		}

		function box(){
			var geometry = new THREE.BoxGeometry(30, 30, 30, 5, 5, 5);
			var material = new THREE.MeshBasicMaterial({color: 0xCC0000, wireframe:true });
			var mesh = new THREE.Mesh(geometry, material);
			scene.add(mesh);
		}

		function controls(){
			controls = new THREE.OrbitControls(camera);
			controls.update();
		}

		function render() {
		    renderer.render(scene, camera);
		    requestAnimationFrame(render);
		}
	</script>
</body>
</html>