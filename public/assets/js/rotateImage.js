document.addEventListener("DOMContentLoaded",(function(){!function(){const e=document.querySelector("#banner__image-circle");e.style.translate="none",e.style.rotate="none",e.style.scale="none";let t=0;setInterval((()=>{e.style.transform=`translate3d(0px, 0px, 0px) rotate(${t}deg)`,t+=.8,t>=360&&(t=0)}),50)}()}));