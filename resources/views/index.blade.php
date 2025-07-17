<x-layout.app>
    
    {{-- Navbar --}}
    <nav class="navbar">
        <div class="navbar__container">
            <div class="navbar__banner">
                Chelsie Liwe
            </div>
            <button class="navbar__button">X</button>
            <div class="navbar__menu" style="transform: translateX(100%);" data-visible="false" data-position="100">
                <a href="#about" class="navbar__menu__item">About</a>
                <a href="#education" class="navbar__menu__item">Education</a>
                <a href="#my-tiktok" class="navbar__menu__item">My Tiktok</a>
                <a href="#my-works" class="navbar__menu__item">My Works</a>
                <a href="#contact" class="navbar__menu__item">Contact</a>
            </div>
        </div>
    </nav>
    
    {{-- Jumbotron --}}
    <section class="jumbotron" data-navbar-color="#222222">
        <div class="jumbotron__container">
            <img src="{{ asset('assets/img/carpet.png') }}" class="carpet" mouse-move="1">
            <img src="{{ asset('assets/img/trapesium.png') }}" class="trapesium" mouse-move="1.4">
            <img src="{{ asset('assets/img/plant.png') }}" class="plant" mouse-move="1.2">
            <img src="{{ asset('assets/img/block-plant.png') }}" class="block-plant" mouse-move="1.8">
            <img src="{{ asset('assets/img/tv.png') }}" class="tv" mouse-move="1.4">
            <div class="frame-container" mouse-move="1.7" data-animate="top" data-delay="1" data-animate-time="2">
                <img src="{{ asset('assets/img/frame.png') }}" class="frame" mouse-move="1.2">
                <img src="{{ asset('assets/img/neon-name.png') }}" class="neon-name" mouse-move="1.3">
                <img src="{{ asset('assets/img/neon-circle.png') }}" class="neon-circle" mouse-move="1.4">
            </div>
            <img src="{{ asset('assets/img/ball-box.png') }}" class="ball-box" mouse-move="1.6">
            <img src="{{ asset('assets/img/cinnamoyol.png') }}" class="cinnamoyol" mouse-move="1.5">
        </div>
    </section>
    
    {{-- About --}}
    <section id="about" class="about" data-navbar-color="#222222">
        <div class="about__container">
            <div class="about__left">
                <div class="photo-container" parallax-bottom=".2">
                    <img src="{{ asset('assets/img/chelsie-1.png') }}" class="photo">
                </div>
            </div>
            <div class="about__right">
                <div class="about__right__text">
                    <h2 class="title">Chelsie<br>Liwe</h2>
                    <p>My name is Chelsie Michelle Gabrielle Liwe. I am a graduate student majoring in Digital Business. I am very interested in creative industry, where in this field I am able to express my creativity and create new innovations by adopting the latest trends in the content industry. With the knowledge I have, I am very excited to collaborate, learn, and contribute to the ever-evolving world of digital business.</p>
                </div>
                <div class="about__right__buttons">
                    <a class="btn" href=""><i class="fa-solid fa-file-arrow-down"></i>Curriculum Vitae</a>
                    <div class="buttons__sosmed">
                        <a class="btn btn-outline" href=""><i class="fa-brands fa-instagram"></i></a>
                        <a class="btn btn-outline" href=""><i class="fa-brands fa-tiktok"></i></a>
                        <a class="btn btn-outline" href=""><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
      
    {{-- Education --}}
    <section id="education" class="education" data-navbar-color="#222222">
        <div class="education__container">
            <h2 class="education__title">Educations</h2>
            <div class="education__timeline">
                <div class="education__list">
                    <div class="education__item" data-animate="top" data-animate-offset="300">
                        <small class="item__year">2017-2020</small>
                        <h4 class="item__institution">Makassar Adventist High School</h4>
                    </div>
                    <div class="education__item" data-animate="top" data-animate-offset="300">
                        <small class="item__year">2020-2024</small>
                        <h4 class="item__institution">Bunda Mulia University</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    {{-- Skill --}}
    <section class="skill" data-navbar-color="#FFFFFF">
        <div class="skill__container">
            <h2 class="skill__title">What I Do?</h2>
            <div class="skill__list">
                <model-viewer id="polaroid"
                    src="{{ asset('assets/img/polaroid_cam.glb') }}"
                    alt="Polaroid Camera"
                    background-color="#111" class="polaroid-cam">
                </model-viewer>
                </model-viewer>
                <h4 class="skill__item">Content Creator</h4>
                <h4 class="skill__item">Videographer</h4>
                <h4 class="skill__item">Video Editor</h4>
                <h4 class="skill__item">Scriptwriter</h4>
                <h4 class="skill__item">Voice Over Artist</h4>
            </div>
        </div>
    </section>
    
    {{-- Tiktok --}}
    <section id="my-tiktok" class="tiktok"data-navbar-color="#FFFFFF">
        <div class="tiktok__container">
            <div class="tiktok__left">
                <h2 class="tiktok__left__title">My Tiktok</h2>
                <p class="tiktok__left__text" data-animate="left">I create fashion content on TikTok to inspire others with easy styling tips, outfit ideas, and personal fashion favorites. My goal is to share looks that are relatable, wearable, and true to my own style— while also keeping up with current trends and seasonal aesthetics.</p>
                <div class="tiktok__info">
                    <div class="tiktok__info__item">
                        <p class="count" data-target="128000">0</p>
                        <small>Followers</small>
                    </div>
                    <div class="tiktok__info__item">
                        <p class="count" data-target="2300000">0</p>
                        <small>Likes</small>
                    </div>
                </div>
                <a href="" class="btn" data-animate="bottom" data-animate-offset="50"><i class="fa-brands fa-tiktok"></i>Check My TikTok</a>
            </div>
            <div class="tiktok__right" parallax-bottom=".3">
                <div class="swipe-up">
                    <div class="arrows">
                      <span></span>
                      <span></span>
                    </div>
                    <p>Swipe Up</p>
                </div>
                <div class="icons">
                    <div class="profile" parallax-bottom=".05">
                        <img src="{{ asset('assets/img/tiktok-avatar.jpeg') }}" alt="" class="tiktok-avatar">
                        <small>@itsmichxi</small>
                    </div>
                    <img src="{{ asset('assets/img/tiktok.png') }}" alt="" class="tiktok-icon" parallax-bottom=".2">
                    <img src="{{ asset('assets/img/like-icon.png') }}" alt="" class="like-icon" data-animate="right" data-delay=".5">
                </div>
                <img src="{{ asset('assets/img/phone-frame.png') }}" class="phone-frame">
                <div class="videos">
                    <video class="video-item" autoplay muted loop playsinline>
                        <source src="{{ asset('assets/video/1.mp4') }}" type="video/mp4">
                    </video>
                    <video class="video-item" autoplay muted loop playsinline>
                        <source src="{{ asset('assets/video/2.mp4') }}" type="video/mp4">
                    </video>
                    <video class="video-item" autoplay muted loop playsinline>
                        <source src="{{ asset('assets/video/3.mp4') }}" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </section>
        
    {{-- Partner --}}
    <section class="partner" data-navbar-color="#FFFFFF">
        <div class="partner__container">
            <h2 class="partner__title">Career Highlights</h2>
            <div class="partner__list">
                <img class="partner__item" src="{{ asset('assets/img/cellular-world.png') }}" data-animate="top" data-animate-offset="200" data-delay=".5">
                <img class="partner__item" src="{{ asset('assets/img/kreatif-imaji-nusantara.png') }}" data-animate="top" data-animate-offset="200" data-delay=".7">
                <img class="partner__item" src="{{ asset('assets/img/sellany-kicks.png') }}" data-animate="top" data-animate-offset="200" data-delay=".2">
                <img class="partner__item" src="{{ asset('assets/img/tigris-official.png') }}" data-animate="top" data-animate-offset="200" data-delay=".3">
                <img class="partner__item" src="{{ asset('assets/img/tazawa-ramen-menteng.png') }}" data-animate="top" data-animate-offset="200" data-delay=".6">
                <img class="partner__item" src="{{ asset('assets/img/best-bali-adventures.png') }}" data-animate="top" data-animate-offset="200" data-delay=".4">
                <img class="partner__item" src="{{ asset('assets/img/bali-games-rental.png') }}" data-animate="top" data-animate-offset="200" data-delay=".6">
                <img class="partner__item" src="{{ asset('assets/img/bali-event-styling.png') }}" data-animate="top" data-animate-offset="200" data-delay=".5">
                <img class="partner__item" src="{{ asset('assets/img/bali-decor-rentals.png') }}" data-animate="top" data-animate-offset="200" data-delay=".2">
                <img class="partner__item" src="{{ asset('assets/img/bali-event-planner.png') }}" data-animate="top" data-animate-offset="200" data-delay=".6">
            </div>
        </div>
    </section>
    
    {{-- Work --}}
    <section id="my-works" class="work" data-navbar-color="#222222">
        <div class="work__container">
            <h2 class="work__title" data-animate="left">My<br>Work</h2>
            <div class="work__list">
                @foreach ($carriers as $carrier)    
                <div class="work__item" data-animate="right">
                    <div class="item__cover">
                        @if ($carrier->job)    
                        <span class="item__info" data-visible="false">
                            <h4>My Work</h4>
                            <ul>
                                @foreach (json_decode($carrier->job, true) as $job)
                                    @if (!empty($job))
                                        <li>{{ $job }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </span>
                        @endif
                        <div class="cover__list">
                            <div class="cover__parallax" parallax-top=".2">
                                @foreach ($carrier->carrierCovers->whereNotNull('path') as $cover)
                                    <img src="{{ asset('storage/'. $cover->path) }}" alt="" class="cover__item">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="item__description">
                        <h3 class="item__title">{{ $carrier->company }}</h3>
                        @if ($carrier->job)
                            <button class="btn btn-show">See My work</button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    
    {{-- Closing --}}
    <section class="closing" data-navbar-color="#222222" data-offset-bottom="-310">
        <div class="closing__container">
            <span class="closing__title">Let's Work Together</span>
            <div class="photo-container">
                <img src="{{ asset('assets/img/chelsie-2.png') }}" alt="" class="photo" parallax-bottom=".18">
            </div>
        </div>
    </section>
    
    {{-- Contact --}}
    <section id="contact" class="contact" data-navbar-color="#FFFFFF" data-offset-bottom="0">
        <div class="contact__container">
            <h2 class="contact__title">Get in<br>Touch</h2>
            <div class="contact__list">
                <div class="contact__item">
                    <h4 class="item__title">Phone</h4>
                    <p>(+62) 895-2262-5397</p>
                </div>
                <div class="contact__item">
                    <h4 class="item__title">Email</h4>
                    <p>chelsieliwe@gmail.com</p>
                </div>
                <div class="contact__item">
                    <h4 class="item__title">Follow</h4>
                    <p>chelsieliwe</p>
                    <p>Chelsie Liwe</p>
                </div>
            </div>
        </div>
    </section>
    
</x-layout.app>