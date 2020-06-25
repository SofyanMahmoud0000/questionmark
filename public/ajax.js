let Request = new XMLHttpRequest();

let Button = document.querySelector("button");


Button.onclick = function(){
    let Request = new XMLHttpRequest();
    Request.open("get" , this.href);
    Request.send();

    Request.onreadystatechange = function(){

        if(Request.readyState == 4 && Request.status == 200)
        {
            this.href = "";
        }
        else
        {
            Paragraph.textContent = "Failed";
        }
    };
};