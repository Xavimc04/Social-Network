addEventListener('DOMContentLoaded', (event) => { 
    if(localStorage.getItem('theme') == null) {
        localStorage.setItem('theme', 'light'); 
    } 

    document.querySelector('body').setAttribute('data-theme', localStorage.getItem('theme')); 
})

const handleTheme = () => { 
    let value = document.querySelector('.theme-selector').value;
    
    if(value != '') {
        localStorage.setItem('theme', value); 
        document.querySelector('body').setAttribute('data-theme', localStorage.getItem('theme')); 
    }
}