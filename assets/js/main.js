var play_flag = false
$(document).ready(function () {
	$("#header-banner-pause").click(function() {
    if (!play_flag) {
      $("#header-video")[0].play()
      play_flag = !play_flag
    } else {
      $("#header-video")[0].pause()
      play_flag = !play_flag
    }
  }) 
})
var vid = document.getElementById("header-video");
vid.onended = function() {
  play_flag = false
};

