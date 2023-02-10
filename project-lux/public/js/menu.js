const navSlide = () => {
  const burger = document.querySelector(".burger");
  const nav = document.querySelector(".nav-links");
  const navLinks = document.querySelectorAll(".nav-links a");

  burger.addEventListener("click", () => {
    nav.classList.toggle("nav-active");

    navLinks.forEach((link, index) => {
      link.addEventListener("click", () => {
        nav.classList.remove("nav-active");
        burger.classList.remove("toggle");
        link.style.animation = "";
      });
      link.style.animation = `navLinkFade 0.5s ease forwards ${
        index / 7 + 0.5
      }s `;
    });
    burger.classList.toggle("toggle");
  });
  //
};

navSlide();
