showTimer();
initTimer();
function showTimer() 
{
  var time=new Date();
  var hour=time.getHours();
  var minute=time.getMinutes();
  var second=time.getSeconds();
  if(hour<10)   hour  ="0"+hour;
  if(minute<10) minute="0"+minute;
  var st=hour+":"+minute+":"+second;
  document.getElementById("timer").innerHTML=st; 
}
function initTimer() 
{
  setInterval(showTimer,1000);
}
