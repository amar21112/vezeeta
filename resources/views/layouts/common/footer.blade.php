<footer class="footer bg-gradient-to-br from-[#0070cd] via-[#1e40af] to-[#1e3a8a] !text-white py-16 relative overflow-hidden">
  <!-- Wave effect at top -->
  <div class="footer-wave"></div>

  <!-- Background decorative elements -->
  <div class="absolute inset-0 overflow-hidden pointer-events-none">
    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/5 rounded-full floating-animation"></div>
    <div class="absolute top-1/2 -left-20 w-60 h-60 bg-blue-400/10 rounded-full floating-animation" style="animation-delay: 1s;"></div>
    <div class="absolute bottom-10 right-1/4 w-32 h-32 bg-white/5 rounded-full floating-animation" style="animation-delay: 2s;"></div>
  </div>

  <div class="container mx-auto px-6 relative z-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

      <!-- Enhanced Vezeeta Section -->
      <div class="footer-section space-y-6 fade-in-up stagger-1 pl-4">
        <div class="flex items-center space-x-2 mb-6">
          <a href="/" class="relative">
            <h3 class="text-3xl font-bold tracking-wide">Vezeeta</h3>
            <span class="text-red-400 text-2xl font-light">.com</span>
            <div class="absolute -bottom-2 left-0 w-16 h-1 bg-gradient-to-r from-blue-400 to-transparent rounded-full"></div>
          </a>
        </div>
        <p class="text-blue-100 text-sm leading-relaxed mb-4">
          Your trusted healthcare partner, connecting you with the best medical professionals across the region.
        </p>
        <ul class="space-y-3 text-sm">
          <li><a href="#" class="flex items-center space-x-2 group">
              <i class="fas fa-info-circle text-blue-300 group-hover:text-white transition-colors"></i>
              <span>About Us</span>
            </a></li>
          <li><a href="#" class="flex items-center space-x-2 group">
              <i class="fas fa-users text-blue-300 group-hover:text-white transition-colors"></i>
              <span>Our Team</span>
            </a></li>
          <li><a href="#" class="flex items-center space-x-2 group">
              <i class="fas fa-briefcase text-blue-300 group-hover:text-white transition-colors"></i>
              <span>Careers</span>
            </a></li>
          <li><a href="#" class="flex items-center space-x-2 group">
              <i class="fas fa-newspaper text-blue-300 group-hover:text-white transition-colors"></i>
              <span>Press</span>
            </a></li>
        </ul>
      </div>

      <!-- Enhanced Search By Section -->
      <div class="footer-section space-y-6 fade-in-up stagger-2 pl-4">
        <div class="relative mb-6">
          <h4 class="text-xl font-semibold text-white">Search By</h4>
          <div class="absolute -bottom-2 left-0 w-12 h-1 bg-gradient-to-r from-blue-400 to-transparent rounded-full"></div>
        </div>
        <ul class="space-y-3 text-sm">
          <li><a href="#" class="flex items-center space-x-2 group">
              <i class="fas fa-stethoscope text-blue-300 group-hover:text-white transition-colors"></i>
              <span>Speciality</span>
            </a></li>
          <li><a href="#" class="flex items-center space-x-2 group">
              <i class="fas fa-map-marker-alt text-blue-300 group-hover:text-white transition-colors"></i>
              <span>Area</span>
            </a></li>
          <li><a href="#" class="flex items-center space-x-2 group">
              <i class="fas fa-shield-alt text-blue-300 group-hover:text-white transition-colors"></i>
              <span>Insurance</span>
            </a></li>
          <li><a href="#" class="flex items-center space-x-2 group">
              <i class="fas fa-hospital text-blue-300 group-hover:text-white transition-colors"></i>
              <span>Hospital</span>
            </a></li>
          <li><a href="#" class="flex items-center space-x-2 group">
              <i class="fas fa-building text-blue-300 group-hover:text-white transition-colors"></i>
              <span>Center</span>
            </a></li>
        </ul>
      </div>

      <!-- Enhanced Doctor Section -->
      <div class="footer-section space-y-6 fade-in-up stagger-3 pl-4">
        <div class="relative mb-6">
          <h4 class="text-xl font-semibold text-white">Are You A Doctor?</h4>
          <div class="absolute -bottom-2 left-0 w-12 h-1 bg-gradient-to-r from-blue-400 to-transparent rounded-full"></div>
        </div>
        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20">
          <p class="text-blue-100 text-sm mb-4">
            Join thousands of healthcare professionals on our platform
          </p>
          <a href="{{ route('doctor.register') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 px-4 py-2 rounded-lg transition-all duration-300 group">
            <i class="fas fa-user-md text-white group-hover:scale-110 transition-transform"></i>
            <span class="text-white font-medium">Join Vezeeta Doctors</span>
            <i class="fas fa-arrow-right text-white group-hover:translate-x-1 transition-transform"></i>
          </a>
        </div>
        <div class="text-center">
          <div class="text-2xl font-bold text-blue-200">10,000+</div>
          <div class="text-xs text-blue-300">Trusted Doctors</div>
        </div>
      </div>

      <!-- Need Help & App Downloads Section -->
      <div class="space-y-6">
        <div class="space-y-4">
          <h4 class="text-lg font-semibold">Need Help?</h4>
          <ul class="space-y-3 text-sm">
            <li><a href="#" class="hover:underline">Medical Library</a></li>
            <li><a href="#" class="hover:underline">Contact Us</a></li>
            <li><a href="#" class="hover:underline">Terms Of Use</a></li>
            <li><a href="#" class="hover:underline">Privacy Policy</a></li>
            <li><a href="#" class="hover:underline">Doctors Privacy Policy</a></li>
          </ul>
        </div>

        <!-- App Download Buttons -->
        <div class="space-y-3">
          <a href="#" class="block">
            <img src="https://play.google.com/intl/en_us/badges/static/images/badges/en_badge_web_generic.png"
              alt="Get it on Google Play"
              class="h-12 w-auto">
          </a>
          <a href="#" class="block">
            <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
              alt="Download on the App Store"
              class="h-12 w-auto bg-black rounded-md">
          </a>
        </div>

        <!-- Social Media Icons -->
        <div class="flex space-x-4 mt-6">
          <a href="#" class="text-white hover:text-blue-200 transition-colors">
            <i class="fab fa-facebook-f text-xl"></i>
          </a>
          <a href="#" class="text-white hover:text-blue-200 transition-colors">
            <i class="fab fa-instagram text-xl"></i>
          </a>
          <a href="#" class="text-white hover:text-blue-200 transition-colors">
            <i class="fab fa-twitter text-xl"></i>
          </a>
        </div>
      </div>

    </div>

    <!-- Enhanced Bottom Section -->
    <div class="border-t border-white/20 mt-12 pt-8">
      <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">

        <!-- Copyright -->
        <div class="flex items-center space-x-4">
          <p class="text-blue-200 text-sm">
            © 2025 Vezeeta.com. All rights reserved.
          </p>
          <div class="hidden md:flex items-center space-x-4 text-xs text-blue-300">
            <span>•</span>
            <span>Made with ❤️ in Egypt</span>
            <span>•</span>
            <span>Trusted by millions</span>
          </div>
        </div>

        <!-- Additional Links -->
        <div class="flex items-center space-x-6 text-sm">
          <a href="#" class="text-blue-200 hover:text-white transition-colors">Sitemap</a>
          <a href="#" class="text-blue-200 hover:text-white transition-colors">Support</a>
          <div class="flex items-center space-x-2 text-blue-200">
            <i class="fas fa-globe text-sm"></i>
            <select class="bg-transparent border border-white/30 rounded px-2 py-1 text-sm focus:outline-none focus:border-white/50">
              <option value="en" class="bg-blue-800">English</option>
              <option value="ar" class="bg-blue-800">العربية</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Trust Indicators -->
      <div class="mt-8 pt-6 border-t border-white/10">
        <div class="flex flex-wrap justify-center items-center space-x-8 space-y-2">
          <div class="flex items-center space-x-2 text-blue-200 text-xs">
            <i class="fas fa-shield-alt text-green-400"></i>
            <span>SSL Secured</span>
          </div>
          <div class="flex items-center space-x-2 text-blue-200 text-xs">
            <i class="fas fa-user-check text-green-400"></i>
            <span>Verified Doctors</span>
          </div>
          <div class="flex items-center space-x-2 text-blue-200 text-xs">
            <i class="fas fa-clock text-green-400"></i>
            <span>24/7 Support</span>
          </div>
          <div class="flex items-center space-x-2 text-blue-200 text-xs">
            <i class="fas fa-mobile-alt text-green-400"></i>
            <span>Mobile Friendly</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- Enhanced Footer Interactions -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Animate footer sections on scroll
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.animationPlayState = 'running';
        }
      });
    }, observerOptions);

    // Observe all footer sections
    document.querySelectorAll('.fade-in-up').forEach(section => {
      observer.observe(section);
    });

    // Add floating effect to decorative elements
    const floatingElements = document.querySelectorAll('.floating-animation');
    floatingElements.forEach((element, index) => {
      element.style.animationDelay = `${index * 0.5}s`;
    });

    // Enhanced social media hover effects
    document.querySelectorAll('.social-icon').forEach(icon => {
      icon.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-3px) scale(1.1) rotate(5deg)';
      });

      icon.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0px) scale(1) rotate(0deg)';
      });
    });

    // Smooth scroll for footer links
    document.querySelectorAll('footer a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });

    // Add ripple effect to buttons
    document.querySelectorAll('footer .app-badge, footer .social-icon').forEach(button => {
      button.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;

        ripple.style.cssText = `
          position: absolute;
          width: ${size}px;
          height: ${size}px;
          left: ${x}px;
          top: ${y}px;
          background: rgba(255, 255, 255, 0.3);
          border-radius: 50%;
          transform: scale(0);
          animation: ripple 0.6s linear;
          pointer-events: none;
        `;

        this.style.position = 'relative';
        this.style.overflow = 'hidden';
        this.appendChild(ripple);

        setTimeout(() => ripple.remove(), 600);
      });
    });

    // Add CSS for ripple animation
    const style = document.createElement('style');
    style.textContent = `
      @keyframes ripple {
        to {
          transform: scale(4);
          opacity: 0;
        }
      }
    `;
    document.head.appendChild(style);
  });
</script>

</body>

</html>