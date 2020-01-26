<!DOCTYPE html>
<html>
<head>
	<title>Fumée</title>
	<style type="text/css">
		body { margin:0; }
		canvas { width:100%; height:100%; }
	</style>
</head>
<body>
	<script src="../threejs-master/three.js"></script>
	<script src="../resize.js"></script>
	<script>
		var scene = new THREE.Scene();

		var camera = new THREE.PerspectiveCamera(45, window.innerWidth/window.innerHeight, 0.1, 1000);
		camera.position.y = 160;
		camera.position.z = 400;
		scene.add(camera);

		var renderer = new THREE.WebGLRenderer({antialias: true});
		renderer.setSize(window.innerWidth, window.innerHeight);
		document.body.appendChild(renderer.domElement);

		var pointLight = new THREE.PointLight(0xffffff);
		pointLight.position.set(0, 300, 200);
		scene.add(pointLight);

		var smokeParticles = new THREE.Geometry;

		for(var i = 0; i < 300; i++){
			var particle = new THREE.Vector3(Math.random() * 32 - 16, Math.random() * 230, Math.random() * 32 - 16);
			smokeParticles.vertices.push(particle);
		}

		var smokeTexture = new THREE.TextureLoader().load('smoke.png');
		var smokeMaterial = new THREE.PointsMaterial({ map: smokeTexture, transparent: true, depthWrite: false, size: 50, color: 0x00dddd });
		var smoke = new THREE.Points(smokeParticles, smokeMaterial);
		scene.add(smoke);

		function render() {
			requestAnimationFrame(render);

			smoke.rotation.y += 0.005;

			var particleCount = smokeParticles.vertices.length;
			while (particleCount--) {
			    var particle = smokeParticles.vertices[particleCount];
			    particle.y += 0.5;
			     
			    if (particle.y >= 230) {
			        particle.y = Math.random() * 16;
			        particle.x = Math.random() * 32 - 16;
			        particle.z = Math.random() * 32 - 16;
			    }
			}
			smokeParticles.verticesNeedUpdate = true;
			
		    renderer.render(scene, camera);
		}

		render();
	</script>
</body>
</html>