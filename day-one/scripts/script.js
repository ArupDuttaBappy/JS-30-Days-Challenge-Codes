function play_sound(e){
  const audio=document.querySelector(`audio[data-key="${e.keyCode}"]`);
  const pressed_key=document.querySelector(`.key[data-key="${e.keyCode}"]`);
  pressed_key.classList.add("playing");//key animation
  if(!audio) return;
  // settimeout() works same as transitionend event
  //setTimeout(function(){ pressed_key.classList.remove("playing"); }, 70);
  audio.currentTime=0;//restarts audio on every keystroke immediately
  audio.play();
}

window.addEventListener("keydown",play_sound);

function remove_transition(e){
  this.classList.remove("playing");
}
const keys=document.querySelectorAll(".key");
keys.forEach(key => {
  key.addEventListener("transitionend",remove_transition);
});
