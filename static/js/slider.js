let slider = document.getElementById("sliderImages")
//Used for the caption
let sliderImages = document.getElementsByClassName("sliderImage")
let captions = document.getElementById("captions")
let currentX = 0


let currentSlide = 0
let maxSlide = sliderImages.length

// On récupère la taille de l'image au moment où on en a besoin
// plutôt qu'au chargement de la page
function getImageSize() {
    return sliderImages[0].clientWidth
}


function previousSlide() {
    currentSlide === 0 ? currentSlide = maxSlide - 1 :
        currentSlide--

    //Handdles the animation
    if (currentSlide === maxSlide - 1) {
        //We set up the position at the last image
        currentX = getImageSize() * (maxSlide - 1)
        slider.animate([
            { transform: "translateX(-" + currentX + "px)" }],
            { duration: 500, fill: "forwards" })
    }
    else {
        currentX -= imageSize
        slider.animate([
            { transform: "translateX(-" + currentX + "px)" }], { duration: 200, fill: "forwards" })

    }

    setUpCaptions()
}

function nextSlide() {
    currentSlide === (maxSlide - 1) ? currentSlide = 0 :
    currentSlide++

    //Handdles the animation
    if (currentSlide === 0) {
        currentX = 0
        slider.animate([
            { transform: "translateX(0)" }],
            { duration: 500, fill: "forwards" })
    }
    else {
        currentX += getImageSize()
        slider.animate([
            { transform: "translateX(-" + currentX + "px)" }], { duration: 200, fill: "forwards" })

    }

    setUpCaptions()

}

function setUpCaptions() {
    console.log("hello")
}