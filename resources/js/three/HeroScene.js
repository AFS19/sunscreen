import * as THREE from 'three';

class HeroScene {
    constructor(containerId) {
        this.container = document.getElementById(containerId);
        if (!this.container) return;

        this.isMobile = window.innerWidth < 768;
        this.pixelRatio = this.isMobile ? 0.5 : 0.75;
        this.isVisible = true;
        this.isInViewport = true;
        this.mouseX = 0;
        this.mouseY = 0;
        this.lastFrameTime = 0;
        this.frameInterval = this.isMobile ? 1000 / 30 : 1000 / 60; // 30fps on mobile, 60fps on desktop
        this.animationId = null;

        this.init();
        this.createScene();
        this.createTorus();
        this.createParticles();
        this.addEventListeners();
        this.setupViewportObserver();
        this.animate();
    }

    init() {
        this.scene = new THREE.Scene();
        this.camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        this.camera.position.z = 5;

        this.renderer = new THREE.WebGLRenderer({ 
            antialias: false, 
            alpha: true,
            powerPreference: 'high-performance'
        });
        this.renderer.setSize(window.innerWidth, window.innerHeight);
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, this.pixelRatio));
        this.container.appendChild(this.renderer.domElement);
    }

    createScene() {
        // Fog for depth
        this.scene.fog = new THREE.FogExp2(0x0a0a1a, 0.02);
    }

    createTorus() {
        const radius = this.isMobile ? 6 : 8;
        const tube = this.isMobile ? 1.5 : 2;
        const tubularSegments = this.isMobile ? 60 : 100;
        const radialSegments = this.isMobile ? 12 : 16;

        const geometry = new THREE.TorusKnotGeometry(radius, tube, tubularSegments, radialSegments, 2, 3);

        // Wireframe material with color shifting
        const material = new THREE.MeshBasicMaterial({
            color: 0xf59e0b,
            wireframe: true,
            transparent: true,
            opacity: 0.6
        });

        this.torus = new THREE.Mesh(geometry, material);
        this.scene.add(this.torus);

        // Inner glow mesh
        const glowMaterial = new THREE.MeshBasicMaterial({
            color: 0x06b6d4,
            wireframe: true,
            transparent: true,
            opacity: 0.3
        });

        const glowGeometry = new THREE.TorusKnotGeometry(radius * 0.9, tube * 0.8, tubularSegments, radialSegments, 2, 3);
        this.glowTorus = new THREE.Mesh(glowGeometry, glowMaterial);
        this.scene.add(this.glowTorus);
    }

    createParticles() {
        const particleCount = this.isMobile ? 30 : 80;
        const geometry = new THREE.BufferGeometry();
        const positions = new Float32Array(particleCount * 3);
        const colors = new Float32Array(particleCount * 3);

        const colorPalette = [
            new THREE.Color(0xf59e0b), // amber
            new THREE.Color(0x06b6d4), // cyan
            new THREE.Color(0x8b5cf6)  // violet
        ];

        for (let i = 0; i < particleCount; i++) {
            const i3 = i * 3;
            positions[i3] = (Math.random() - 0.5) * 30;
            positions[i3 + 1] = (Math.random() - 0.5) * 30;
            positions[i3 + 2] = (Math.random() - 0.5) * 20 - 5;

            const color = colorPalette[Math.floor(Math.random() * colorPalette.length)];
            colors[i3] = color.r;
            colors[i3 + 1] = color.g;
            colors[i3 + 2] = color.b;
        }

        geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
        geometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));

        const material = new THREE.PointsMaterial({
            size: this.isMobile ? 0.08 : 0.05,
            vertexColors: true,
            transparent: true,
            opacity: 0.8
        });

        this.particles = new THREE.Points(geometry, material);
        this.scene.add(this.particles);
    }

    addEventListeners() {
        window.addEventListener('resize', () => this.onResize());
        document.addEventListener('mousemove', (e) => this.onMouseMove(e));
        document.addEventListener('visibilitychange', () => this.onVisibilityChange());
    }

    setupViewportObserver() {
        // Pause rendering when hero section leaves viewport
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                this.isInViewport = entry.isIntersecting;
            });
        }, {
            root: null,
            rootMargin: '100px', // Start rendering slightly before in view
            threshold: 0
        });

        observer.observe(this.container);
        this.viewportObserver = observer;
    }

    onResize() {
        this.camera.aspect = window.innerWidth / window.innerHeight;
        this.camera.updateProjectionMatrix();
        this.renderer.setSize(window.innerWidth, window.innerHeight);
    }

    onMouseMove(e) {
        this.mouseX = (e.clientX / window.innerWidth) * 2 - 1;
        this.mouseY = -(e.clientY / window.innerHeight) * 2 + 1;
    }

    onVisibilityChange() {
        this.isVisible = !document.hidden;
    }

    animate(currentTime = 0) {
        this.animationId = requestAnimationFrame((time) => this.animate(time));

        // Skip if tab hidden or hero not in viewport
        if (!this.isVisible || !this.isInViewport) return;

        // Frame rate limiting
        const deltaTime = currentTime - this.lastFrameTime;
        if (deltaTime < this.frameInterval) return;
        this.lastFrameTime = currentTime;

        // Rotate torus
        this.torus.rotation.x += 0.002;
        this.torus.rotation.y += 0.003;
        this.glowTorus.rotation.x -= 0.0015;
        this.glowTorus.rotation.y -= 0.002;

        // Float particles
        this.particles.rotation.y += 0.0005;
        this.particles.rotation.x += 0.0002;

        // Mouse parallax
        const targetX = this.mouseX * 0.5;
        const targetY = this.mouseY * 0.5;
        this.camera.position.x += (targetX - this.camera.position.x) * 0.05;
        this.camera.position.y += (targetY - this.camera.position.y) * 0.05;
        this.camera.lookAt(this.scene.position);

        // Color shift over time
        const time = Date.now() * 0.0005;
        const hue = (time % 1);
        this.torus.material.color.setHSL(0.08 + hue * 0.15, 0.9, 0.5);

        this.renderer.render(this.scene, this.camera);
    }

    destroy() {
        // Stop animation loop
        if (this.animationId) {
            cancelAnimationFrame(this.animationId);
        }

        // Disconnect observer
        if (this.viewportObserver) {
            this.viewportObserver.disconnect();
        }

        // Remove event listeners
        window.removeEventListener('resize', this.onResize);
        document.removeEventListener('mousemove', this.onMouseMove);
        document.removeEventListener('visibilitychange', this.onVisibilityChange);

        // Dispose Three.js objects
        if (this.torus) {
            this.torus.geometry.dispose();
            this.torus.material.dispose();
        }
        if (this.glowTorus) {
            this.glowTorus.geometry.dispose();
            this.glowTorus.material.dispose();
        }
        if (this.particles) {
            this.particles.geometry.dispose();
            this.particles.material.dispose();
        }

        // Remove renderer
        if (this.renderer) {
            this.renderer.dispose();
            if (this.container && this.renderer.domElement) {
                this.container.removeChild(this.renderer.domElement);
            }
        }
    }
}

export default HeroScene;
