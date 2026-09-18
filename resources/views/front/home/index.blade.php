@extends('layouts.front.app')
@section('title', @$meta_title)
@section('meta_description', @$meta_description)
@section('content')
    <section id="hero-animation">
        <div id="landingHero"  style="padding-bottom:60px;">
            <div class="container">
            </div>
        </div>
    </div>
</section>

    <section id="section-hero">
        @include('front.home.section-hero')
    </section>

    <section id="section-filter">
        @include('front.home.section-filter')
    </section>
    
    <section id="section-maps">
        @include('front.home.section-maps')
    </section>

    <section id="section-harga-pasar">
        @include('front.home.section-harga-pasar')
    </section>

    <section id="section-rekomendasi">
        @include('front.home.section-rekomendasi')
    </section>

    <section id="section-produksi-populasi">
        @include('front.home.section-produksi-populasi')
    </section>

    <section id="section-dokter-upt">
        @include('front.home.section-dokter-upt')
    </section>

    <section id="section-chart">
        @include('front.home.section-chart')
    </section>


@push('styles')
<style>
section {
    position: relative;
}

html {
    scroll-behavior: smooth;
}

section[id] {
    scroll-margin-top: 80px;
}

.navbar-nav .nav-link {
    position: relative;
    transition: all 0.3s ease;
}

.navbar-nav .nav-link:hover,
.navbar-nav .nav-link.active {
    color: var(--bs-primary) !important;
}

.navbar-nav .nav-link.active::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    right: 0;
    height: 2px;
    background: var(--bs-primary);
    border-radius: 2px;
}
</style>
@endpush


@endsection
@push('script')
<script>
    $(document).ready(function() {
        if (!window.location.hash || window.location.hash === '#') {
            window.scrollTo(0, 0);
        } else {
            var target = $(window.location.hash);
            if (target.length) {
                setTimeout(function() {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 80
                    }, 500);
                }, 100);
            }
        }
        
        $('a[href^="#"]').on('click', function(e) {
            var href = $(this).attr('href');
            if (href === '#' || href === '') return;
            
            var target = $(href);
            if (target.length) {
                e.preventDefault();
                
                if (history.pushState) {
                    history.pushState(null, null, href);
                } else {
                    window.location.hash = href;
                }
                
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 80
                }, 800);
                
                $('#navbarSupportedContent').collapse('hide');
            }
        });
        
        function updateActiveNavLink() {
            var scrollPos = $(window).scrollTop() + 120; 
            var currentSectionId = null;

            $('section[id]').each(function() {
                var $section = $(this);
                var sectionTop = $section.offset().top;
                var sectionHeight = $section.outerHeight();

                if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                    currentSectionId = $section.attr('id');
                    return false; 
                }
            });

            if (currentSectionId) {
                $('.navbar-nav .nav-link').removeClass('active');
                $('.navbar-nav .nav-link[href="#' + currentSectionId + '"]').addClass('active');
            } else {
                $('.navbar-nav .nav-link').removeClass('active');
                $('.navbar-nav .nav-link[href="#section-hero"]').addClass('active');
            }
        }

        $(window).on('scroll', updateActiveNavLink);
        updateActiveNavLink();
    });
    
    window.addEventListener('load', function() {
        if (window.location.hash && window.location.hash !== '#') {
            var target = $(window.location.hash);
            if (target.length) {
                setTimeout(function() {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 80
                    }, 500);
                }, 200);
            }
        } else {
            window.scrollTo(0, 0);
        }
    });
</script>
@endpush
