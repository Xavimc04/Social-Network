addEventListener('DOMContentLoaded', (event) => { 
    if(localStorage.getItem('theme') == null) {
        localStorage.setItem('theme', 'light'); 
    }
    document.querySelector('body').setAttribute('data-theme', localStorage.getItem('theme')); 
})

const handleTheme = () => { 
    if(localStorage.getItem('theme') == 'light') {
        localStorage.setItem('theme', 'dark'); 
    } else {
        localStorage.setItem('theme', 'light'); 
    }
    document.querySelector('body').setAttribute('data-theme', localStorage.getItem('theme')); 
}