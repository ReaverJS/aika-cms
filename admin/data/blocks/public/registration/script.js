document.addEventListener("DOMContentLoaded", async () => {

    document.querySelector('.registration form').addEventListener('submit', async event => {
        event.preventDefault()

        const btn = document.querySelector('.registration form [type="submit"]')
        btn.value = "Отправить 🕒"
        btn.classList.add('disabled')

        const formData = new FormData(document.querySelector('.registration form'))
        let urlParams = []
        for (let pair of formData.entries()) {
            if (pair[0] === 'map-place') pair[0] = 'place'
            urlParams.push(pair[0] + '=' + pair[1])
        }
        urlParams.push('secret=perkele707kekw')
        urlParams.push('action=add')
        urlParams.push('hash=123')
        urlParams = '?' + urlParams.join('&')

        let url = 'https://script.google.com/macros/s/AKfycbyk-0WnEQNur7_D7N2ZiFSbj55Fpe18wUatic0tSiOn75IVDeQsvuiCY76gLrecaleRgA/exec' + urlParams
        let req = await fetch(url)
        let res = await req.json()

        btn.value = "Отправить 🚀"
        btn.classList.remove('disabled')

        document.querySelector('.registration form').remove()
        document.querySelector('.registration h2').innerHTML = 'Спасибо за регистрацию!'

        console.log(res)
    })

    document.querySelector('.registration-modal .close-btn').addEventListener('click', event => {
        event.preventDefault()
        document.querySelector('.registration-modal-layout').classList.remove('active')
    })

    const map = document.querySelector('#map-place')

    if (map) {
        let busyPoints = []
        const busyReq = fetch('https://script.google.com/macros/s/AKfycbyk-0WnEQNur7_D7N2ZiFSbj55Fpe18wUatic0tSiOn75IVDeQsvuiCY76gLrecaleRgA/exec?secret=perkele707kekw&action=getPlaces&hash=123')
            .then(req => req.json())
            .then(json => {
                if (json.result) {
                    busyPoints = json.result
                }
                busyLoaded = true
                return busyPoints
            })


        map.addEventListener('click', async event => {
            const citySelect = document.querySelector('#city')
            const city = citySelect.options[citySelect.selectedIndex].value

            let response
            if (city === 'Алматы') {
                response = await fetch('/admin/data/blocks/public/registration/Almaty-24-09-22.svg')
            } else {
                response = await fetch('/admin/data/blocks/public/registration/Nur-sultan-02-09-22.svg')
            }

            let svg = await response.text()
            document.querySelector('.registration-modal .svg-wrapper').innerHTML = svg

            await busyReq
            if (busyPoints[city]) {
                busyPoints[city].forEach(point => {
                    document.querySelectorAll('.registration-modal .map-place').forEach(el => {
                        let place = el.id.replace('map-place-', '')
                        if (point === place) {
                            el.classList.add('busy')
                            console.log(point)
                        }
                    })
                })
            }

            event.preventDefault()
            document.querySelector('#map-place').blur()
            document.querySelector('.registration-modal-layout').classList.add('active')


            document.querySelectorAll('.registration-modal .map-place').forEach(el => {
                el.addEventListener('click', onPlaceClick)
            })
        })
    }



    function onPlaceClick(event) {
        event.preventDefault()
        const place = event.currentTarget.id.replace('map-place-', '')

        document.querySelector('#map-place').value = place
        document.querySelector('.registration-modal-layout').classList.remove('active')
    }

})