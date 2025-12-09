var main = document.querySelector("#main")
var cursor = document.querySelector("#cursor")

window.addEventListener("mousemove",function(dets){
    gsap.to(cursor,{
        x:dets.x,
        y:dets.y,
        duration:1,
        ease:"back.out(2)"
    })
})