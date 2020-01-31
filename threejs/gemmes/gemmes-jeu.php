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
		var back = true;
		var group = new THREE.Group();
		var loader = new THREE.JSONLoader();
		var raycaster = new THREE.Raycaster();
		var mouse = new THREE.Vector2();
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

		loader.load('https://raw.githubusercontent.com/PavelLaptev/test-rep/master/threejs-post/diamond.json', function(geometry){
			for(var i = 0; i < 10; i++){
				// MeshPhongMaterial est a placer à l'intérieur de la boucle dans le cas où elle devrait être personnalisable pour chaque gemme. Si elle est placée en dehors, chacune de ses modifications affectera toutes les gemmes.
				material = new THREE.MeshPhongMaterial({
					color: 0xCC0000,
					transparent: true,
					opacity: 0.9,
					shading: THREE.FlatShading
				});

				gemme = new THREE.Mesh(geometry, material);
				gemme.position.x = Math.random() * 180 - 90;
				gemme.position.z = Math.random() * 180 - 90;
				gemme.scale.set(8,8,8);

				group.add(gemme);
			}

			group.position.y = 10;
			scene.add(group);
		});

		var geometry = new THREE.BoxGeometry(200, 200, 10);
		var material = new THREE.MeshLambertMaterial({ map: new THREE.TextureLoader().load("grasslight-big.jpg") });
		var box = new THREE.Mesh(geometry, material);
		box.rotation.set(- Math.PI * 0.5, 0, 0);
		scene.add(box);

		var controls = new THREE.OrbitControls(camera, renderer.domElement);
		controls.maxPolarAngle = Math.PI * 0.45;
		controls.addEventListener('change', function(){ renderer.render(scene, camera); });

		function onDocumentMouseDown(event) {
		    event.preventDefault();
		    // calcule les coordonnées de la souris en 2d
		    mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
		    mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

		    raycaster.setFromCamera(mouse, camera); // convertit les coordonnées 2d en 3d

		    var intersects = raycaster.intersectObjects(group.children); // stocke un objet intercepté par le raycaster
		    var intersectsBox = raycaster.intersectObjects([box]);

		    // vérifie si le raycaster a intercepté un objet
		    if(intersects.length > 0){
		        // intersects[0].object.material.color.setHex(Math.random() * 0xffffff);
		        group.remove(intersects[0].object);
		    } else if(intersectsBox.length > 0){
				loader.load('https://raw.githubusercontent.com/PavelLaptev/test-rep/master/threejs-post/diamond.json', function(geometry){
					material = new THREE.MeshPhongMaterial({
						color: 0xCC0000,
						transparent: true,
						opacity: 0.9,
						shading: THREE.FlatShading
					});

					gemme = new THREE.Mesh(geometry, material);
					gemme.position.x = intersectsBox[0].point.x;
					gemme.position.z = intersectsBox[0].point.z;
					gemme.scale.set(8,8,8);

					group.add(gemme);
				});
		    }
		};

		function render(){
			requestAnimationFrame(render);

			for(var i = 0; i < group.children.length; i++){
        		group.children[i].rotation.y += 0.01;
			}

			if(group.position.y <= 10 && back){    
				group.position.y += 0.01;
			} else if(group.position.y > 9.5){
				back = false;
				group.position.y -= 0.01;
			} else {
				back = !back;
			}

		    renderer.render(scene, camera);
		}

		render();
	</script>
</body>
</html>