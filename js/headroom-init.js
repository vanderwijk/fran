

var myElement = document.querySelector("#top");
var headroom = new Headroom(myElement, {
  "offset": 205,
  "tolerance": 5
});
headroom.init();