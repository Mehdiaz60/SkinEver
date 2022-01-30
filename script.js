document.addEventListener("DOMContentLoaded",async () => {
    await load_data();
});

async function load_data(){
    const request = await fetch("/list.php");
    const skins = await request.json();

    document.getElementById("skin").innerHTML=``;

    for(const skin of Object.keys(skins)){
        var skindata = skins[skin]
        document.getElementById("skin").innerHTML+=`<img src="${skindata.img}">`;
        document.getElementById("skin").innerHTML+=`<p class="text" > Skin : ${skindata.name} </p> `;
    }
}


async function addskin(){
    const name = document.getElementById("add_name").value;
    const img = document.getElementById("add_img").value; 
    //img.src=img;
    img.onclick = function() {
        window.location.href = 'img';
    };
    const skin = {
        "name": name, "img": img 
    };

        await fetch('/add.php', {
            method : "POST",
            headers : {
                'Content-Type' : 'application/json'
            },
            body: JSON.stringify(skin)
        });
        await load_data();
    //const request = await fetch("/add.php");

}

async function delskin(){
    const name = document.getElementById("del_name").value;
        await fetch('/delete.php', {
            method : "DELETE",
            headers : {
                'Content-Type' : 'application/json'
            },
            body: JSON.stringify(name)
        });
        await load_data();
    //const request = await fetch("/add.php");

}

async function upskin(){
    const name = document.getElementById("up_name").value;
    const img = document.getElementById("up_img").value; 

    const skin = {
        "name": name,"img": img 
    };

        await fetch('/edit.php', {
            method : "PUT",
            headers : {
                'Content-Type' : 'application/json'
            },
            body: JSON.stringify(skin)
        });
        await load_data();
    //const request = await fetch("/add.php");

}
