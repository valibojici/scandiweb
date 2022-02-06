const cancelBtn = document.getElementById('cancel-btn');
const saveBtn = document.getElementById('save-btn');

cancelBtn.addEventListener('click', e=>{
    window.location.href = './';
});

saveBtn.addEventListener('click', e=>{
    let form = document.getElementById('product_form')
    let ok = form.reportValidity();
    if(ok){
        form.submit();
    }
});

const forms = Array.from(document.getElementsByClassName('product-type-form'));
const typeSwitcher = document.getElementById('productType');
forms.forEach(form => {
    let inputs = Array.from(form.getElementsByTagName('input'));

    if(typeSwitcher.value + '-form' === form.id){
        form.classList.remove('d-none');    
        inputs.forEach(input => input.setAttribute('required', ''))
    } else {
        inputs.forEach(input => input.removeAttribute('required'))
    }
});
typeSwitcher.addEventListener('change', e=>{
    forms.forEach(form => form.classList.add('d-none'));
    document.getElementById(e.target.value + '-form').classList.remove('d-none');
});