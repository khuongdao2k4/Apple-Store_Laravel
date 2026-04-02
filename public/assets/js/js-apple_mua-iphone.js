
function showContainer(containerId, element) {
    let containers = document.querySelectorAll('.container');
    containers.forEach(container => {
        container.classList.remove('active');
    });
    document.getElementById(containerId).classList.add('active');

    let navItems = document.querySelectorAll('.nav-item-content');
    navItems.forEach(item => {
        item.classList.remove('active');
    });
    element.classList.add('active');
}

// Modal Slider and Color Selection Logic
let currentImageIndex = 0;

// Example images for slider (usually handled dynamically but we restore the expected logic)
function getImagesForTab(tabId) {
    // In a real app, these would come from an array. 
    // Here we handle the specific ones visible in the user's layout.
    return [
        "https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone16promax-digitalmat-gallery-1-202409_GEO_US?wid=728&hei=666&fmt=p-jpg&qlt=95&.v=1723843667344",
        "https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-card-40-iphone16prohero-202409?wid=680&hei=528&fmt=p-jpg&qlt=95&.v=1725567335931",
        "https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-card-40-iphone16hero-202409?wid=680&hei=528&fmt=p-jpg&qlt=95&.v=1723234230295"
    ];
}

function changeImage(n) {
    const activePane = document.querySelector('.tab-pane.show.active');
    if (!activePane) return;

    const img = activePane.querySelector('.product-image');
    const dots = activePane.querySelectorAll('.dot');
    const imgs = getImagesForTab(activePane.id);

    currentImageIndex += n;
    if (currentImageIndex >= imgs.length) currentImageIndex = 0;
    if (currentImageIndex < 0) currentImageIndex = imgs.length - 1;

    img.src = imgs[currentImageIndex];
    
    // Update dots
    dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentImageIndex);
    });
}

function setImage(index) {
    const activePane = document.querySelector('.tab-pane.show.active');
    if (!activePane) return;

    const img = activePane.querySelector('.product-image');
    const dots = activePane.querySelectorAll('.dot');
    const imgs = getImagesForTab(activePane.id);

    currentImageIndex = index;
    img.src = imgs[currentImageIndex];

    dots.forEach((dot, idx) => {
        dot.classList.toggle('active', idx === index);
    });
}

function setColor(index) {
    const activePane = document.querySelector('.tab-pane.show.active');
    if (!activePane) return;

    const options = activePane.querySelectorAll('.color-option');
    options.forEach((opt, idx) => {
        opt.classList.toggle('active', idx === index);
    });
    
    // Usually swaps image to a specific color variant
    setImage(index % 3); 
}

// Admin Logic
function confirmDelete(id) {
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')) {
        window.location.href = 'delete-product?id=' + id;
    }
}
