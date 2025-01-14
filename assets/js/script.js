const productContainer = document.querySelector('.product-container');

let isDown = false;
let startX;
let scrollLeft;

productContainer.addEventListener('mousedown', (e) => {
  isDown = true;
  productContainer.classList.add('active');
  startX = e.pageX - productContainer.offsetLeft;
  scrollLeft = productContainer.scrollLeft;
});

productContainer.addEventListener('mouseleave', () => {
  isDown = false;
  productContainer.classList.remove('active');
});

productContainer.addEventListener('mouseup', () => {
  isDown = false;
  productContainer.classList.remove('active');
});

productContainer.addEventListener('mousemove', (e) => {
  if (!isDown) return;
  e.preventDefault();
  const x = e.pageX - productContainer.offsetLeft;
  const walk = (x - startX) * 2; // Scroll speed
  productContainer.scrollLeft = scrollLeft - walk;
});
