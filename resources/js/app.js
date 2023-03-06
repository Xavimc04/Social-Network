import './bootstrap'; 

const Channel = Echo.channel('elqueeeE?'); 

Channel.subscribed(() => {
    console.log('Subscribed!'); 
}).listen('.')