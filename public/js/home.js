const addBtn = document.getElementById('add-product-btn');
const deleteBtn = document.getElementById('delete-product-btn');

addBtn.addEventListener('click', e =>{
    window.location.href = 'add-product';
});

deleteBtn.addEventListener('click', e => {
    const products = Array.from(document.getElementsByClassName('product-card'));
    const skusToDelete = products
    .filter(elem => {
        return elem.getElementsByClassName('delete-checkbox')[0].checked === true;
    })
    .map(elem => {
        return elem.getElementsByClassName('sku')[0].textContent.trim();
    });
    
    let postInfo = document.createElement('input');
    postInfo.type = 'hidden';
    postInfo.value = JSON.stringify(skusToDelete);
    postInfo.name = 'sku';

    let form = document.createElement('form');
    form.appendChild(postInfo);
    form.method = 'post';
    form.action = 'delete-product';
    console.log(form);

    document.body.appendChild(form);
    form.submit();
})