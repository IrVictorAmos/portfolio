// ============================================
// PERFORMANCE DETECTION
// ============================================

const isMobile = window.innerWidth <= 768;
const isLowEndDevice = navigator.deviceMemory && navigator.deviceMemory <= 4;
const shouldReduceAnimations = isMobile || isLowEndDevice || window.matchMedia('(prefers-reduced-motion: reduce)').matches;

// ============================================
// LOADER MANAGEMENT
// ============================================

function hideLoader() {
    const loaderContainer = document.getElementById('loaderContainer');
    if (loaderContainer) {
        loaderContainer.classList.add('hidden');
    }
}

// Hide loader when page is fully loaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(hideLoader, isMobile ? 1500 : 2500);
    });
} else {
    setTimeout(hideLoader, isMobile ? 1500 : 2500);
}

// Fallback: hide loader after max time
setTimeout(hideLoader, isMobile ? 2000 : 3500);

// Hide loader on user interaction (faster UX)
document.addEventListener('click', hideLoader, { once: true });
document.addEventListener('scroll', hideLoader, { once: true });
document.addEventListener('keydown', hideLoader, { once: true });

// ============================================
// THEME MANAGEMENT
// ============================================

const themeToggle = document.getElementById('themeToggle');
const htmlElement = document.documentElement;
const body = document.body;

const currentTheme = localStorage.getItem('theme') || 'dark-mode';
body.classList.add(currentTheme);
updateThemeIcon(currentTheme);

themeToggle.addEventListener('click', () => {
    const isDarkMode = body.classList.contains('dark-mode');
    
    if (isDarkMode) {
        body.classList.remove('dark-mode');
        body.classList.add('light-mode');
        localStorage.setItem('theme', 'light-mode');
        updateThemeIcon('light-mode');
    } else {
        body.classList.remove('light-mode');
        body.classList.add('dark-mode');
        localStorage.setItem('theme', 'dark-mode');
        updateThemeIcon('dark-mode');
    }
});

function updateThemeIcon(theme) {
    const icon = themeToggle.querySelector('i');
    if (theme === 'light-mode') {
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
    } else {
        icon.classList.remove('fa-sun');
        icon.classList.add('fa-moon');
    }
}

// ============================================
// LANGUAGE MANAGEMENT
// ============================================

const languageToggle = document.getElementById('languageToggle');
let currentLanguage = localStorage.getItem('language') || 'fr';

setLanguage(currentLanguage);

languageToggle.addEventListener('click', () => {
    currentLanguage = currentLanguage === 'fr' ? 'en' : 'fr';
    localStorage.setItem('language', currentLanguage);
    setLanguage(currentLanguage);
    updateLanguageToggle();
});

function setLanguage(lang) {
    const elements = document.querySelectorAll('[data-en][data-fr]');
    elements.forEach(element => {
        element.textContent = lang === 'en' ? element.getAttribute('data-en') : element.getAttribute('data-fr');
    });

    const placeholders = document.querySelectorAll('[data-en-placeholder][data-fr-placeholder]');
    placeholders.forEach(element => {
        element.placeholder = lang === 'en' ? element.getAttribute('data-en-placeholder') : element.getAttribute('data-fr-placeholder');
    });

    htmlElement.lang = lang;
}

function updateLanguageToggle() {
    languageToggle.textContent = currentLanguage === 'fr' ? 'EN' : 'FR';
}

updateLanguageToggle();

// ============================================
// NAVIGATION
// ============================================

const navbar = document.getElementById('navbar');
const navMenu = document.getElementById('navMenu');
const hamburger = document.getElementById('hamburger');
const navLinks = document.querySelectorAll('.nav-link');

hamburger.addEventListener('click', () => {
    navMenu.classList.toggle('active');
    hamburger.classList.toggle('active');
});

navLinks.forEach(link => {
    link.addEventListener('click', () => {
        navMenu.classList.remove('active');
        hamburger.classList.remove('active');
    });
});

// Navbar scroll effect - OPTIMIZED for mobile
let scrollTimeout;
window.addEventListener('scroll', () => {
    if (scrollTimeout) clearTimeout(scrollTimeout);
    scrollTimeout = setTimeout(() => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }, 100);
}, { passive: true });

// ============================================
// SCROLL ANIMATIONS WITH GSAP (MOBILE OPTIMIZED)
// ============================================

if (!isMobile && !shouldReduceAnimations && typeof gsap !== 'undefined') {
    gsap.registerPlugin(ScrollTrigger);

    // Animate skill cards on scroll
    const skillCards = document.querySelectorAll('.skill-card');
    skillCards.forEach((card, index) => {
        gsap.from(card, {
            scrollTrigger: {
                trigger: card,
                start: 'top 80%',
                end: 'top 20%',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            y: 30,
            duration: 0.6,
            delay: index * 0.05
        });
    });

    // Animate project cards on scroll
    const projectCards = document.querySelectorAll('.project-card');
    projectCards.forEach((card, index) => {
        gsap.from(card, {
            scrollTrigger: {
                trigger: card,
                start: 'top 80%',
                end: 'top 20%',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            y: 30,
            duration: 0.6,
            delay: index * 0.05
        });
    });

    // Animate about section
    const aboutContent = document.querySelector('.about-content');
    if (aboutContent) {
        gsap.from(aboutContent, {
            scrollTrigger: {
                trigger: aboutContent,
                start: 'top 80%',
                end: 'top 20%',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            y: 30,
            duration: 0.6
        });
    }

    // Animate stats
    const stats = document.querySelectorAll('.stat');
    stats.forEach((stat, index) => {
        gsap.from(stat, {
            scrollTrigger: {
                trigger: stat,
                start: 'top 80%',
                end: 'top 20%',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            scale: 0.9,
            duration: 0.5,
            delay: index * 0.05
        });
    });

    // Animate contact section
    const contactContent = document.querySelector('.contact-content');
    if (contactContent) {
        gsap.from(contactContent, {
            scrollTrigger: {
                trigger: contactContent,
                start: 'top 80%',
                end: 'top 20%',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            y: 30,
            duration: 0.6
        });
    }
}

// ============================================
// PARALLAX EFFECT (DISABLED ON MOBILE)
// ============================================

if (!isMobile && typeof gsap !== 'undefined') {
    const orbs = document.querySelectorAll('.gradient-orb');
    window.addEventListener('mousemove', (e) => {
        const x = e.clientX / window.innerWidth;
        const y = e.clientY / window.innerHeight;

        orbs.forEach((orb, index) => {
            const speed = (index + 1) * 15;
            gsap.to(orb, {
                x: x * speed,
                y: y * speed,
                duration: 0.8,
                overwrite: 'auto'
            });
        });
    }, { passive: true });
}

// ============================================
// FORM HANDLING
// ============================================

const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const submitButton = contactForm.querySelector('button[type="submit"]');
        const originalText = submitButton.textContent;
        
        // Disable button and show loading state
        submitButton.disabled = true;
        submitButton.textContent = currentLanguage === 'fr' ? 'Envoi en cours...' : 'Sending...';
        
        try {
            // Create FormData from the form
            const formData = new FormData(contactForm);
            
            // Send the form data to the PHP endpoint
            const response = await fetch('send-email.php', {
                method: 'POST',
                body: formData
            });
            
            const result = await response.json();
            
            if (result.success) {
                // Show success message
                submitButton.textContent = currentLanguage === 'fr' ? 'Message envoyé ✓' : 'Message sent ✓';
                submitButton.style.background = 'linear-gradient(135deg, #00B4D8 0%, #7B2CBF 100%)';
                
                // Reset form
                contactForm.reset();
                
                // Reset button after 3 seconds
                setTimeout(() => {
                    submitButton.textContent = originalText;
                    submitButton.style.background = '';
                    submitButton.disabled = false;
                }, 3000);
            } else {
                // Show error message
                submitButton.textContent = currentLanguage === 'fr' ? 'Erreur: ' + result.message : 'Error: ' + result.message;
                submitButton.style.background = '#dc3545';
                
                // Reset button after 3 seconds
                setTimeout(() => {
                    submitButton.textContent = originalText;
                    submitButton.style.background = '';
                    submitButton.disabled = false;
                }, 3000);
            }
        } catch (error) {
            console.error('Error:', error);
            submitButton.textContent = currentLanguage === 'fr' ? 'Erreur d\'envoi' : 'Send error';
            submitButton.style.background = '#dc3545';
            
            // Reset button after 3 seconds
            setTimeout(() => {
                submitButton.textContent = originalText;
                submitButton.style.background = '';
                submitButton.disabled = false;
            }, 3000);
        }
    });
}

// ============================================
// SMOOTH SCROLL BEHAVIOR
// ============================================

document.querySelectorAll('a[href^="#"]:not(.project-link)').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        // Skip if href is just "#" or empty
        if (href === '#' || href === '') {
            return;
        }
        e.preventDefault();
        const target = document.querySelector(href);
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// ============================================
// COUNTER ANIMATION (OPTIMIZED)
// ============================================

function animateCounter(element, target, duration = 1500) {
    let current = 0;
    const increment = target / (duration / 16);
    
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current);
        }
    }, 16);
}

const statNumbers = document.querySelectorAll('.stat-number');
let countersAnimated = false;

const observerOptions = {
    threshold: 0.5
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting && !countersAnimated) {
            countersAnimated = true;
            statNumbers.forEach(number => {
                const target = parseInt(number.textContent);
                animateCounter(number, target, isMobile ? 1000 : 1500);
            });
        }
    });
}, observerOptions);

const statsSection = document.querySelector('.about-stats');
if (statsSection) {
    observer.observe(statsSection);
}

// ============================================
// ACTIVE NAV LINK
// ============================================

window.addEventListener('scroll', () => {
    let current = '';
    const sections = document.querySelectorAll('section');
    
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if (pageYOffset >= sectionTop - 200) {
            current = section.getAttribute('id');
        }
    });

    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href').slice(1) === current) {
            link.classList.add('active');
        }
    });
}, { passive: true });

// ============================================
// KEYBOARD SHORTCUTS
// ============================================

document.addEventListener('keydown', (e) => {
    if (e.altKey && e.key === 't') {
        themeToggle.click();
    }
    if (e.altKey && e.key === 'l') {
        languageToggle.click();
    }
});

// ============================================
// MOBILE MENU CLOSE ON OUTSIDE CLICK
// ============================================

document.addEventListener('click', (e) => {
    if (!e.target.closest('.nav-container')) {
        navMenu.classList.remove('active');
        hamburger.classList.remove('active');
    }
});

// ============================================
// PREVENT BODY SCROLL WHEN MENU IS OPEN
// ============================================

hamburger.addEventListener('click', () => {
    if (navMenu.classList.contains('active')) {
        document.body.classList.add('no-scroll');
    } else {
        document.body.classList.remove('no-scroll');
    }
});

// ============================================
// VISIT COUNTER SYSTEM
// ============================================

async function initializeVisitCounter() {
    try {
        const response = await fetch('track-visit.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            document.getElementById('todayVisits').textContent = data.today_visits;
            document.getElementById('monthVisits').textContent = data.month_visits;
            document.getElementById('totalVisits').textContent = data.total_visits;
        } else {
            initializeVisitCounterFallback();
        }
    } catch (error) {
        console.error('Error tracking visit:', error);
        initializeVisitCounterFallback();
    }
}

function initializeVisitCounterFallback() {
    const today = new Date().toDateString();
    const visitData = JSON.parse(localStorage.getItem('visitData')) || {
        lastDate: today,
        todayVisits: 0,
        monthVisits: 0,
        totalVisits: 0,
        lastMonth: new Date().getMonth()
    };

    if (visitData.lastDate !== today) {
        visitData.todayVisits = 0;
        visitData.lastDate = today;
    }

    const currentMonth = new Date().getMonth();
    if (visitData.lastMonth !== currentMonth) {
        visitData.monthVisits = 0;
        visitData.lastMonth = currentMonth;
    }

    visitData.todayVisits++;
    visitData.monthVisits++;
    visitData.totalVisits++;

    localStorage.setItem('visitData', JSON.stringify(visitData));

    document.getElementById('todayVisits').textContent = visitData.todayVisits;
    document.getElementById('monthVisits').textContent = visitData.monthVisits;
    document.getElementById('totalVisits').textContent = visitData.totalVisits;
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeVisitCounter);
} else {
    initializeVisitCounter();
}

// ============================================
// MODAL MANAGEMENT
// ============================================

const projectModal = document.getElementById('projectModal');
const moreProjectsModal = document.getElementById('moreProjectsModal');
const modalClose = document.getElementById('modalClose');
const modalCloseBtn = document.getElementById('modalCloseBtn');
const moreProjectsClose = document.getElementById('moreProjectsClose');
const moreProjectsCloseBtn = document.getElementById('moreProjectsCloseBtn');

// Project links - open demo modal
const projectLinks = document.querySelectorAll('.project-link');
projectLinks.forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        projectModal.classList.add('active');
        document.body.classList.add('no-scroll');
    });
});

// More projects button
const moreProjectsBtn = document.getElementById('moreProjectsBtn');
if (moreProjectsBtn) {
    moreProjectsBtn.addEventListener('click', (e) => {
        e.preventDefault();
        moreProjectsModal.classList.add('active');
        document.body.classList.add('no-scroll');
    });
}

// Close project modal
function closeProjectModal() {
    projectModal.classList.remove('active');
    document.body.classList.remove('no-scroll');
}

modalClose.addEventListener('click', closeProjectModal);
modalCloseBtn.addEventListener('click', closeProjectModal);

// Close more projects modal
function closeMoreProjectsModal() {
    moreProjectsModal.classList.remove('active');
    document.body.classList.remove('no-scroll');
}

moreProjectsClose.addEventListener('click', closeMoreProjectsModal);
moreProjectsCloseBtn.addEventListener('click', closeMoreProjectsModal);

// Close modal when clicking outside
window.addEventListener('click', (e) => {
    if (e.target === projectModal) {
        closeProjectModal();
    }
    if (e.target === moreProjectsModal) {
        closeMoreProjectsModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeProjectModal();
        closeMoreProjectsModal();
    }
});

// ============================================
// CONSOLE MESSAGE
// ============================================

console.log('%c🚀 Welcome to Victor Amos Portfolio!', 'font-size: 20px; color: #00B4D8; font-weight: bold;');
console.log('%cDesigned with ❤️ using modern web technologies', 'font-size: 14px; color: #7B2CBF;');
