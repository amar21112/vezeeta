@php
    $isLoggedIn = false;
@endphp
<!-- Enhanced Navbar with gradient background and shadow -->
<nav class="bg-[#0073d1] text-white shadow-lg relative">
    <!-- Enhanced Top notification bar -->
    <div class="bg-[#0070cd] text-center py-2 text-xs relative overflow-hidden">
        <div class="pulse">
            <span class="opacity-90 font-medium">
                <i class="fas fa-phone-alt mr-2 text-green-300"></i>
                احجز استشارتك الطبية الآن | Book your medical consultation now
                <i class="fas fa-calendar-check ml-2 text-blue-300"></i>
            </span>
        </div>
        <!-- Close button for notification bar -->
        <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-white/70 hover:text-white text-xs"
            onclick="this.parentElement.style.display='none'">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="container mx-auto px-6 py-4">
        <div class="flex items-center justify-between">

            <!-- Enhanced Logo with glow effect -->
            <a href="/" class="flex items-center group">
                <div class="relative">
                    <h2 class="text-3xl font-bold tracking-wide transition-all duration-300 group-hover:scale-105">
                        Vezeeta<span class="text-red-400 font-normal drop-shadow-sm">.com</span>
                    </h2>
                    <!-- Subtle glow effect on hover -->
                    <div
                        class="absolute inset-0 text-3xl font-bold tracking-wide opacity-0 group-hover:opacity-30 transition-opacity duration-300 blur-sm">
                        Vezeeta<span class="text-red-400 font-normal">.com</span>
                    </div>
                </div>
            </a>

            <!-- Enhanced Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-1">
                <!-- User Profile with avatar -->
                <div class="flex items-center space-x-6 px-4">
                    <!-- User greeting with profile icon -->
                    <div
                        class="flex items-center space-x-2 bg-white/10 px-3 py-2 rounded-full backdrop-blur-sm <?php if (!$isLoggedIn) {
                            echo 'hidden';
                        } ?>">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-sm"></i>
                        </div>
                        <span class="text-sm font-medium">محمد مصطفى</span>
                    </div>

                    <!-- Enhanced Sign Up Button -->
                    @unless (in_array(Route::currentRouteName(), ['user.login', 'user.register', 'user.forgot-password']))
                        <a href="auth/register"
                            class="<?php if ($isLoggedIn) {
                                echo 'hidden';
                            } ?> text-sm font-medium hover:text-blue-200 transition-colors duration-300 px-3 py-2 rounded-md hover:bg-white/10">
                            <i class="fas fa-user-plus mr-2"></i>Sign Up
                        </a>

                        <!-- Enhanced Navigation Links -->
                        <a href="auth/login"
                            class="<?php if ($isLoggedIn) {
                                echo 'hidden';
                            } ?> text-sm font-medium hover:text-blue-200 transition-colors duration-300 px-3 py-2 rounded-md hover:bg-white/10">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                    @endunless
                    <a href="/doctors"
                        class="text-sm font-medium hover:text-blue-200 transition-colors duration-300 px-3 py-2 rounded-md hover:bg-white/10">
                        <i class="fas fa-stethoscope mr-2"></i>Vezeeta For Doctors
                    </a>

                    <a href="https://wa.me/201005323460" target="_blank" rel="noopener"
                        class="text-sm font-medium hover:text-blue-200 transition-colors duration-300 px-3 py-2 rounded-md hover:bg-white/10">
                        <i class="fas fa-phone mr-2"></i>Contact Us
                    </a>

                    <!-- Enhanced Language Selector with dropdown -->
                    <div class="relative group">
                        <a href="#"
                            class="flex items-center text-sm font-medium hover:text-blue-200 transition-colors duration-300 px-3 py-2 rounded-md hover:bg-white/10">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/f/fe/Flag_of_Egypt.svg"
                                class="w-5 h-3 mr-2 rounded-sm shadow-sm" alt="Egypt Flag">
                            <span>عربي</span>
                            <i
                                class="fas fa-chevron-down ml-2 text-xs group-hover:rotate-180 transition-transform duration-300"></i>
                        </a>
                        <!-- Dropdown menu (hidden by default) -->
                        <div
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <a href="#"
                                class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 text-sm">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/f/fe/Flag_of_Egypt.svg"
                                    class="w-5 h-3 mr-3 rounded-sm">
                                العربية
                            </a>
                            <a href="#"
                                class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 text-sm">
                                <img src="https://upload.wikimedia.org/wikipedia/en/a/ae/Flag_of_the_United_Kingdom.svg"
                                    class="w-5 h-3 mr-3 rounded-sm">
                                English
                            </a>
                        </div>
                    </div>

                    <!-- Enhanced Country Selector -->
                    <div class="relative group">
                        <a href="#"
                            class="flex items-center text-sm font-medium hover:text-blue-200 transition-colors duration-300 px-3 py-2 rounded-md hover:bg-white/10">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/f/fe/Flag_of_Egypt.svg"
                                class="w-5 h-3 mr-2 rounded-sm shadow-sm" alt="Egypt Flag">
                            <span>Egypt</span>
                            <i
                                class="fas fa-chevron-down ml-2 text-xs group-hover:rotate-180 transition-transform duration-300"></i>
                        </a>
                        <!-- Country dropdown -->
                        <div
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <a href="#"
                                class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 text-sm">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/f/fe/Flag_of_Egypt.svg"
                                    class="w-5 h-3 mr-3 rounded-sm">
                                Egypt
                            </a>
                            <a href="#"
                                class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 text-sm">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/c/cb/Flag_of_the_United_Arab_Emirates.svg"
                                    class="w-5 h-3 mr-3 rounded-sm">
                                UAE
                            </a>
                            <a href="#"
                                class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 text-sm">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/0/0d/Flag_of_Saudi_Arabia.svg"
                                    class="w-5 h-3 mr-3 rounded-sm">
                                Saudi Arabia
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Mobile Menu Button -->
            <button
                class="lg:hidden flex items-center justify-center w-10 h-10 rounded-lg bg-white/10 backdrop-blur-sm hover:bg-white/20 transition-all duration-300"
                id="mobile-menu-btn">
                <div class="relative w-6 h-6 flex items-center justify-center">
                    <!-- Hamburger Lines -->
                    <div class="hamburger-icon">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                    <!-- X Mark (hidden by default) -->
                    <div class="x-icon opacity-0 absolute transition-all duration-300 ease-in-out">
                        <i class="fas fa-times text-white text-lg"></i>
                    </div>
                </div>
            </button>
        </div>

        <!-- Enhanced Mobile Navigation Menu -->
        <div class="lg:hidden overflow-hidden transition-all duration-500 ease-in-out max-h-0 bg-gradient-to-b from-[#005bb5] to-[#0073d1]"
            id="mobile-menu">
            <div class="pt-6 pb-4">
                <!-- Mobile User Profile -->
                <div class="<?php if (!$isLoggedIn) {
                    echo 'hidden';
                } ?> flex items-center space-x-3 px-6 pb-4 border-b border-white/20">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <span class="text-white font-medium">محمد مصطفى</span>
                </div>

                <!-- Mobile Navigation Links -->
                <div class="flex flex-col space-y-1 px-6 pt-4">
                    @unless (in_array(Route::currentRouteName(), ['user.login', 'user.register', 'user.forgot-password']))
                        <a href="auth/register"
                            class="<?php if ($isLoggedIn) {
                                echo 'hidden';
                            } ?> flex items-center text-white py-3 px-4 rounded-lg hover:bg-white/10 transition-all duration-300 transform hover:translate-x-2">
                            <i class="fas fa-user-plus mr-3 w-5"></i>
                            <span>Sign Up</span>
                        </a>
                        <a href="auth/login"
                            class="<?php if ($isLoggedIn) {
                                echo 'hidden';
                            } ?> flex items-center text-white py-3 px-4 rounded-lg hover:bg-white/10 transition-all duration-300 transform hover:translate-x-2">
                            <i class="fas fa-sign-in-alt mr-3 w-5"></i>
                            <span>Login</span>
                        </a>
                    @endunless
                    <a href="/doctors"
                        class="flex items-center text-white py-3 px-4 rounded-lg hover:bg-white/10 transition-all duration-300 transform hover:translate-x-2">
                        <i class="fas fa-stethoscope mr-3 w-5"></i>
                        <span>Vezeeta For Doctors</span>
                    </a>
                    <a href="https://wa.me/201005323460" target="_blank" rel="noopener"
                        class="flex items-center text-white py-3 px-4 rounded-lg hover:bg-white/10 transition-all duration-300 transform hover:translate-x-2">
                        <i class="fas fa-phone mr-3 w-5"></i>
                        <span>Contact Us</span>
                    </a>

                    <!-- Mobile Language/Country Selectors -->
                    <div class="pt-3 border-t border-white/20 mt-3">
                        <div class="mb-2">
                            <h6 class="text-white/70 text-xs font-semibold px-4 pb-2">Language & Region</h6>
                        </div>

                        <!-- Language Selector -->
                        <div class="mb-2">
                            <button
                                class="w-full flex items-center justify-between text-white py-3 px-4 rounded-lg hover:bg-white/10 transition-all duration-300"
                                onclick="toggleMobileDropdown('mobile-lang-dropdown')">
                                <div class="flex items-center">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/f/fe/Flag_of_Egypt.svg"
                                        class="w-5 h-3 mr-3 rounded-sm" alt="Egypt Flag">
                                    <span>عربي</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-300"
                                    id="mobile-lang-chevron"></i>
                            </button>
                            <div class="hidden bg-white/10 rounded-lg mx-4 mt-1 overflow-hidden"
                                id="mobile-lang-dropdown">
                                <a href="#"
                                    class="flex items-center text-white py-2 px-4 hover:bg-white/10 transition-all duration-300">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/f/fe/Flag_of_Egypt.svg"
                                        class="w-4 h-2.5 mr-3 rounded-sm">
                                    العربية
                                </a>
                                <a href="#"
                                    class="flex items-center text-white py-2 px-4 hover:bg-white/10 transition-all duration-300">
                                    <img src="https://upload.wikimedia.org/wikipedia/en/a/ae/Flag_of_the_United_Kingdom.svg"
                                        class="w-4 h-2.5 mr-3 rounded-sm">
                                    English
                                </a>
                            </div>
                        </div>

                        <!-- Country Selector -->
                        <div class="mb-2">
                            <button
                                class="w-full flex items-center justify-between text-white py-3 px-4 rounded-lg hover:bg-white/10 transition-all duration-300"
                                onclick="toggleMobileDropdown('mobile-country-dropdown')">
                                <div class="flex items-center">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/f/fe/Flag_of_Egypt.svg"
                                        class="w-5 h-3 mr-3 rounded-sm" alt="Egypt Flag">
                                    <span>Egypt</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-300"
                                    id="mobile-country-chevron"></i>
                            </button>
                            <div class="hidden bg-white/10 rounded-lg mx-4 mt-1 overflow-hidden"
                                id="mobile-country-dropdown">
                                <a href="#"
                                    class="flex items-center text-white py-2 px-4 hover:bg-white/10 transition-all duration-300">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/f/fe/Flag_of_Egypt.svg"
                                        class="w-4 h-2.5 mr-3 rounded-sm">
                                    Egypt
                                </a>
                                <a href="#"
                                    class="flex items-center text-white py-2 px-4 hover:bg-white/10 transition-all duration-300">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/c/cb/Flag_of_the_United_Arab_Emirates.svg"
                                        class="w-4 h-2.5 mr-3 rounded-sm">
                                    UAE
                                </a>
                                <a href="#"
                                    class="flex items-center text-white py-2 px-4 hover:bg-white/10 transition-all duration-300">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/0d/Flag_of_Saudi_Arabia.svg"
                                        class="w-4 h-2.5 mr-3 rounded-sm">
                                    Saudi Arabia
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Enhanced Mobile Menu Toggle Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = mobileMenuBtn.querySelector('.hamburger-icon');
        const xIcon = mobileMenuBtn.querySelector('.x-icon');
        let isMenuOpen = false;

        mobileMenuBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            isMenuOpen = !isMenuOpen;
            console.log('Mobile menu toggled:', isMenuOpen);

            if (isMenuOpen) {
                // Open menu animation
                mobileMenu.style.maxHeight = '800px'; // Set a large fixed height
                mobileMenu.classList.add('menu-open');

                // Hide hamburger and show X with smooth transition
                if (hamburgerIcon) {
                    hamburgerIcon.style.opacity = '0';
                    hamburgerIcon.style.transform = 'rotate(90deg) scale(0.8)';
                }

                setTimeout(() => {
                    if (xIcon) {
                        xIcon.style.opacity = '1';
                        xIcon.style.transform = 'rotate(0deg) scale(1)';
                    }
                }, 150);

            } else {
                // Close menu animation
                mobileMenu.style.maxHeight = '0px';
                mobileMenu.classList.remove('menu-open');

                // Hide X and show hamburger with smooth transition
                if (xIcon) {
                    xIcon.style.opacity = '0';
                    xIcon.style.transform = 'rotate(-90deg) scale(0.8)';
                }

                setTimeout(() => {
                    if (hamburgerIcon) {
                        hamburgerIcon.style.opacity = '1';
                        hamburgerIcon.style.transform = 'rotate(0deg) scale(1)';
                    }
                }, 150);
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!mobileMenuBtn.contains(event.target) && !mobileMenu.contains(event.target) &&
                isMenuOpen) {
                isMenuOpen = false;
                mobileMenu.style.maxHeight = '0px';
                mobileMenu.classList.remove('menu-open');

                // Close all mobile dropdowns
                document.querySelectorAll('[id$="-dropdown"]').forEach(dd => {
                    dd.classList.add('hidden');
                    const chevron = document.getElementById(dd.id.replace('-dropdown',
                        '-chevron'));
                    if (chevron) {
                        chevron.style.transform = 'rotate(0deg)';
                    }
                });

                // Reset to hamburger icon
                if (xIcon) {
                    xIcon.style.opacity = '0';
                    xIcon.style.transform = 'rotate(-90deg) scale(0.8)';
                }

                setTimeout(() => {
                    if (hamburgerIcon) {
                        hamburgerIcon.style.opacity = '1';
                        hamburgerIcon.style.transform = 'rotate(0deg) scale(1)';
                    }
                }, 150);
            }
        });

        // Add smooth scroll behavior for anchor links (only for valid anchors)
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');

                // Only prevent default and scroll if it's a valid anchor (not just "#")
                if (href !== '#' && href.length > 1) {
                    e.preventDefault();
                    try {
                        const target = document.querySelector(href);
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    } catch (error) {
                        console.warn('Invalid selector:', href);
                    }
                }
                // For href="#", let the default behavior handle it (do nothing)
            });
        });

        // Add loading animation on page load
        window.addEventListener('load', function() {
            document.body.classList.add('loaded');
        });
    });

    // Mobile dropdown toggle function
    function toggleMobileDropdown(dropdownId) {
        const dropdown = document.getElementById(dropdownId);
        const chevron = document.getElementById(dropdownId.replace('-dropdown', '-chevron'));

        if (dropdown && chevron) {
            const isHidden = dropdown.classList.contains('hidden');

            // Close all other mobile dropdowns first
            document.querySelectorAll('[id$="-dropdown"]').forEach(dd => {
                if (dd.id !== dropdownId) {
                    dd.classList.add('hidden');
                    const otherChevron = document.getElementById(dd.id.replace('-dropdown', '-chevron'));
                    if (otherChevron) {
                        otherChevron.style.transform = 'rotate(0deg)';
                    }
                }
            });

            // Toggle current dropdown
            if (isHidden) {
                dropdown.classList.remove('hidden');
                chevron.style.transform = 'rotate(180deg)';
            } else {
                dropdown.classList.add('hidden');
                chevron.style.transform = 'rotate(0deg)';
            }
        }
    }
</script>

<!-- Additional CSS for enhanced animations -->
<style>
    /* Smooth transitions for all elements */
    * {
        transition: all 0.3s ease;
    }

    /* Page load animation */
    body {
        opacity: 0;
        animation: fadeIn 0.5s ease-in-out forwards;
    }

    @keyframes fadeIn {
        to {
            opacity: 1;
        }
    }

    /* Enhanced hover effects */
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    /* Gradient text animation */
    .gradient-text {
        background: linear-gradient(45deg, #0073d1, #00a8ff, #0073d1);
        background-size: 200% 200%;
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradientShift 3s ease infinite;
    }

    @keyframes gradientShift {

        0%,
        100% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }
    }

    /* Pulse animation for notification bar */
    .pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }
    }

    /* Smooth mobile menu height transition */
    #mobile-menu {
        transition: max-height 0.5s ease-in-out;
        will-change: max-height;
    }

    /* Ensure mobile menu is visible when opened */
    #mobile-menu.menu-open {
        max-height: 800px !important;
    }

    /* Mobile dropdown styling */
    .mobile-dropdown {
        transition: all 0.3s ease;
    }

    /* Debug - temporary red border to see mobile menu */
    #mobile-menu {
        border: 2px solid transparent;
    }

    #mobile-menu.debug {
        border-color: red;
    }

    /* Enhanced backdrop blur for better glass effect */
    .backdrop-blur-sm {
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
    }

    /* Mobile menu button animation styles */
    .hamburger-icon {
        transition: all 0.3s ease-in-out;
    }

    .x-icon {
        transition: all 0.3s ease-in-out;
        transform: rotate(-90deg) scale(0.8);
    }

    #mobile-menu-btn:hover {
        transform: scale(1.05);
    }

    #mobile-menu-btn:active {
        transform: scale(0.95);
    }

    /* Hamburger line positioning and animation */
    #line1,
    #line2,
    #line3 {
        left: 50%;
        transform-origin: center;
        margin-left: -10px;
        /* Half of width (w-5 = 20px) */
    }

    /* Enhanced mobile menu button styling */
    #mobile-menu-btn {
        position: relative;
        overflow: hidden;
    }

    #mobile-menu-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        transform: scale(0);
        transition: transform 0.3s ease;
    }

    #mobile-menu-btn:hover::before {
        transform: scale(1);
    }
</style>
