!function(){a();let e=[],t=null,n=null;const o=document.querySelector(".btn"),
c=document.querySelector(".btn-movil");async function a(){try{const o=location.origin+"/api/photos",c=await fetch(o),a=await c.json();e=a.photo,t=a.login,n=a.userId,l()}catch(e){console.error(e)}}function r(){const t=document.createElement("DIV"),n=document.querySelector(".action-user-contentList");t.classList.add("modal"),n.classList.add("hide"),t.innerHTML='\n        <form class="form newPhoto">\n            <legen>Add a new photo</legen>\n            <div class="row">\n                <label>Label</label>\n                <input type="text" name="label" id="label" placeholder="label"/>\n            </div>\n\n            <div class="row">\n                <label>Photo URL</label>\n                <input type="text" name="url" id="url" placeholder="url"/>\n            </div>\n\n            <div class="form-option">\n                <span class="cancel">Cancel</span>\n                <input class="btn" type="submit" value="Submit"/>\n            </div>\n        </form>\n        ',setTimeout(()=>{document.querySelector(".form").classList.add("animated")},0),t.addEventListener("click",(function(n){if(n.preventDefault(),n.target.classList.contains("cancel")){document.querySelector(".form").classList.add("close"),setTimeout(()=>{t.remove()},500)}if(n.target.classList.contains("btn")){const t=document.querySelector("#label").value.trim(),n=document.querySelector("#url").value.trim();if(""===t||""===n)return void s("Label or url are required","error",document.querySelector(".form"));!async function(t,n){const o=new FormData;o.append("label",t),o.append("url",n);try{const n=location.origin+"/api/photo",c=await fetch(n,{method:"POST",body:o}),a=await c.json();if(s(a.message,a.type,document.querySelector(".form")),"success"===a.type){const e=document.querySelector(".modal");setTimeout(()=>{e.remove()},2e3)}const r={id:String(a.id),label:t,url:a.url,userId:a.userId};e=[...e,r],l()}catch(e){console.error(e)}}(t,n)}})),document.querySelector(".content").appendChild(t)}function s(e,t,n){const o=document.querySelector(".alerta");o&&o.remove();const c=document.createElement("DIV");c.classList.add("alerta",t),c.textContent=e,n.parentElement.insertAdjacentElement("afterbegin",c),setTimeout(()=>{c.remove()},1e3)}function l(){!function(){const e=document.querySelector(".content-grid-photos");for(;e.firstChild;)e.removeChild(e.firstChild)}();const o=document.querySelector(".content-grid-photos"),c=document.createElement("DIV"),a=document.createElement("DIV"),r=document.createElement("DIV");c.classList.add("grid-row"),a.classList.add("grid-row"),r.classList.add("grid-row"),e.forEach((e,s)=>{const l=document.createElement("IMG"),i=document.createElement("span"),u=document.createElement("div"),m=document.createElement("figure");l.dataset.photoId=e.id,l.src=e.url,l.alt=e.label,i.innerText=e.label,m.append(l,i,u),t&&n===e.userId&&(u.classList.add("deleteImg"),u.onclick=function(){d(e.id)},u.textContent="delete"),window.screen.width<=414?(c.append(m),o.append(c)):window.screen.width>414&&window.screen.width<=912?(s%2==0?c.append(m):a.append(m),o.append(c,a)):window.screen.width>=912&&(s%3==0?c.append(m):s%3==1?a.append(m):r.append(m),o.append(c,a,r))})}function d(e){const t=document.createElement("DIV"),n=document.querySelector(".action-user-contentList");t.classList.add("modal"),n.classList.add("hide"),t.innerHTML='\n        <form class="form deletePhoto">\n            <legen>Are you sure?</legen>\n            <div class="row">\n                <label>Password</label>\n                <input type="password" name="password" id="password" placeholder="password"/>\n                <input type="hidden" name="photo" id="photo"/>\n            </div>\n\n            <div class="form-option">\n                <span class="cancel">Cancel</span>\n                <input class="btn" type="submit" value="Delete"/>\n            </div>\n        </form>\n        ',setTimeout(()=>{document.querySelector(".form").classList.add("animated")},0),t.addEventListener("click",(function(n){if(n.preventDefault(),n.target.classList.contains("cancel")){document.querySelector(".form").classList.add("close"),setTimeout(()=>{t.remove()},500)}if(n.target.classList.contains("btn")){const t=document.querySelector("#password").value.trim();if(""===t)return void s("Password is required","error",document.querySelector(".form"));!async function(e,t){const n=new FormData;n.append("id",e),n.append("password",t);try{const e=location.origin+"/api/photo/delete",t=await fetch(e,{method:"POST",body:n}),o=await t.json();if(o.resultado&&(s(o.message,o.type,document.querySelector(".form")),a(),"success"===o.type)){const e=document.querySelector(".modal");setTimeout(()=>{e.remove()},2e3)}}catch(e){console.error(e)}}(e,t)}})),document.querySelector(".content").appendChild(t)}document.querySelector(".search").addEventListener("input",(async function(t){try{const n=`${location.origin}/api/photos/search?label=${t.target.value}`,o=await fetch(n),c=await o.json();e=c.search,l()}catch(e){console.error(e)}})),o.addEventListener("click",()=>{r()}),c.addEventListener("click",()=>{r()})}();