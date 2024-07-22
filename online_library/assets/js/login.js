function saveData(){
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let user_recoerd =new Array();
    user_recoerd = JSON.parse(localStorage.getItem("users"))?JSON.parse(localStorage.getItem("users")):[]
    if(user_recoerd.some((v)=>{
        return v.username == username && v.password == password
    })){
        let current_user = user_recoerd.filter((v)=>{
            return v.password == password && v.username == username 
        })[0]
        localStorage.setItem("role",current_user.role)
        localStorage.setItem("name",current_user.username);
        window.location.href = "../html/homepage.html";
    }
    else{
        alert("login fail");
    }
}