<!DOCTYPE html>
<html>
<head>
	<title>Raycaster</title>
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
		scene.background = new THREE.Color(0xf0f0f0);

		var renderer = new THREE.WebGLRenderer({antialias: true});
		renderer.setSize(window.innerWidth, window.innerHeight);
		document.body.appendChild(renderer.domElement);

		var camera = new THREE.PerspectiveCamera(70, window.innerWidth/window.innerHeight, 0.1, 1000);
		scene.add(camera);

		var light = new THREE.DirectionalLight(0xffffff, 1);
		light.position.set(1, 1, 1).normalize();
		scene.add(light);

		var rayCaster = new THREE.Raycaster();
		var mouse = new THREE.Vector2();
		var geometry = new THREE.BoxBufferGeometry( 20, 20, 20 );
		var intersected;

		document.addEventListener('mousemove', mouseMove, false);

		for ( var i = 0; i < 300; i ++ ) {
			var object = new THREE.Mesh( geometry, new THREE.MeshLambertMaterial( { color: Math.random() * 0xffffff } ) );
			object.position.x = Math.random() * 800 - 400;
			object.position.y = Math.random() * 800 - 400;
			object.position.z = Math.random() * 800 - 400;

			object.rotation.x = Math.random() * 2 * Math.PI;
			object.rotation.y = Math.random() * 2 * Math.PI;
			object.rotation.z = Math.random() * 2 * Math.PI;

			object.scale.x = Math.random() + 0.5;
			object.scale.y = Math.random() + 0.5;
			object.scale.z = Math.random() + 0.5;

			scene.add(object);
		}

		function mouseMove(event){
			event.preventDefault();
		   	mouse.x = ( event.clientX / window.innerWidth ) * 2 - 1;
		   	mouse.y = -( event.clientY / window.innerHeight ) * 2 + 1;	   	
		}

		function render(){
			rayCaster.setFromCamera(mouse, camera);

		   	var intersects = rayCaster.intersectObjects(scene.children);

		   	if(intersects.length > 0){
		   		if(intersected != intersects[0].object){
		       		if(intersected) intersected.material.emissive.setHex(intersected.currentHex);
		       		intersected = intersects[0].object;
		       		intersected.currentHex = intersected.material.emissive.getHex();
					intersected.material.emissive.setHex(0xE84F0E);
		       	}
		    } else {
		    	if(intersected) intersected.material.emissive.setHex(intersected.currentHex);
				intersected = null;
		   	}

		   	requestAnimationFrame(render);
		    renderer.render(scene, camera);
		}

		render();
	</script>
</body>
</html>