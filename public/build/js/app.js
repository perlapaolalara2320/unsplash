const hamburger=document.querySelector("#hamburger"),
contentList=document.querySelector(".action-user-contentList"),
modal=document.querySelector(".modal");
hamburger&&hamburger.addEventListener("click",(function(){contentList.classList.toggle("hide")}));