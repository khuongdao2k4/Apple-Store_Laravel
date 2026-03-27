
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
