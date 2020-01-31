<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Gemme</title>
	<style>
		body { margin:0; }
		canvas { width:100%; height:100%; }
	</style>
</head>
<body>
	<script src="../threejs-master/three.js"></script>
	<script src="../resize.js"></script>
	<script>
		var gemme = null;
		var scene = new THREE.Scene;
		var renderer = new THREE.WebGLRenderer({ antialias: true });
		renderer.setSize(window.innerWidth, window.innerHeight);
		document.body.appendChild(renderer.domElement);

		var camera = new THREE.PerspectiveCamera(45, window.innerWidth/window.innerHeight, 0.1, 1000);
		camera.position.z = 15;

		var pointLight = new THREE.PointLight(0xffffff);
		pointLight.position.set(0, 300, 200);
		scene.add(pointLight);

   		var lightAmbient = new THREE.AmbientLight(0x404040);
    	scene.add(lightAmbient);

    	document.addEventListener('mousedown', onDocumentMouseDown, false);

		var loader = new THREE.JSONLoader();
		loader.load('https://raw.githubusercontent.com/PavelLaptev/test-rep/master/threejs-post/diamond.json', function(geometry){
			var material = new THREE.MeshPhongMaterial({
				color: 0xCC0000,
				shading: THREE.FlatShading
			});
			gemme = new THREE.Mesh(geometry, material);

			scene.add(gemme);
		});

		var back = true;
		var raycaster = new THREE.Raycaster(); // nécessaire pour débuter le raycaster
		var mouse = new THREE.Vector2(); // nécessaire pour les coordonnées de la souris

		function onDocumentMouseDown(event) {
		    event.preventDefault();
		    // calcule les coordonnées de la souris en 2d
		    mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
		    mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

		    raycaster.setFromCamera(mouse, camera); // convertit les coordonnées 2d en 3d

		    var intersects = raycaster.intersectObjects([gemme]); // stocke un objet intercepté par le raycaster

		    // vérifie si le raycaster a intercepté un objet
		    if(intersects.length > 0){
		        intersects[0].object.material.color.setHex(Math.random() * 0xffffff); // applique un changement sur l'objet intercepté
		    }
		};

		function render(){
			requestAnimationFrame(render);

			if(gemme !== null){
				if(gemme.position.y <= 0.3 && back){    
				    gemme.position.y += 0.01;
				} else if(gemme.position.y > -0.3){
				    back = false;
				    gemme.position.y -= 0.01;
				} else {
					back = !back;
				}

			    gemme.rotation.y += 0.01;
			}

		    renderer.render(scene, camera);
		}

		render();
	</script>
</body>
</html>