<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Peluche</title>
	<style type="text/css">
		body { margin:0; }
		canvas { width:100%; height:100%; }
	</style>
</head>
<body>
	<script src="../threejs-master/three.js"></script>
	<script src="../threejs-master/OrbitControls.js"></script>
	<script src="../resize.js"></script>
	<script>	
		var scene, camera, renderer;

		init();
		light();
		boule();
		animate();

		function init(){
			scene = new THREE.Scene();

			camera = new THREE.PerspectiveCamera(80, window.innerWidth/window.innerHeight, 0.1, 1000);
			camera.position.z = 100;

			renderer = new THREE.WebGLRenderer({ antialias: true });
			renderer.setSize(window.innerWidth, window.innerHeight);
			document.body.appendChild(renderer.domElement);
		}

		function light(){
			var light = new THREE.PointLight(0xffffff);
			light.position.set(300,300,0);
			scene.add(light);

			var light = new THREE.PointLight(0xffffff);
			light.position.set(0,300,300);
			scene.add(light);
		}

		function boule(){
			var size = 10+Math.random()*10;
			var geometry = new THREE.IcosahedronGeometry(size, 5);
			var material = new THREE.MeshLambertMaterial({
				map: new THREE.TextureLoader().load("rock-texture.jpg")
			});
			var mesh = new THREE.Mesh(geometry, material);
			
			for(var i = 0; i < geometry.vertices.length; i++){
				geometry.vertices[i].x += size*-0.25 + Math.random()*size*0.5;
				geometry.vertices[i].y += size*-0.25 + Math.random()*size*0.5;
			}

			scene.add(mesh);
		}

		function animate(){
			requestAnimationFrame(animate);
			renderer.render(scene, camera);
		}
	</script>
</body>
</html>