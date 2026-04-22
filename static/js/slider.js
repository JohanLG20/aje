let slider = document.getElementById("sliderImages")
//Used for the caption
let sliderImages = document.getElementsByClassName("sliderImage")
let captionText = document.getElementById("captionText")
let currentX = 0


let currentSlide = 0
let maxSlide = sliderImages.length


function getImageSize() {
    return sliderImages[0].clientWidth
}


function previousSlide() {
    currentSlide === 0 ? currentSlide = maxSlide - 1 :
        currentSlide--

    //Handdles the animation
    if (currentSlide === maxSlide -1) {
        //We set up the position at the last image
        currentX = getImageSize() * (maxSlide - 1)
        slider.animate([
            { transform: "translateX(-" + currentX + "px)" }],
            { duration: 500, fill: "forwards" })
    }
    else {
        currentX -= getImageSize() 
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
    captionText.textContent = sliderImages[currentSlide].getAttribute("caption")
}