<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Texte 3D</title>
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
		var scene = new THREE.Scene();
		var camera = new THREE.PerspectiveCamera(45, window.innerWidth/window.innerHeight, 0.1, 2000);
		var renderer = new THREE.WebGLRenderer();
		renderer.setSize(window.innerWidth, window.innerHeight);
		document.body.appendChild(renderer.domElement);

		camera.position.z = 1000;

		var light = new THREE.AmbientLight(0x404040);
		scene.add(light);

		var pointLight = new THREE.PointLight( 0xffffff, 1.5 );
		pointLight.position.set( 0, 100, 90 );
		scene.add( pointLight );

		var loader = new THREE.FontLoader();
		var material = new THREE.MeshLambertMaterial({ color: 0xCC0000 });
		loader.load('Montserrat_Regular.json', function(font){
		    var textGeom = new THREE.TextGeometry('Coucou !', {
		        font: font
		    });
		    var textMesh = new THREE.Mesh(textGeom, material);
    		scene.add(textMesh);
    		textMesh.position.x = -300;
    	});

    	var controls = new THREE.OrbitControls(camera, renderer.domElement);
		controls.update();

		var animate = function (){
			requestAnimationFrame(animate);
			renderer.render(scene, camera);
		};

		animate();
	</script>
</body>
</html>