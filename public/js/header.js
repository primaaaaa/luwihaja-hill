document.addEventListener('DOMContentLoaded', function() {
  const userMenuBtn = document.getElementById('userMenuBtn');
  const userDropdown = document.getElementById('userDropdown');
  
  if (userMenuBtn && userDropdown) {
    userMenuBtn.addEventListener('click', function(e) {
      e.stopPropagation();
      userDropdown.classList.toggle('show');
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
      if (!userDropdown.contains(e.target) && !userMenuBtn.contains(e.target)) {
        userDropdown.classList.remove('show');
      }
    });
  }
});