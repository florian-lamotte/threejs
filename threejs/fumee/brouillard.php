<!DOCTYPE html>
<html>
<head>
	<title>Brouillard</title>
	<style type="text/css">
		body { margin:0; }
		canvas { width:100%; height:100%; }
	</style>
</head>
<body>
	<script src="../threejs-master/three.js"></script>
	<script src="../resize.js"></script>
	<script>
		// idée d'origine: https://codepen.io/teolitto/pen/KwOVvL

		var scene = new THREE.Scene();

		var camera = new THREE.PerspectiveCamera(45, window.innerWidth/window.innerHeight, 0.1, 1000);
		camera.position.z = 1000;
		scene.add(camera);

		var renderer = new THREE.WebGLRenderer({antialias: true});
		renderer.setSize(window.innerWidth, window.innerHeight);
		document.body.appendChild(renderer.domElement);

		var light = new THREE.DirectionalLight(0xffffff,0.5);
    	light.position.set(-1,0,1);
    	scene.add(light);

		var smokeTexture = new THREE.TextureLoader().load('Smoke-Element.png');
		var smokeMaterial = new THREE.MeshLambertMaterial({ map: smokeTexture, transparent: true, opacity: 0.9, color: 0x00dddd });
		var smokeGeometry = new THREE.PlaneGeometry(300,300);
		var smokeParticles = [];

		for(var i = 0; i < 50; i++){
			var particle = new THREE.Mesh(smokeGeometry, smokeMaterial);
			particle.position.set(Math.random()*500-250,Math.random()*500-250,Math.random()*1000-100);
			particle.rotation.z += Math.random() * 360;
			scene.add(particle);
			smokeParticles.push(particle);
		}

		function evolveSmoke() {
		    var sp = smokeParticles.length;
		    while(sp--) {
		        smokeParticles[sp].rotation.z += 0.005;
		    }
		}

		function render() {
			requestAnimationFrame(render);
			evolveSmoke();
		    renderer.render(scene, camera);
		}

		render();
	</script>
</body>
</html>