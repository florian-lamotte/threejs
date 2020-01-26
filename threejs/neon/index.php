<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Neon</title>
	<style>
		body { margin:0; }
		canvas { width:100%; height:100%; }
	</style>
</head>
<body>
	<script src="../threejs-master/three.js"></script>
	<script src="../threejs-master/OrbitControls.js"></script>
	<script src="../threejs-master/EffectComposer.js"></script>
	<script src="../threejs-master/RenderPass.js"></script>
	<script src="../threejs-master/ShaderPass.js"></script>
	<script src="../threejs-master/CopyShader.js"></script>
	<script src="../threejs-master/LuminosityHighPassShader.js"></script>
	<script src="../threejs-master/UnrealBloomPass.js"></script>
	<script src="../threejs-master/HorizontalBlurShader.js"></script>
	<script src="../threejs-master/VerticalBlurShader.js"></script>
	<script src="../dat.gui.min.js"></script>
	<script src="../resize.js"></script>
	<script>
		var scene, camera, renderer, ambientLight;
		var geometry, material, mesh;
		var effectController, changements, gui, composer, bloomPass, controls;

		init();
		light();
		mesh();
		gui();
		bloom();
		orbit();
		animate();

		function init(){
			scene = new THREE.Scene();

			camera = new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000);
			camera.position.z = 100;

			renderer = new THREE.WebGLRenderer();
			renderer.setSize(window.innerWidth, window.innerHeight);
			document.body.appendChild(renderer.domElement);
		}

		function light(){
			ambientLight = new THREE.AmbientLight(0xff2fff);
			scene.add(ambientLight);
		}

		function gui(){
			effectController = {
			    strength: 1.0,
			    radius: 0.0,
			    threshold: 0.0,
			    ambientlight: 0xff2fff
			};

			changements = function(){
			    bloomPass.strength = effectController.strength;
			    bloomPass.radius = effectController.radius;
			    bloomPass.threshold = effectController.threshold;
			    ambientLight.color = new THREE.Color(effectController.ambientlight);
			}

			gui = new dat.gui.GUI();	
			gui.add(effectController, 'strength').min(0).max(10).step(0.1).onChange(changements);
			gui.add(effectController, 'radius').min(-50).max(50).step(0.1).onChange(changements);
			gui.add(effectController, 'threshold').min(0).max(0.5).step(0.01).onChange(changements);
			gui.addColor(effectController, 'ambientlight').onChange(changements);
			//gui.close();
		}

		function mesh(){
			geometry = new THREE.RingGeometry(6,8,30,1,0,Math.PI*2);
			// geometry = new THREE.TorusGeometry(10,1,30,100,Math.PI*2);
			material = new THREE.MeshPhongMaterial({
				map: new THREE.TextureLoader().load("glowmap.png")
			});
			mesh = new THREE.Mesh(geometry, material);
			mesh.rotation.set(-1.2,0,-1);
			mesh.scale.set(5,5,5);
			scene.add(mesh);
		}

		function bloom(){
			composer = new THREE.EffectComposer(renderer);
			composer.addPass(new THREE.RenderPass(scene, camera));
			//composer.addPass(new THREE.ShaderPass(THREE.HorizontalBlurShader));
			//composer.addPass(new THREE.ShaderPass(THREE.VerticalBlurShader));

			bloomPass = new THREE.UnrealBloomPass(new THREE.Vector2(window.innerWidth, window.innerHeight), 1, 0, 0);
			bloomPass.renderToScreen = true;
		    composer.addPass(bloomPass);
		}

		function orbit(){
			controls = new THREE.OrbitControls(camera, renderer.domElement);
			controls.update();
		}

		function animate(){
			requestAnimationFrame(animate);
			composer.render();
		}
	</script>
</body>
</html>