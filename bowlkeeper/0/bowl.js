  // Function to Keep Content Below Header
  function adjustContentMargin() {
    var header = document.getElementById("header");
    var content = document.getElementById("content");
    var headerHeight = header.offsetHeight;
    content.style.marginTop = headerHeight + "px";
  }

  // Adjust the margin on page load and when the window is resized
  window.onload = adjustContentMargin;
  window.onresize = adjustContentMargin;