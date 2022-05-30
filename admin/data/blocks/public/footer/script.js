function smoothScroll(query) {
    const el = document.querySelector(query)
    const headerHeight = document.querySelector('header').getBoundingClientRect().height
    const gap = 0
    const top = el.getBoundingClientRect().top + window.scrollY
    const scrollTo = top - headerHeight - gap
    window.scroll({
        top: scrollTo ? scrollTo : 0,
        behavior: 'smooth'
    });
}

document.querySelectorAll('a[data-scroll-to]').forEach(el => {
    el.addEventListener('click', event => {
        event.preventDefault()

        let nav = document.querySelector('nav')
        nav.classList.remove('active')

        setTimeout(() => {
            const scrollTo = event.target.dataset.scrollTo
            smoothScroll(scrollTo)
        }, 0)
    })
})

document.querySelector('.menu-link').addEventListener('click', event => {
    event.preventDefault()
    let nav = document.querySelector('nav')
    nav.classList.toggle('active')
})

document.querySelectorAll('.event[data-link]').forEach(el => {
    el.addEventListener('click', event => {
        location.href = el.dataset.link
    })
})