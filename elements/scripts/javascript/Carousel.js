/**
 * Created by brad on 1/29/18.
 */

function Carousel() {
    this.myIndex = 0;
    this.prevIndex = 0;
    this.firstRun = true;
    this.elements = document.getElementsByClassName('mySlides');
    this.interval = false;

    this.action = function() {
        if(this.firstRun) {
            $(this.elements[this.myIndex]).fadeIn(400);
            this.firstRun = false;
        } else {
            this.prevIndex = this.myIndex;
            this.myIndex++;
            if (this.myIndex >= this.elements.length) {
                this.myIndex = 0;
            }

            if(!this.firstRun) {
                this.fadeOutPrevElem(800, function() {
                    window.carousel.fadeInNextElem(400);
                });
            }
        }
    };

    this.fadeInNextElem = function(duration, fn){
        $(this.elements[this.myIndex]).fadeIn(duration, fn);
    };
    this.fadeOutPrevElem = function(duration, fn) {
        $(this.elements[this.prevIndex]).fadeOut(duration, fn);
    };



    this.action();
    this.interval = setInterval(function() {
        window.carousel.action();
    }, 5000);
}
$(document).ready(function() {
    if(typeof window.carousel.interval != "undefined") {
        clearInterval(window.carousel.interval);
    }
    window.carousel = new Carousel();
});