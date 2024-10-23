
var swiper = new Swiper(".slide-content", {
    slidesPerView: 3,
    spaceBetween: 25,
    loop: true,
    centerSlide: 'true',
    fade: 'true',
    grabCursor: 'true',
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      dynamicBullets: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

    breakpoints:{
        0: {
            slidesPerView: 1,
        },
        520: {
            slidesPerView: 2,
        },
        950: {
            slidesPerView: 3,
        },
    },
  });




const menuBtn = document.querySelector(".menu-btn");
const navigation = document.querySelector(".navigation");

menuBtn.addEventListener("click", () => {
    menuBtn.classList.toggle("active");
    navigation.classList.toggle("active");
});

const btns = document.querySelectorAll(".nav-btn");
const slides = document.querySelectorAll(".video-slide");
const contents = document.querySelectorAll(".content");

var currentIndex = 0; 

var sliderNav = function(manual) {
    btns.forEach((btn) => {
        btn.classList.remove("active");
    });

    slides.forEach((slide) => {
        slide.classList.remove("active");
    });

    contents.forEach((content) => {
        content.classList.remove("active");
    });

    btns[manual].classList.add("active");
    slides[manual].classList.add("active");
    contents[manual].classList.add("active");

    currentIndex = manual; 
}

btns.forEach((btn, i) => {
    btn.addEventListener("click", () => {
        sliderNav(i);
    });
});

var autoSlide = function() {
    currentIndex++; 

    if (currentIndex >= slides.length) {
        currentIndex = 0;
    }

    sliderNav(currentIndex);
}

setInterval(autoSlide, 5000);



document.querySelectorAll('.faq-question').forEach(question => {
    question.addEventListener('click', () => {
        const faqItem = question.parentElement;
        faqItem.classList.toggle('active');
    });
});


//scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
  
      document.querySelector(this.getAttribute('href')).scrollIntoView({
        behavior: 'smooth'
      });
    });
  });
  


// rooms
const titleText = "الغرف والأجنحة";
const paragraphText ="نرحب بك في أجواء من الراحة والأناقة"
const titleElement = document.getElementById("animated-title");
const paragraphElement = document.getElementById("animated-contact");

function typeText(element, text, delay = 100) {
    text.split("").forEach((char, index) => {
        setTimeout(() => {
            element.textContent += char;
        }, delay * index);
    });
}

// Start the animations
document.addEventListener("DOMContentLoaded", () => {
    typeText(titleElement, titleText, 150); 
    setTimeout(() => {
        typeText(paragraphElement, paragraphText, 50); 
    }, titleText.length * 150); 
});
