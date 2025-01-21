
// Popup Login Toggle
document.addEventListener("DOMContentLoaded", () => {
  const popup = document.getElementById("popup");
  const btnLogin = document.querySelector(".btnlogin");
  const btnClose = document.querySelector(".icon-close");

  btnLogin.addEventListener("click", () => {
    popup.classList.toggle("hidden");
  });

  btnClose.addEventListener("click", () => {
    popup.classList.add("hidden");
  });

  const form = document.querySelector('.form-box.login form');
  form.addEventListener('submit', (event) => {
    event.preventDefault(); 

    const formData = new FormData(form);
    fetch('index.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(data => {
      if (data.includes('Email ou mot de passe incorrect')) {
        document.querySelector('.error').textContent = 'Email ou mot de passe incorrect.';
      } else {
        window.location.href = 'index.php'; 
      }
    })
    .catch(error => console.error('Erreur:', error));
  });
});


// Carousel Navigation
document.addEventListener('DOMContentLoaded', () => {
  const prevButton = document.querySelector('.slider-prev');
  const nextButton = document.querySelector('.slider-next');
  const slider = document.querySelector('.slider');

  prevButton.addEventListener('click', () => {
    slider.scrollBy({
      left: -slider.clientWidth,
      behavior: 'smooth'
    });
  });

  nextButton.addEventListener('click', () => {
    slider.scrollBy({
      left: slider.clientWidth,
      behavior: 'smooth'
    });
  });
});


document.addEventListener('DOMContentLoaded', function() {
  const slider = document.querySelector('.carousel'); 
  const prevButton = document.querySelector('.carousel-prev');
  const nextButton = document.querySelector('.carousel-next');
  
  prevButton.addEventListener('click', () => {
    slider.scrollBy({
      left: -slider.clientWidth,
      behavior: 'smooth'
    });
  });

  nextButton.addEventListener('click', () => {
    slider.scrollBy({
      left: slider.clientWidth,
      behavior: 'smooth'
    });
  });
});
