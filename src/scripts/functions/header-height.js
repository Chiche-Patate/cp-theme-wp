export default function initHeaderHeight() {
    const header = document.querySelector('.nav');

    if (!header) return;

    const updateHeaderHeight = () => {
        document.documentElement.style.setProperty(
            '--header-height',
            `${header.offsetHeight}px`
        );
    };

    updateHeaderHeight();
    window.addEventListener('resize', updateHeaderHeight);
}