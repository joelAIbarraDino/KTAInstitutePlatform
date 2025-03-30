(function(){
    
    document.addEventListener('DOMContentLoaded', function(){
        app();
    });


    function app(){
        const img = document.querySelector('#banner__image-circle');

        img.style.translate = 'none';
        img.style.rotate = 'none';
        img.style.scale = 'none';

        let grade = 0;
        
        setInterval(() => {
            img.style.transform = `translate3d(0px, 0px, 0px) rotate(${grade}deg)`;
            grade +=0.8;
            if(grade >= 360)
                grade = 0;
        }, 50);
    }
})();
