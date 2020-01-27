var scene = new THREE.Scene;
scene.background = new THREE.Color(0xf0f0f0);

var renderer = new THREE.WebGLRenderer({antialias: true});
renderer.setSize(window.innerWidth, window.innerHeight);
document.body.appendChild(renderer.domElement);

var camera = new THREE.PerspectiveCamera(70, window.innerWidth/window.innerHeight, 0.1, 1000);
camera.position.z = 100;
scene.add(camera);

var geometry = new THREE.SphereGeometry(10, 32, 32);

var materialBasic = new THREE.MeshBasicMaterial({color: 0xFF530D});
var materialLambert = new THREE.MeshLambertMaterial({color: 0xFF530D}); // aspect mat (éclairage par les somments)
var materialDepth = new THREE.MeshDepthMaterial();
var materialNormal = new THREE.MeshNormalMaterial();
var materialPhong = new THREE.MeshPhongMaterial({color: 0xFF530D}); // aspect brillant (éclairage en fonction des pixels)
var materialPhysical = new THREE.MeshPhysicalMaterial({color: 0xFF530D});
var materialStandard = new THREE.MeshStandardMaterial({color: 0xFF530D});
var materialToon = new THREE.MeshToonMaterial({color: 0xFF530D});

var sphereBasic = new THREE.Mesh(geometry, materialBasic);
var sphereLambert = new THREE.Mesh(geometry, materialLambert);
var sphereDepth = new THREE.Mesh(geometry, materialDepth);
var sphereNormal = new THREE.Mesh(geometry, materialNormal);
var spherePhong = new THREE.Mesh(geometry, materialPhong);
var spherePhysical = new THREE.Mesh(geometry, materialPhysical);
var sphereStandard = new THREE.Mesh(geometry, materialStandard);
var sphereToon = new THREE.Mesh(geometry, materialToon);

sphereBasic.position.set(-30, 30, 0);
sphereLambert.position.y = 30;
sphereDepth.position.set(30, 30, 0);
sphereNormal.position.x = -30;
spherePhysical.position.x = 30;
sphereStandard.position.set(-30, -30, 0);
sphereToon.position.y = -30;

scene.add(sphereBasic);
scene.add(sphereLambert);
scene.add(sphereDepth);		
scene.add(sphereNormal);	
scene.add(spherePhong);	
scene.add(spherePhysical);
scene.add(sphereStandard);
scene.add(sphereToon);

function render(){
	requestAnimationFrame(render);
	renderer.render(scene, camera);
}

render();