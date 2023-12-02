(function () { //IIFE
    getPhoto();
    let photos = [];
    // let search = [];
    let login = null
    let userId = null
    const addphoto = document.querySelector('.btn');
    const addphotoM = document.querySelector('.btn-movil');
    const inputSearch = document.querySelector('.search');
    inputSearch.addEventListener('input',searchPhoto)
    addphoto.addEventListener('click', () => {
        showModal();

    })

    addphotoM.addEventListener('click', () => {
        showModal();

    })

    async function searchPhoto(e){
        try {
            const url = `${location.origin}/api/photos/search?label=${e.target.value}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            photos = resultado.search;
            showPhotos()
        } catch (error) {
            console.error(error);
        }
    }

    async function getPhoto() {
        try {
            const url = `${location.origin}/api/photos`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            photos = resultado.photo;
            login = resultado.login;
            userId = resultado.userId;

            showPhotos();

        } catch (error) {
            console.error(error)
        }
    }



    function showModal() {
        const modal = document.createElement('DIV');
        const actionUser = document.querySelector('.action-user-contentList')
        modal.classList.add('modal');
        actionUser.classList.add('hide')
        modal.innerHTML = `
        <form class="form newPhoto">
            <legen>Add a new photo</legen>
            <div class="row">
                <label>Label</label>
                <input type="text" name="label" id="label" placeholder="label"/>
            </div>

            <div class="row">
                <label>Photo URL</label>
                <input type="text" name="url" id="url" placeholder="url"/>
            </div>

            <div class="form-option">
                <span class="cancel">Cancel</span>
                <input class="btn" type="submit" value="Submit"/>
            </div>
        </form>
        `;

        setTimeout(() => {
            const form = document.querySelector('.form');
            form.classList.add('animated')
        }, 0);

        modal.addEventListener('click', function (e) {
            e.preventDefault();

            if (e.target.classList.contains('cancel')) {
                const form = document.querySelector('.form');
                form.classList.add('close')

                setTimeout(() => {
                    modal.remove();
                }, 500);
            }

            if (e.target.classList.contains('btn')) {
                const label = document.querySelector('#label').value.trim();
                const url = document.querySelector('#url').value.trim();


                if (label === '' || url === '') {
                    showAlert('Label or url are required', 'error', document.querySelector('.form'));
                    return;
                }
                addPhoto(label, url);
            }
        })
        document.querySelector('.content').appendChild(modal)

    }

    function showAlert(message, type, ref) {
        const preAlert = document.querySelector('.alerta');
        if (preAlert) {
            preAlert.remove()
        }
        const alert = document.createElement('DIV')
        alert.classList.add('alerta', type);
        alert.textContent = message;
        ref.parentElement.insertAdjacentElement("afterbegin", alert);

        setTimeout(() => {
            alert.remove()
        }, 1000)
    }

    async function addPhoto(label, url) {
        const data = new FormData();
        data.append('label', label);
        data.append('url', url);

        try {
            const url = `${location.origin}/api/photo`
            const respuesta = await fetch(url, {
                method: 'POST',
                body: data
            });
            const resultado = await respuesta.json();
            showAlert(resultado.message, resultado.type, document.querySelector('.form'));

            if (resultado.type === 'success') {
                const modal = document.querySelector('.modal');
                setTimeout(() => {
                    modal.remove();
                }, 2000);
            }

            const photoObj = {
                id: String(resultado.id),
                label: label,
                url: resultado.url,
                userId: resultado.userId

            }

            // VIRTUALDOM
            photos = [...photos, photoObj];
            showPhotos();
        } catch (error) {
            console.error(error);
        }


    }
    function showPhotos() {
        cleanPhotos();
        const grid = document.querySelector('.content-grid-photos');
        const row1 = document.createElement('DIV')
        const row2 = document.createElement('DIV')
        const row3 = document.createElement('DIV')
        row1.classList.add('grid-row');
        row2.classList.add('grid-row');
        row3.classList.add('grid-row');
        
        photos.forEach((photo, i) => {
            const img = document.createElement('IMG');
            const label = document.createElement('span')
            const deletePhoto = document.createElement('div');
            const figure = document.createElement('figure')

            
            img.dataset.photoId = photo.id;
            img.src = photo.url;
            img.alt = photo.label;
            label.innerText = photo.label;
            figure.append(img, label, deletePhoto)        
            
            if (login && userId === photo.userId) {
                deletePhoto.classList.add('deleteImg')
                deletePhoto.onclick = function () {
                    modalDelete(photo.id)
                }
                deletePhoto.textContent = 'delete'
            }


            if(window.screen.width <= 414){
                row1.append(figure);
                grid.append(row1)
            }
            else if(window.screen.width > 414 && window.screen.width <= 912){
                if(i % 2 === 0){
                    row1.append(figure);
            
                }else{
                    row2.append(figure);
    
                }
                grid.append(row1,row2)

            }
            else if(window.screen.width >= 912){
                if(i % 3 === 0){
                    row1.append(figure);
                    
                }else if(i % 3 === 1){
                    row2.append(figure);
    
                }else{
                    row3.append(figure);
                }
                grid.append(row1,row2,row3)

            }

        });
    }

   function modalDelete(id) {
        const modal = document.createElement('DIV');
        const actionUser = document.querySelector('.action-user-contentList')
        modal.classList.add('modal');
        actionUser.classList.add('hide')
        modal.innerHTML = `
        <form class="form deletePhoto">
            <legen>Are you sure?</legen>
            <div class="row">
                <label>Password</label>
                <input type="password" name="password" id="password" placeholder="password"/>
                <input type="hidden" name="photo" id="photo"/>
            </div>

            <div class="form-option">
                <span class="cancel">Cancel</span>
                <input class="btn" type="submit" value="Delete"/>
            </div>
        </form>
        `;

        setTimeout(() => {
            const form = document.querySelector('.form');
            form.classList.add('animated')
        }, 0);

        modal.addEventListener('click', function (e) {
            e.preventDefault();

            if (e.target.classList.contains('cancel')) {
                const form = document.querySelector('.form');
                form.classList.add('close')

                setTimeout(() => {
                    modal.remove();
                }, 500);
            }

            if (e.target.classList.contains('btn')) {
                const password = document.querySelector('#password').value.trim();


                if (password === '') {
                    showAlert('Password is required', 'error', document.querySelector('.form'));
                    return;
                }

                deletePhoto(id, password);

            }
        })
        document.querySelector('.content').appendChild(modal)


    }

    async function deletePhoto(id, password) {
        const data = new FormData();
        data.append('id', id)
        data.append('password', password);

        try {
            const url = `${location.origin}/api/photo/delete`;
            const respuesta = await fetch(url, {
                method: 'POST',
                body: data
            });
            const resultado = await respuesta.json();

            if (resultado.resultado) {
                showAlert(resultado.message, resultado.type, document.querySelector('.form'))
                getPhoto();
                if (resultado.type === 'success') {
                    const modal = document.querySelector('.modal');
                    setTimeout(() => {
                        modal.remove();
                    }, 2000);
                }
            }

        } catch (error) {
            console.error(error);
        }

    }
    function cleanPhotos() {
        const grid = document.querySelector('.content-grid-photos');

        while (grid.firstChild) {
            grid.removeChild(grid.firstChild)
        }
    }

})();
