{{-- Components --}}
<script>
    if (window.history && window.history.pushState) {
        window.addEventListener('popstate', function() {
            location.reload();
        });
    }
</script>
<script>
    function redirectToFoto() {
        window.location.href = '{{ route('foto.index') }}';
    }
</script>
<script>
    function redirectToAlbum() {
        window.location.href = '{{ route('album.index') }}';
    }
</script>
{{-- Lenis Basic --}}
<script>
    const lenis = new Lenis()

    lenis.on('scroll', (e) => {
        console.log(e)
    })

    function raf(time) {
        lenis.raf(time)
        requestAnimationFrame(raf)
    }

    requestAnimationFrame(raf)
</script>
{{-- Parallax --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var parallax = document.getElementById("parallax");

        window.addEventListener("scroll", function() {
            var offset = window.pageYOffset;
            parallax.style.backgroundPositionY = offset * 0.5 +
                "px"; // Adjust the factor for the parallax effect
        });
    });
</script>
{{-- AOS --}}
<script>
    AOS.init({
        offset: 120,
        duration: 400,
        easing: 'ease-out-cubic',
        once: true,
        mirror: false,
        anchorPlacement: 'top-bottom',
    });
</script>
{{-- GSAP --}}
<script>
    const ourText = new SplitType('.hero-title', {
        types: 'chars'
    });
    const chars = ourText.chars;

    gsap.fromTo(
        chars, {
            y: 100,
            opacity: 0,
        }, {
            y: 0,
            opacity: 1,
            stagger: 0.05,
            duration: 1.5,
            ease: 'power4.out',
            delay: 1,
        }
    );
</script>
<script>
    gsap.registerPlugin(ScrollTrigger);

    const splitTypes = document.querySelectorAll('.section_title');

    splitTypes.forEach((char, i) => {
        const text = new SplitType(char, {
            types: 'chars'
        });

        gsap.from(text.chars, {
            scrollTrigger: {
                trigger: char,
                start: 'top 80%',
                end: 'top 20%',
                scrub: true,
                markers: false,
            },
            opacity: 0.2,
            stagger: 0.1,
        });
    });
</script>
<script>
    gsap.registerPlugin(ScrollTrigger);

    const animatedHr = document.querySelectorAll('.animated-hr');

    animatedHr.forEach(hr => {
        gsap.from(hr, {
            scrollTrigger: {
                trigger: hr,
                start: 'top 80%',
                end: 'top 20%',
                scrub: true,
                markers: false,
            },
            scaleX: 0, // Animate scaleX property to create a reveal effect
            transformOrigin: '0% 50%', // Set transform origin to left for scaleX animation
            ease: 'power2.out', // Adjust easing as needed
        });
    });
</script>
{{-- TNS --}}
<script>
    var slider = tns({
        container: '.popular_slider',
        items: 1,
        controls: false,
        mouseDrag: true,
        autoplayTimeout: 4000,
        autoplay: true,
        autoplayButtonOutput: false,
        responsive: {
            640: {
                edgePadding: 20,
                gutter: 20,
                items: 3
            },
            700: {
                gutter: 30
            },
            900: {
                items: 4
            }
        }
    });
</script>
