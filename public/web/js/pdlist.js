
  document.querySelectorAll(".sidebar-section").forEach(section => {
    const toggleBtn = section.querySelector(".toggle-btn");
    const closeBtn = section.querySelector(".close-btn");

    // Toggle open/close on click of the button
    toggleBtn.addEventListener("click", () => {
      section.classList.toggle("active");
      toggleBtn.innerHTML = section.classList.contains("active") ? "&#8722;" : "&#65291;";
    });
    // Close on clicking "Close"
    closeBtn.addEventListener("click", () => {
      section.classList.remove("active");
      toggleBtn.innerHTML = section.classList.contains("active") ? "&#8722;" : "&#65291;";
    });
  });
