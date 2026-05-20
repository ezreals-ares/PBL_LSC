import './bootstrap';

import Alpine from 'alpinejs';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Swup from 'swup';
import SwupScriptsPlugin from '@swup/scripts-plugin';
import SwupScrollPlugin from '@swup/scroll-plugin';
import SplitType from 'split-type';

window.Alpine = Alpine;
Alpine.start();

gsap.registerPlugin(ScrollTrigger);

// ── Animation Functions ────────────────────────────────────────────────────

function initAnimations(container = document) {
    ScrollTrigger.getAll().forEach(t => t.kill());
    ScrollTrigger.refresh();

    // 1. Hero Animation & Text Reveal
    const heroSection = container.querySelector('#beranda');
    if (heroSection) {
        const badge = heroSection.querySelector('.inline-block');
        const headline = heroSection.querySelector('h1');
        const paragraph = heroSection.querySelector('p');
        const buttons = heroSection.querySelectorAll('a.neo-btn-primary, a.neo-btn-yellow');
        const heroImage = heroSection.querySelector('.order-1 img');

        if (badge) {
            gsap.fromTo(badge,
                { y: 30, opacity: 0 },
                { y: 0, opacity: 1, duration: 0.8, ease: "power3.out", delay: 0.2, clearProps: "transform,opacity" }
            );
        }
        if (headline) {
            const splitText = new SplitType(headline, { types: 'words, chars' });
            gsap.set(headline, { opacity: 1 }); // Ensure parent is visible since we set opacity: 0 inline
            gsap.fromTo(splitText.chars,
                { y: 50, opacity: 0 },
                { y: 0, opacity: 1, duration: 0.8, ease: "back.out(1.5)", stagger: 0.03, delay: 0.4, clearProps: "transform,opacity" }
            );
        }
        if (paragraph) {
            gsap.fromTo(paragraph,
                { y: 30, opacity: 0 },
                { y: 0, opacity: 1, duration: 1, ease: "power3.out", delay: 0.8, clearProps: "transform,opacity" }
            );
        }
        if (buttons.length) {
            gsap.fromTo(buttons,
                { scale: 0.9, opacity: 0 },
                { scale: 1, opacity: 1, duration: 0.8, ease: "back.out(1.7)", stagger: 0.15, delay: 1, clearProps: "transform,opacity" }
            );
        }
        if (heroImage) {
            gsap.fromTo(heroImage,
                { x: 50, opacity: 0 },
                { x: 0, opacity: 1, duration: 1.2, ease: "power3.out", delay: 0.6, clearProps: "transform,opacity" }
            );
        }

        // 1b. Hero Decorative Elements
        const decoElements = heroSection.querySelectorAll('.gsap-deco');
        if (decoElements.length) {
            gsap.fromTo(decoElements,
                { scale: 0, opacity: 0 },
                { scale: 1, opacity: 1, duration: 1.5, ease: "elastic.out(1, 0.5)", stagger: 0.15, delay: 0.8, clearProps: "all" }
            );
        }

        // 1c. Hero Stat Cards (already in viewport — no ScrollTrigger needed)
        const statCards = heroSection.querySelectorAll('.stat-card');
        if (statCards.length) {
            gsap.fromTo(statCards,
                { y: 30, opacity: 0 },
                { y: 0, opacity: 1, duration: 0.8, ease: "back.out(1.5)", stagger: 0.2, delay: 1.2, clearProps: "transform,opacity" }
            );
        }
    }

    // 2. Scroll Animations - Fade Up Elements
    const fadeUpElements = container.querySelectorAll('.gsap-fade-up');
    fadeUpElements.forEach((el) => {
        gsap.fromTo(el,
            { y: 60, opacity: 0 },
            {
                y: 0,
                opacity: 1,
                duration: 1,
                ease: "power3.out",
                clearProps: "transform,opacity",
                scrollTrigger: {
                    trigger: el,
                    start: "top 85%",
                    toggleActions: "play none none none"
                }
            }
        );
    });

    // 3. Scroll Animations - Stagger Containers
    const staggerContainers = container.querySelectorAll('.gsap-stagger-container');
    staggerContainers.forEach((containerNode) => {
        const items = containerNode.querySelectorAll('.gsap-stagger-item:not(.hidden)');
        if (items.length > 0) {
            gsap.fromTo(items,
                { y: 50, opacity: 0 },
                {
                    y: 0,
                    opacity: 1,
                    duration: 0.8,
                    stagger: 0.2,
                    ease: "power3.out",
                    clearProps: "transform,opacity",
                    scrollTrigger: {
                        trigger: containerNode,
                        start: "top 80%",
                    }
                }
            );
        }
    });
}

function initServicesReveal(container = document) {
    const btnShowMore = container.querySelector('#btn-show-more-services');
    if (!btnShowMore) return;

    // Clone to flush stale listeners
    const newBtn = btnShowMore.cloneNode(true);
    btnShowMore.parentNode.replaceChild(newBtn, btnShowMore);

    newBtn.addEventListener('click', () => {
        const hiddenServices = container.querySelectorAll('.hidden-service');
        if (hiddenServices.length === 0) return;

        hiddenServices.forEach(el => el.classList.remove('hidden'));

        const btnContainer = container.querySelector('#show-more-container');
        if (btnContainer) {
            gsap.to(btnContainer, { opacity: 0, height: 0, duration: 0.3, onComplete: () => btnContainer.remove() });
        }

        gsap.fromTo(hiddenServices,
            { y: 50, opacity: 0 },
            {
                y: 0,
                opacity: 1,
                duration: 0.8,
                stagger: 0.15,
                ease: "power3.out",
                clearProps: "all"
            }
        );

        if (window.ScrollTrigger) {
            setTimeout(() => ScrollTrigger.refresh(), 50);
        }
    });
}

// Auto-select service card on order page when coming from catalog (?service=ID)
function initOrderPreselect(container = document) {
    const params = new URLSearchParams(window.location.search);
    const serviceId = params.get('service');
    if (!serviceId) return;

    // rAF ensures DOM has fully painted before interaction
    requestAnimationFrame(() => requestAnimationFrame(() => {
        const card = container.querySelector(`.service-card[data-service-id="${serviceId}"]`);
        if (!card) return;

        if (window.selectedServicesMap && window.selectedServicesMap[serviceId]) return;

        if (typeof window.toggleService === 'function') {
            window.toggleService(card);
            card.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }));
}

// ── Page Entry Animation ───────────────────────────────────────────────────

function animatePageIn(container = document.body) {
    gsap.fromTo(container,
        { opacity: 0, y: 15 },
        { opacity: 1, y: 0, duration: 0.45, ease: "power2.out", clearProps: "all" }
    );
}

// ── Swup Initialization ────────────────────────────────────────────────────

const swup = new Swup({
    containers: ['#swup'],
    plugins: [
        new SwupScriptsPlugin({ head: false, body: true }),
        new SwupScrollPlugin({ doScrollingRightAway: false, animateScroll: false }),
    ],
    // Ignore hash-only anchor links — let browser handle smooth scroll
    ignoreVisit: (url, { el } = {}) => el?.matches('a[href^="#"]'),
});

// Smooth scroll for anchor links (both same-page and cross-page #hash)
document.addEventListener('click', (e) => {
    const link = e.target.closest('a[href^="#"]');
    if (!link) return;

    const hash = link.getAttribute('href');
    const target = document.querySelector(hash);
    if (!target) return;

    e.preventDefault();
    const navHeight = document.querySelector('header')?.offsetHeight ?? 80;
    const top = target.getBoundingClientRect().top + window.scrollY - navHeight - 8;
    window.scrollTo({ top, behavior: 'smooth' });

    // Close mobile menu if open
    const mobileMenu = document.getElementById('nav-mobile');
    if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
        mobileMenu.classList.add('hidden');
    }
});

// After cross-page navigation, scroll to hash if present in URL
swup.hooks.on('page:view', () => {
    const hash = window.location.hash;
    if (hash) {
        requestAnimationFrame(() => {
            const target = document.querySelector(hash);
            if (!target) return;
            const navHeight = document.querySelector('header')?.offsetHeight ?? 80;
            const top = target.getBoundingClientRect().top + window.scrollY - navHeight - 8;
            window.scrollTo({ top, behavior: 'smooth' });
        });
    }
});

// On page visit end (new page fully loaded & scripts executed)
swup.hooks.on('page:view', () => {
    window.scrollTo(0, 0);
    const container = document.querySelector('#swup') || document;
    animatePageIn(container);
    initAnimations(container);
    initServicesReveal(container);
    initOrderPreselect(container);
});

// ── Initial Page Load ──────────────────────────────────────────────────────

document.addEventListener('DOMContentLoaded', () => {
    initAnimations(document);
    initServicesReveal(document);
    initOrderPreselect(document);
});
