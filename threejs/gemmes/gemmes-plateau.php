<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Gemmes</title>
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
		var gemme = null;
		var arrayGemmes = [];
		var scene = new THREE.Scene;
		var renderer = new THREE.WebGLRenderer({ antialias: true });
		renderer.setSize(window.innerWidth, window.innerHeight);
		document.body.appendChild(renderer.domElement);

		var camera = new THREE.PerspectiveCamera(45, window.innerWidth/window.innerHeight, 0.1, 1000);
		camera.position.set(0, 100, 220);

		var light = new THREE.DirectionalLight(0xffffff, 1.5);
		light.position.set(140, 200, 200);
		scene.add(light);

    	document.addEventListener('mousedown', onDocumentMouseDown, false);

		var loader = new THREE.JSONLoader();
		loader.load('https://raw.githubusercontent.com/PavelLaptev/test-rep/master/threejs-post/diamond.json', function(geometry){
			var material = new THREE.MeshPhongMaterial({
				color: 0xCC0000,
				shading: THREE.FlatShading
			});

			for(var i = 0; i < 10; i++){
				group = new THREE.Group();

				gemme = new THREE.Mesh(geometry, material);
				gemme.position.y = 10;
				gemme.scale.set(8,8,8);

				group.add(gemme); // place la gemme dans une "boite", seule la boite sera ainsi manipulée

				group.position.x = Math.random() * 2 - 1;
				group.position.z = Math.random() * 2 - 1;
				group.position.normalize();
				group.position.multiplyScalar(Math.random() * 90);

				scene.add(group);

				arrayGemmes.push(group.children[0]);
			}
		});

		var texture = new THREE.TextureLoader().load("grasslight-big.jpg");
		var geometry = new THREE.BoxGeometry(200, 200, 10);
		var material = new THREE.MeshLambertMaterial({ map: texture });
		var box = new THREE.Mesh(geometry, material);
		box.rotation.set(- Math.PI * 0.5, 0, 0);
		scene.add(box);

		var back = true;
		var raycaster = new THREE.Raycaster(); // nécessaire pour débuter le raycaster
		var mouse = new THREE.Vector2(); // nécessaire pour les coordonnées de la souris

		var controls = new THREE.OrbitControls(camera, renderer.domElement);
		controls.maxPolarAngle = Math.PI * 0.45;
		controls.addEventListener('change', function(){ renderer.render(scene, camera); });

		function onDocumentMouseDown(event) {
		    event.preventDefault();
		    // calcule les coordonnées de la souris en 2d
		    mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
		    mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

		    raycaster.setFromCamera(mouse, camera); // convertit les coordonnées 2d en 3d

		    var intersects = raycaster.intersectObjects(arrayGemmes); // stocke un objet intercepté par le raycaster

		    // vérifie si le raycaster a intercepté un objet
		    if(intersects.length > 0){
		        intersects[0].object.material.color.setHex(Math.random() * 0xffffff); // applique un changement sur l'objet intercepté
		    }
		};

		function render(){
			requestAnimationFrame(render);

			for(var i = 0; i < arrayGemmes.length; i++){
				arrayGemmes[i].rotation.y += 0.01;

				if(arrayGemmes[i].position.y <= 10 && back){    
					arrayGemmes[i].position.y += 0.01;
				} else if(arrayGemmes[i].position.y > 9.5){
					back = false;
					arrayGemmes[i].position.y -= 0.01;
				} else {
					back = !back;
				}
			}

		    renderer.render(scene, camera);
		}

		render();
	</script>
</body>
</html>