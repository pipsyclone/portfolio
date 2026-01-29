// Landing Page JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all functions
    initHeaderScroll();
    initMobileMenu();
    initSmoothScroll();
    initScrollAnimations();
    initProjectFilter();
});

/**
 * Header scroll effect - adds shadow on scroll
 */
function initHeaderScroll() {
    const header = document.getElementById('header');
    
    if (!header) return;
    
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
}

/**
 * Mobile menu toggle functionality
 */
function initMobileMenu() {
    const menuToggle = document.getElementById('menu-toggle');
    const mobileNav = document.getElementById('mobile-nav');
    
    if (!menuToggle || !mobileNav) return;
    
    let isOpen = false;
    
    menuToggle.addEventListener('click', () => {
        isOpen = !isOpen;
        
        // Toggle mobile nav visibility
        if (isOpen) {
            mobileNav.classList.remove('mobile-nav-closed');
            mobileNav.classList.add('mobile-nav-open');
        } else {
            mobileNav.classList.remove('mobile-nav-open');
            mobileNav.classList.add('mobile-nav-closed');
        }
        
        // Animate hamburger icon to X
        menuToggle.classList.toggle('menu-open', isOpen);
    });
    
    // Close menu when clicking on mobile nav links
    mobileNav.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            isOpen = false;
            mobileNav.classList.remove('mobile-nav-open');
            mobileNav.classList.add('mobile-nav-closed');
            menuToggle.classList.remove('menu-open');
        });
    });
    
    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
        if (isOpen && !menuToggle.contains(e.target) && !mobileNav.contains(e.target)) {
            isOpen = false;
            mobileNav.classList.remove('mobile-nav-open');
            mobileNav.classList.add('mobile-nav-closed');
            menuToggle.classList.remove('menu-open');
        }
    });
}

/**
 * Smooth scroll for anchor links
 */
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const target = document.querySelector(targetId);
            
            if (target) {
                // Calculate offset for fixed header
                const headerHeight = document.getElementById('header')?.offsetHeight || 80;
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

/**
 * Intersection Observer for scroll animations
 */
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-up');
                entry.target.style.opacity = '1';
            }
        });
    }, observerOptions);

    // Observe all elements with animate-on-scroll class
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        el.style.opacity = '0';
        observer.observe(el);
    });
}

/**
 * Project filter functionality
 */
function initProjectFilter() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const projectCards = document.querySelectorAll('.project-card');
    
    if (!filterButtons.length || !projectCards.length) return;
    
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Update active button
            filterButtons.forEach(btn => {
                btn.classList.remove('bg-primary', 'text-white');
                btn.classList.add('text-slate-500', 'hover:text-primary');
            });
            button.classList.add('bg-primary', 'text-white');
            button.classList.remove('text-slate-500', 'hover:text-primary');
            
            // Filter projects
            const filter = button.dataset.filter;
            
            projectCards.forEach(card => {
                const categories = card.dataset.category ? card.dataset.category.split(' ') : [];
                
                if (filter === 'all' || categories.includes(filter)) {
                    card.style.display = 'block';
                    card.classList.add('animate-fade-up');
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
}

/**
 * Form validation (optional enhancement)
 */
function validateContactForm(form) {
    const name = form.querySelector('#name');
    const email = form.querySelector('#email');
    const message = form.querySelector('#message');
    
    let isValid = true;
    
    if (!name.value.trim()) {
        showError(name, 'Name is required');
        isValid = false;
    }
    
    if (!email.value.trim() || !isValidEmail(email.value)) {
        showError(email, 'Valid email is required');
        isValid = false;
    }
    
    if (!message.value.trim()) {
        showError(message, 'Message is required');
        isValid = false;
    }
    
    return isValid;
}

function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function showError(input, message) {
    input.classList.add('border-red-500');
    const error = document.createElement('p');
    error.className = 'text-red-500 text-sm mt-1';
    error.textContent = message;
    input.parentNode.appendChild(error);
}

/**
 * Typing effect for hero section (optional)
 */
function initTypingEffect(element, texts, speed = 100) {
    if (!element) return;
    
    let textIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    
    function type() {
        const currentText = texts[textIndex];
        
        if (isDeleting) {
            element.textContent = currentText.substring(0, charIndex - 1);
            charIndex--;
        } else {
            element.textContent = currentText.substring(0, charIndex + 1);
            charIndex++;
        }
        
        if (!isDeleting && charIndex === currentText.length) {
            setTimeout(() => isDeleting = true, 1500);
        } else if (isDeleting && charIndex === 0) {
            isDeleting = false;
            textIndex = (textIndex + 1) % texts.length;
        }
        
        const timeout = isDeleting ? speed / 2 : speed;
        setTimeout(type, timeout);
    }
    
    type();
}
