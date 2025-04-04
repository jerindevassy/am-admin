
document.querySelectorAll('.details-section').forEach(section => {
    section.addEventListener('click', () => {
        let content = section.nextElementSibling;
        let icon = section.querySelector('.toggle-icon');

        if (content.style.display === "block") {
            content.style.display = "none";
            icon.textContent = "＋"; // Show plus icon when closed
        } else {
            content.style.display = "block";
            icon.textContent = "−"; // Show minus icon when open
        }
    });
});
