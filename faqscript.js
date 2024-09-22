// script.js

document.addEventListener('DOMContentLoaded', () => {
    const accordionItems = document.querySelectorAll('.accordion-item');

    accordionItems.forEach(item => {
        const header = item.querySelector('.accordion-header');
        const content = item.querySelector('.accordion-content');
        const icon = header.querySelector('i');

        header.addEventListener('click', () => {
            const isVisible = content.classList.contains('show');

            // Hide all contents
            document.querySelectorAll('.accordion-content').forEach(ans => ans.classList.remove('show'));

            // Rotate icons
            document.querySelectorAll('.accordion-header i').forEach(ic => ic.classList.remove('fa-chevron-up'));
            document.querySelectorAll('.accordion-header i').forEach(ic => ic.classList.add('fa-chevron-down'));

            // Show the clicked content if it was not already visible
            if (!isVisible) {
                content.classList.add('show');
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            }
        });
    });
});
