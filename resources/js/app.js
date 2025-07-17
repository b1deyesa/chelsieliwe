import './bootstrap';

$(document).ready(function () {
    initMouseParallax();
    initAnimateItems();
    $(window).on('scroll resize', handleScroll);
    $(window).trigger('scroll'); // Initial trigger
    animateClosingTitle();
    $(window).on('scroll resize', animateClosingTitle);
    setupMenuToggle();
});

function handleScroll() {
    triggerAnimateItems();
    animateSkillItems();
    animateSkillTitle();
    animateTiktokTitle();
    animateParallaxElements();
    animateWorkSection();
    animateClosingSection();
    updateNavbarColor();
}

function initMouseParallax() {
    $('.jumbotron').on('mousemove', function (e) {
        const container = $(this);
        const { left, top } = container.offset();
        const offsetX = e.pageX - left;
        const offsetY = e.pageY - top;
        const centerX = container.width() / 2;
        const centerY = container.height() / 2;
        const moveX = (offsetX - centerX) / 100;
        const moveY = (offsetY - centerY) / 100;

        container.find('[mouse-move]').each(function () {
            const depth = $(this).data('depth') || 1;
            $(this).css('transform', `translate(${moveX * depth}px, ${moveY * depth}px)`);
        });
    });
}

function initAnimateItems() {
    const defaultTime = 0.6;
    $('[data-animate]').each(function () {
        const item = $(this);
        const direction = item.data('animate');
        const time = parseFloat(item.data('animate-time')) || defaultTime;
        const transformStart = getTransformStart(direction);

        item.css({
            opacity: 0,
            transform: transformStart,
            transition: `all ${time}s ease`
        });
    });
}

function getTransformStart(direction) {
    switch (direction) {
        case 'top': return 'translateY(-30px)';
        case 'bottom': return 'translateY(30px)';
        case 'left': return 'translateX(-30px)';
        case 'right': return 'translateX(30px)';
        default: return 'translate(0, 0)';
    }
}

function triggerAnimateItems() {
    $('[data-animate]').each(function () {
        const item = $(this);
        const direction = item.data('animate');
        const delay = parseFloat(item.data('delay')) || 0;
        const time = parseFloat(item.data('animate-time')) || 0.6;
        const customOffset = parseInt(item.data('animate-offset')) || 300;

        const rect = item[0].getBoundingClientRect();
        const visible = rect.top < window.innerHeight - customOffset && rect.bottom > 0;

        setTimeout(() => {
            item.css({
                opacity: visible ? 1 : 0,
                transform: visible ? 'translate(0, 0)' : getTransformStart(direction),
                transition: `all ${time}s ease`
            });
        }, delay * 1000);
    });
}

function animateSkillItems() {
    const windowHeight = $(window).height();
    const scrollTop = $(window).scrollTop();
    const windowCenter = scrollTop + windowHeight / 1.8;

    $('.skill__item').each(function () {
        const $el = $(this);
        const elCenter = $el.offset().top + $el.outerHeight() / 2;
        const maxDistance = windowHeight / 2;
        let progress = ((elCenter - windowCenter) / maxDistance) * 0.6;
        progress = Math.max(-1, Math.min(1, progress));

        const translateX = progress * 100;
        const opacity = Math.pow(1 - Math.abs(progress), 8);
        $el.css({
            transform: `translateX(${($el.is(':nth-child(odd)') ? translateX : -translateX)}%)`,
            opacity: opacity
        });
    });

    updateSkillSectionColors();
}

function updateSkillSectionColors() {
    const $trigger = $('.skill');
    const scrollTop = $(window).scrollTop();
    const windowHeight = $(window).height();
    const scrollMiddle = scrollTop + windowHeight / 2;

    const triggerTop = $trigger.offset().top;
    const triggerHeight = $trigger.outerHeight();
    const relativeY = (scrollMiddle - triggerTop) / triggerHeight;

    const bgProgress = Math.max(0, Math.min(1, (relativeY - 0) / (0.2 - 0)));
    const bgValue = Math.round(255 - (255 - 17) * bgProgress);
    const textValue = Math.round(34 + (255 - 34) * bgProgress);

    const bgColor = `rgb(${bgValue}, ${bgValue}, ${bgValue})`;
    const textColor = `rgb(${textValue}, ${textValue}, ${textValue})`;

    $('.skill, .education').css('background-color', bgColor);
    $('.skill__item, .education__item').css('color', textColor);
}

function animateSkillTitle() {
    const $title = $('.skill__title');
    const $skill = $('.skill');

    if (!$title.length || !$skill.length) return;

    const windowHeight = $(window).height();
    const scrollTop = $(window).scrollTop();

    const skillTop = $skill.offset().top - 800;
    const skillHeight = $skill.outerHeight();
    const skillBottom = skillTop + skillHeight;
    const windowCenter = scrollTop + windowHeight / 1.2;

    let progress = 0;
    if (windowCenter > skillTop) {
        progress = Math.min(1, (windowCenter - skillTop) / skillHeight);
    }

    const scaleValue = 0.2 + progress * 0.8;
    const opacityValue = Math.min(1, progress * 1.5);
    const translateY = -30 * (1 - progress);

    $title.css({
        transform: `scale(${scaleValue}) translateY(${translateY}px)`,
        opacity: opacityValue,
        transition: 'all 0.3s ease-out'
    });
}

function animateTiktokTitle() {
    const $title = $('.tiktok__left__title');
    const $section = $('.tiktok');

    if (!$title.length || !$section.length) return;

    const windowHeight = $(window).height();
    const scrollTop = $(window).scrollTop();

    const sectionTop = $section.offset().top - 500;
    const sectionHeight = $section.outerHeight();
    const windowCenter = scrollTop + windowHeight / 1.2;

    let progress = 0;
    if (windowCenter > sectionTop) {
        progress = Math.min(1, (windowCenter - sectionTop) / sectionHeight);
    }

    const scaleValue = 0.2 + progress * 0.8;
    const opacityValue = Math.min(1, progress * 1.5);
    const translateY = -30 * (1 - progress);

    $title.css({
        transform: `scale(${scaleValue}) translateY(${translateY}px)`,
        opacity: opacityValue,
        transition: 'all 0.3s ease-out'
    });
}

function animateParallaxElements() {
    const windowHeight = $(window).height();
    const scrollTop = $(window).scrollTop();

    $('[parallax-top], [parallax-left], [parallax-right], [parallax-bottom]').each(function () {
        const $el = $(this);
        const offset = $el.offset().top;
        const height = $el.outerHeight();
        const elementCenter = offset + height / 2;
        const windowCenter = scrollTop + windowHeight / 2;
        const distance = elementCenter - windowCenter;

        let translateX = 0;
        let translateY = 0;

        if ($el.attr('parallax-top')) translateY -= distance * parseFloat($el.attr('parallax-top'));
        if ($el.attr('parallax-bottom')) translateY += distance * parseFloat($el.attr('parallax-bottom'));
        if ($el.attr('parallax-left')) translateX -= distance * parseFloat($el.attr('parallax-left'));
        if ($el.attr('parallax-right')) translateX += distance * parseFloat($el.attr('parallax-right'));

        $el.css('transform', `translate(${translateX}px, ${translateY}px)`);
    });
}

function animateWorkSection() {
    const $trigger = $('.work');
    const $partner = $('.partner');

    const scrollTop = $(window).scrollTop();
    const windowHeight = $(window).height();
    const scrollMiddle = scrollTop + windowHeight / 1.8;

    const triggerTop = $trigger.offset().top;
    const triggerHeight = $trigger.outerHeight();
    const relativeY = (scrollMiddle - triggerTop) / triggerHeight;

    const bgProgress = Math.max(0, Math.min(1, (relativeY - 0) / (0.1 - 0)));
    const bgValue = Math.round(255 - (255 - 17) * (1 - bgProgress));
    const textValue = Math.round(17 + (255 - 17) * bgProgress);

    const bgColor = `rgb(${bgValue}, ${bgValue}, ${bgValue})`;
    const textColor = `rgb(${textValue}, ${textValue}, ${textValue})`;

    $trigger.css('background-color', bgColor);
    $partner.css('background-color', bgColor);
}

function animateClosingSection() {
    const $trigger = $('.closing');
    const scrollTop = $(window).scrollTop();
    const windowHeight = $(window).height();
    const scrollMiddle = scrollTop + windowHeight / 1.5;

    const triggerTop = $trigger.offset().top + 200;
    const triggerHeight = $trigger.outerHeight();

    const relativeY = (scrollMiddle - triggerTop) / triggerHeight;
    const bgProgress = Math.max(0, Math.min(1, (relativeY - 0.3) / (0.5 - 0.4)));

    const r = 255;
    const g = Math.round(255 - (255 - 206) * bgProgress);
    const b = Math.round(255 - (255 - 223) * bgProgress);
    const closingColor = `rgb(${r}, ${g}, ${b})`;
    $trigger.css('background-color', closingColor);

    animateClosingTitle();
}

function animateClosingTitle() {
    const $title = $('.closing__title');
    const $photoContainer = $('.closing .photo-container');
    const $closing = $('.closing');

    const windowHeight = $(window).height();
    const scrollTop = $(window).scrollTop();

    const closingTop = $closing.offset().top;
    const closingHeight = $closing.outerHeight();
    const closingBottom = closingTop + closingHeight;
    const windowCenter = scrollTop + windowHeight / 2;

    let progress = 0;
    if (windowCenter > closingTop) {
        progress = Math.min(1, (windowCenter - closingTop) / closingHeight);
    }

    const skewValue = -15 * (1 - progress);
    const scaleTitle = 0.8 + progress * 0.7;
    const opacityTitle = progress * 1.6;
    const translateY = -50 * (1 - progress);

    const scalePhoto = 0.8 + progress * 0.4; // 0.8 → 1.0
    const opacityPhoto = progress * 2; // 0 → 1

    $title.css({
        transform: `skewX(${skewValue}deg) scale(${scaleTitle}) translateY(${translateY}px)`,
        opacity: opacityTitle,
        transition: 'all 0.4s ease-out'
    });

    $photoContainer.css({
        transform: `scale(${scalePhoto})`,
        opacity: opacityPhoto,
        transition: 'all 0.6s ease-out'
    });
}

function updateNavbarColor() {
    const scrollTop = $(window).scrollTop();
    const windowHeight = $(window).height();
    const windowCenter = scrollTop + windowHeight / 2;

    let prevSection = null;
    let nextSection = null;

    $('[data-navbar-color]').each(function () {
        const $section = $(this);
        const offsetTop = parseInt($section.data('offset-top')) || 0;
        const offsetBottom = parseInt($section.data('offset-bottom')) || 0;

        const sectionTop = $section.offset().top + offsetTop;
        const sectionBottom = $section.offset().top + $section.outerHeight() - offsetBottom;

        if (sectionBottom < windowCenter) {
            prevSection = $section;
        } else if (!nextSection && sectionTop > windowCenter) {
            nextSection = $section;
        } else if (sectionTop <= windowCenter && sectionBottom >= windowCenter) {
            prevSection = nextSection = $section;
            return false; // break
        }
    });

    let color = '#222222'; // default fallback

    if (prevSection && nextSection && prevSection[0] !== nextSection[0]) {
        const top = prevSection.offset().top + (parseInt(prevSection.data('offset-top')) || 0);
        const bottom = nextSection.offset().top + (parseInt(nextSection.data('offset-top')) || 0);
        const progress = (windowCenter - top) / (bottom - top);
        const color1 = prevSection.data('navbar-color');
        const color2 = nextSection.data('navbar-color');
        color = interpolateColor(color1, color2, progress);
    } else if (prevSection) {
        color = prevSection.data('navbar-color');
    }

    $('.navbar__banner, .navbar__button').css('color', color);
}

let isAnimating = false;

function setupMenuToggle() {
    const $button = $('.navbar__button');
    const $menuItems = $('.navbar__menu__item');

    $button.on('click', function () {
        if (isAnimating) return;
        $button.css('pointer-events', 'none');
        toggleMenu(() => {
            $button.css('pointer-events', '');
        });
    });

    $menuItems.on('click', function (e) {
        e.preventDefault();

        const targetID = $(this).attr('href');
        const $target = $(targetID);
        if ($target.length === 0) return;

        const targetOffset = $target.offset().top;

        if (isAnimating) return;
        $button.css('pointer-events', 'none');

        toggleMenu(() => {
            smoothScrollTo(targetOffset, () => {
                $button.css('pointer-events', '');
            });
        });
    });
}

function toggleMenu(callback) {
    const $menu = $('.navbar__menu');
    const isVisible = $menu.data('visible') === true;
    const from = isVisible ? 0 : 100;
    const to = isVisible ? 100 : 0;
    const duration = 600;
    const startTime = performance.now();

    isAnimating = true;

    function animate(time) {
        const elapsed = time - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const eased = easeOutCubic(progress);
        const value = from + (to - from) * eased;

        $menu.css('transform', `translateX(${value}%)`);
        $menu.data('position', value);

        if (progress < 1) {
            requestAnimationFrame(animate);
        } else {
            $menu.data('visible', !isVisible);
            isAnimating = false;
            if (typeof callback === 'function') callback();
        }
    }

    requestAnimationFrame(animate);
}

function smoothScrollTo(targetY, done) {
    const startY = window.pageYOffset;
    const distance = targetY - startY;
    const msPer1000px = 1200;
    const duration = Math.min(3000, Math.max(400, Math.abs(distance) / 1000 * msPer1000px));
    const startTime = performance.now();

    function scrollFrame(time) {
        const elapsed = time - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const eased = easeInOutQuad(progress);
        const scrollY = startY + distance * eased;

        window.scrollTo(0, scrollY);

        if (progress < 1) {
            requestAnimationFrame(scrollFrame);
        } else if (typeof done === 'function') {
            done();
        }
    }

    requestAnimationFrame(scrollFrame);
}

function easeOutCubic(t) {
    return 1 - Math.pow(1 - t, 3);
}

function easeInOutQuad(t) {
    return t < 0.5
        ? 2 * t * t
        : -1 + (4 - 2 * t) * t;
}

$(document).ready(function () {
    const viewer = document.getElementById('polaroid');
    let lastScrollTop = 0;

    let targetY = 90;
    let targetX = 80;
    let currentY = 90;
    let currentX = 90;

    function animate() {
        currentY += (targetY - currentY) * 0.8;
        currentX += (targetX - currentX) * 2;

        viewer.cameraOrbit = `${currentY.toFixed(2)}deg ${currentX.toFixed(2)}deg 7m`;

        requestAnimationFrame(animate);
    }

    animate(); // Start animation

    $(window).on('scroll', function () {
        const st = $(this).scrollTop();
        const delta = st - lastScrollTop;
        lastScrollTop = st;

        const tipY = Math.max(-10, Math.min(10, delta * 0.2));
        const tipX = Math.max(-2, Math.min(2, delta * 0.1)); // Keep small to avoid going back up

        targetY += tipY;
        targetY = Math.max(-25, Math.min(25, targetY));

        targetX += tipX;
        targetX = Math.max(-20, Math.min(0, targetX)); // Only between -20 (from below) to 0 (straight ahead)
    });
});

$(document).ready(function () {
    const $videos = $('.video-item');
    const $container = $('.videos');
    let current = 0;
    let scrollLocked = false;
    let touchStartY = 0;

    $videos.each(function (i) {
        $(this).css({
            position: 'absolute',
            width: '100%',
            height: '100%',
            top: i === 0 ? '0%' : '100%',
            zIndex: i === 0 ? 1 : 0,
            objectFit: 'cover'
        });
        if (i !== 0) this.pause();
    });

    function showVideo(index, forward = true) {
        if (scrollLocked || index === current) return;

        scrollLocked = true;

        const $current = $videos.eq(current);
        const $next = $videos.eq(index);

        const inDirection = forward ? '100%' : '-100%';
        const outDirection = forward ? '-100%' : '100%';

        $next.css({
            top: inDirection,
            zIndex: 2
        }).show();
        $next[0].play();

        $current.animate({ top: outDirection }, 600, function () {
            this.pause();
            this.currentTime = 0;
            $(this).css({ zIndex: 0 });
        });

        $next.animate({ top: '0%' }, 600, function () {
            $(this).css({ zIndex: 1 });
            current = index;
            setTimeout(() => {
                scrollLocked = false;
            }, 0);
        });
    }

    function nextVideo() {
        const next = (current + 1) % $videos.length;
        showVideo(next, true);
    }

    function prevVideo() {
        const prev = (current - 1 + $videos.length) % $videos.length;
        showVideo(prev, false);
    }

    $container.on('wheel', function (e) {
        e.preventDefault();
        if (scrollLocked) return;

        const deltaY = e.originalEvent.deltaY;

        // Minimal delta agar dianggap scroll valid (contoh: 50)
        if (Math.abs(deltaY) < 50) return;

        if (deltaY > 0) {
            nextVideo();
        } else {
            prevVideo();
        }
    });

    $container.on('touchstart', function (e) {
        touchStartY = e.originalEvent.touches[0].clientY;
    });

    $container.on('touchmove', function (e) {
        e.preventDefault();
    });

    $container.on('touchend', function (e) {
        if (scrollLocked) return;
        const touchEndY = e.originalEvent.changedTouches[0].clientY;
        const delta = touchStartY - touchEndY;
        if (delta > 50) {
            nextVideo();
        } else if (delta < -50) {
            prevVideo();
        }
    });
});

function formatNumber(num) {
    if (num >= 1_000_000) return (num / 1_000_000).toFixed(1).replace(/\.0$/, '') + 'M';
    if (num >= 1_000) return (num / 1_000).toFixed(1).replace(/\.0$/, '') + 'K';
    return num;
}

function roundToStep(value, step) {
    return Math.round(value / step) * step;
}

function animateCountUp(el, target, duration = 10000, step = 2000) {
    const start = performance.now();

    function update(currentTime) {
        const elapsed = currentTime - start;
        const progress = Math.min(elapsed / duration, 1); // ← jangan 5, harus max 1
        const eased = progress;
        let currentValue = eased * target;

        currentValue = roundToStep(currentValue, step);
        if (currentValue > target) currentValue = target;

        el.textContent = formatNumber(currentValue);

        if (progress < 1) {
            requestAnimationFrame(update);
        } else {
            el.textContent = formatNumber(target);
        }
    }

    requestAnimationFrame(update);
}

// Scroll detection & animate
function handleScrollTrigger() {
    const windowHeight = window.innerHeight;

    document.querySelectorAll('.count').forEach(el => {
        const target = parseInt(el.getAttribute('data-target'), 10);
        const step = parseInt(el.getAttribute('data-step'), 10) || 20000;
        const rect = el.getBoundingClientRect();

        // Section masuk viewport (bagian atas 60% layar)
        const inView = rect.top <= windowHeight * 2 && rect.bottom >= 0;

        if (inView && !el.dataset.animated) {
            el.dataset.animated = 'true';
            animateCountUp(el, target, 5000, step);
        } else if (!inView) {
            el.dataset.animated = '';
            el.textContent = '0'; // Reset kalau keluar viewport
        }
    });
}

window.addEventListener('scroll', handleScrollTrigger);
window.addEventListener('load', handleScrollTrigger);
window.addEventListener('resize', handleScrollTrigger);

$(document).ready(function () {
    let startX = 0;
    let startY = 0;
    let isDragging = false;

    $('.work__item').on('mousedown touchstart', function (e) {
        isDragging = true;
        startX = e.originalEvent.touches ? e.originalEvent.touches[0].clientX : e.clientX;
        startY = e.originalEvent.touches ? e.originalEvent.touches[0].clientY : e.clientY;
    });

    $('.work__item').on('mousemove touchmove', function (e) {
        if (!isDragging) return;

        const moveX = e.originalEvent.touches ? e.originalEvent.touches[0].clientX : e.clientX;
        const moveY = e.originalEvent.touches ? e.originalEvent.touches[0].clientY : e.clientY;

        const deltaX = Math.abs(moveX - startX);
        const deltaY = Math.abs(moveY - startY);

        // Hanya prevent scroll jika swipe horizontal lebih dominan
        if (deltaX > deltaY) {
            e.preventDefault();
        }
    });

    $('.work__item').on('mouseup touchend', function (e) {
        if (!isDragging) return;
        isDragging = false;

        const endX = e.originalEvent.changedTouches ? e.originalEvent.changedTouches[0].clientX : e.clientX;
        const deltaX = startX - endX;
        const $info = $(this).find('.item__info');

        if (deltaX > 50) {
            // Swipe left → show
            $info.css('transform', 'translateX(0)');
        } else if (deltaX < -50) {
            // Swipe right → hide
            $info.css('transform', 'translateX(100%)');
        }
    });

    // Reset
    $(document).on('mouseup touchend', function () {
        isDragging = false;
    });

    // Button toggle (desktop only)
    $('.btn-show').on('click', function () {
        const $item = $(this).closest('.work__item');
        const $info = $item.find('.item__info');
        const isVisible = $info.attr('data-visible') === 'true';

        if (isVisible) {
            $info.css('transform', 'translateX(100%)');
            $info.attr('data-visible', 'false');
        } else {
            $info.css('transform', 'translateX(0)');
            $info.attr('data-visible', 'true');
        }
    });
});

function slideCoversPerItem() {
    $('.work__item').each(function () {
        const container = $(this);
        const items = container.find('.cover__item');
        let index = 0;

        if (items.length <= 1) return;

        $(items[0]).css({
            display: 'block',
            opacity: 1,
            zIndex: 2,
            transform: 'scale(1)',
            filter: 'blur(0px)'
        });

        function showNext() {
            const current = $(items[index]);
            const nextIndex = (index + 1) % items.length;
            const next = $(items[nextIndex]);

            // Siapkan next image
            next.css({
                display: 'block',
                opacity: 0,
                zIndex: 3,
                transform: 'scale(1.2)',
                filter: 'blur(8px)'
            });

            // Fade out current (tanpa efek khusus)
            current.stop(true).animate({ opacity: 0 }, 600, 'swing', function () {
                $(this).css({
                    display: 'none',
                    zIndex: 1
                });
            });

            // Delay masuk + efek cair
            setTimeout(() => {
                next
                    .stop(true)
                    .animate(
                        { opacity: 1 },
                        {
                            duration: 600,
                            easing: 'swing',
                            step: function (now, fx) {
                                // Gunakan opacity progress (now: 0→1)
                                const progress = now;
                                const scale = 1.2 - (0.2 * progress);
                                const blur = 8 - (8 * progress);
                                $(this).css({
                                    transform: `scale(${scale})`,
                                    filter: `blur(${blur}px)`
                                });
                            },
                            complete: function () {
                                $(this).css({
                                    zIndex: 2
                                });
                            }
                        }
                    );
            }, 200);

            index = nextIndex;
            setTimeout(showNext, 3000);
        }

        setTimeout(showNext, 2000);
    });
}

$(document).ready(function () {
    slideCoversPerItem();
});